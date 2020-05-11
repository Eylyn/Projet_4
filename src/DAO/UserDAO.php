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
        $user->setRole($row['name']);

        return $user;
    }

    public function getUsers()
    {
        $sql = 'SELECT users.id, users.pseudo, users.email, DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\') as createdAt, DATE_FORMAT(lastConnection, \'%d/%m/%Y à %Hh%imin\') as lastConnection, role.name FROM users INNER JOIN role ON role.id = users.role_id ORDER BY users.id DESC';
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

    public function isPasswordValid(Parameter $post, $pseudo, $name)
    {
        $sql = 'SELECT password FROM users WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$pseudo->get('pseudo')]);
        
        $result = $data->fetch();
        var_dump($result);
        $isPasswordValid = password_verify($post->get($name), $result['password']);
        return $isPasswordValid;
    }

    public function login(Parameter $post)
    {
        $sql1 = 'SELECT users.id, users.role_id, DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\') as createdAt, DATE_FORMAT(lastConnection, \'%d/%m/%Y à %Hh%imin\') as lastConnection, role.name FROM users INNER JOIN role ON role.id = users.role_id WHERE pseudo = ?';
        $data = $this->createQuery($sql1, [$post->get('pseudo')]);
        $result = $data->fetch();
        $sql2 = 'UPDATE users SET lastConnection = NOW() WHERE pseudo = ?';
        $this->createQuery($sql2, [$post->get('pseudo')]);
        return $result;
    }

    public function updatePassword(Parameter $post, $pseudo)
    {
        $sql = 'UPDATE users SET password = ? WHERE pseudo = ?';
        $this->createQuery($sql, [password_hash($post->get('newPassword'), PASSWORD_BCRYPT), $pseudo]);
    }

    public function deleteUser($userId)
    {
        $sql1  = 'INSERT INTO deletUsers(pseudo, email, role_id, createdAt, lastConnection) SELECT pseudo, email, role_id, createdAt, lastConnection FROM users WHERE id = ?';
        $this->createQuery($sql1, [$userId]);
        $sql2 = 'DELETE FROM users WHERE id = ?';
        $this->createQuery($sql2, [$userId]);
    }

    public function deleteAccount($pseudo)
    {
        $sql = 'DELETE FROM users WHERE id = ?';
        $this->createQuery($sql, [$pseudo]);
    }
}
