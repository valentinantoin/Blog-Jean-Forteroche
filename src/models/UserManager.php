<?php

//CREATE PROTOTYPE
class UserManager {

//CREATE USER
    public function addUser($pseudo, $mail, $pass) {

        $pdo = $this->dbConnect();
        $user = $pdo->prepare('INSERT INTO users(pseudo, mail, pass, creation_date) VALUES( ?, ?, ?, CURRENT_DATE ())');
        $newUser = $user->execute(array( $pseudo, $mail, $pass ));

        return $newUser;
    }

//READ USER
    public function getUser()
    {

        $pdo = $this->dbConnect();
        $user = $pdo->prepare('SELECT id, pass FROM users WHERE pseudo = :pseudo');
        $user->execute(array(
            'pseudo' => $pseudo));
        $validUser = $user->fetch();

        return $validUser;
    }

//UPDATE USER
    public function updateUser($pseudo, $new_pseudo, $new_mail, $new_pass) {

        $pdo = $this->dbConnect();
        $req = $pdo->prepare('UPDATE users SET pseudo = :new_pseudo, mail = :new_mail, pass = :new_pass, creation_date = NOW() WHERE pseudo = :pseudo');
        $req->execute(array('new_pseudo' => $new_pseudo,
            'new_mail' => $new_mail,
            'new_pass' => $new_pass,
            'pseudo' => $pseudo
        ));
    }

//DELETE USER
    public function deleteUser($pseudo) {
        $pdo = $this->dbConnect();
        $req = $pdo->prepare('DELETE FROM users WHERE pseudo= :pseudo');
        $req->execute(array('pseudo' => $pseudo));
    }


//CONNECT TO DB
    private function dbConnect(){

        $pdo = new PDO('mysql:dbname=jeanforteroche;host=localhost', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo;
    }
}