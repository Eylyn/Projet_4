<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\User;

class UserDAO extends DAO
{
    private function buildObject($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setCreatedAt($row['createdAt']);
        $user->setLastConnection($row['lastConnection']);
        $user->setEmail($row['email']);
        $user->setRole($row['role_id']);

        return $user;
    }

    public function getUsers()
    {
        $sql = 'SELECT id, pseudo, createdAt, email, role_id, lastConnection FROM users ORDER BY id DESC';
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row) {
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }

    public function register(Parameter $post)
    {
        $this->checkUser($post);
        $sql = 'INSERT INTO users (pseudo, password, email, role_id, createdAt, lastConnection) VALUES (?, ?, ?, ?, NOW(), NOW())';
        $this->createQuery($sql, [$post->get('pseudo'), password_hash($post->get('password'), PASSWORD_BCRYPT), $post->get('email'), 2]);
    }

    public function checkUser(Parameter $post)
    {
        $sql = 'SELECT COUNT(pseudo) FROM users WHERE pseudo = ?';
        $result = $this->createQuery($sql, [$post->get('pseudo')]);
        $isUnique = $result->fetchColumn();
        if ($isUnique) {
            return '<p> Ce pseudo est déjà pris </p>';
        }
    }

    public function login(Parameter $post)
    {
        $sql = 'SELECT id, password, role_id, DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\') as createdAt, DATE_FORMAT(lastConnection, \'%d/%m/%Y à %Hh%imin\') as lastConnection FROM users WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$post->get('pseudo')]);
        $result = $data->fetch();
        $isPasswordValid = password_verify($post->get('password'), $result['password']);
        return[
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];
    }

}