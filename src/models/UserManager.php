<?php

namespace App\models;

use config\DbConnection;
require ('../../config/DbConnection.php');


//CREATE PROTOTYPE
class UserManager {

//CREATE USER
    public function addUser($pseudo, $mail, $pass) {

        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $user = $pdo->prepare('INSERT INTO users(pseudo, mail, pass, creation_date) VALUES( ?, ?, ?, CURRENT_DATE ())');
        $newUser = $user->execute(array( $pseudo, $mail, $pass ));

        return $newUser;
    }

//READ USER
    public function getUser($pseudo)
    {

        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $user = $pdo->prepare('SELECT pass FROM users WHERE pseudo = ? ');
        $userPass = $user->execute(array($pseudo));

        return $userPass;
    }

//UPDATE USER
    public function updateUser($pseudo, $new_pseudo, $new_mail, $new_pass) {

        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('UPDATE users SET pseudo = :new_pseudo, mail = :new_mail, pass = :new_pass, creation_date = NOW() WHERE pseudo = :pseudo');
        $req->execute(array('new_pseudo' => $new_pseudo,
            'new_mail' => $new_mail,
            'new_pass' => $new_pass,
            'pseudo' => $pseudo
        ));
    }

//DELETE USER
    public function deleteUser($pseudo) {

        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('DELETE FROM users WHERE pseudo= :pseudo');
        $req->execute(array('pseudo' => $pseudo));
    }
}
