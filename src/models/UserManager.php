<?php

//CREATE PROTOTYPE
class UserManager {

//CREATE CHAPTER
    public function addUser($id, $pseudo, $mail, $pass) {

        $pdo = $this->dbConnect();
        $newUser = $pdo->prepare('INSERT INTO users(id, pseudo, mail, pass, creation_date) VALUES(?, ?, ?, ?, NOW())');
        $affectedLines = $newUser->execute(array($id, $pseudo, $mail, $pass));

        return $affectedLines;
    }

//READ CHAPTER
    public function getUser()
    {

        $pdo = $this->dbConnect();
        $user = $pdo->query('SELECT id, pseudo, mail, pass, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM users ORDER BY id DESC');

        return $user;
    }

//UPDATE CHAPTER
    public function updateUser($pseudo, $new_pseudo, $new_mail, $new_pass) {

        $pdo = $this->dbConnect();
        $req = $pdo->prepare('UPDATE users SET pseudo = :new_pseudo, mail = :new_mail, pass = :new_pass, creation_date = NOW() WHERE pseudo = :pseudo');
        $req->execute(array('new_pseudo' => $new_pseudo,
            'new_mail' => $new_mail,
            'new_pass' => $new_pass,
            'pseudo' => $pseudo
        ));
    }

//DELETE CHAPTER
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