<?php

namespace App\Models;

use Config\DbConnection;


//CREATE PROTOTYPE
class UserManager extends DbConnection
{

//CREATE USER
    public function addUser($pseudo, $mail, $pass) {

        $user = $this->pdo->prepare('INSERT IGNORE INTO users(pseudo, mail, pass, creation_date) VALUES( ?, ?, ?, CURRENT_DATE ())');
        $newUser = $user->execute(array( $pseudo, $mail, $pass ));

        return $newUser;
    }

//READ USER
    public function getUser($pseudo)
    {

        $req = $this->pdo->prepare('SELECT pseudo, pass FROM users WHERE pseudo = ? ');
        $req->execute(array($pseudo));

        $user = $req->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

//UPDATE USER
    public function updateUser($pseudo, $new_pseudo, $new_mail, $new_pass) {

        $req = $this->pdo->prepare('UPDATE users SET pseudo = :new_pseudo, mail = :new_mail, pass = :new_pass, creation_date = NOW() WHERE pseudo = :pseudo');
        $req->execute(array('new_pseudo' => $new_pseudo,
            'new_mail' => $new_mail,
            'new_pass' => $new_pass,
            'pseudo' => $pseudo
        ));
    }

//DELETE USER
    public function deleteUser($pseudo) {

        $req = $this->pdo->prepare('DELETE FROM users WHERE pseudo= :pseudo');
        $req->execute(array('pseudo' => $pseudo));
    }
}
