<?php

namespace App\src\DAO;

use App\src\model\User;

class UserDAO extends DAO
{
    private function buildObject($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setCreatedAt($row['createdAt']);
        $user->setEmail($row['email']);
        $user->setRole($row['role_id']);

        return $user;
    }

    public function getUsers()
    {
        $sql = 'SELECT id, pseudo, createdAt, email, role_id FROM users ORDER BY id DESC';
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row) {
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }
}