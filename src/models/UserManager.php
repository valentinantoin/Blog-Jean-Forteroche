<?php

namespace App\Models;

use Config\DbConnection;

/**
 * Class UserManager
 * @package App\Models
 */
class UserManager extends DbConnection
{

    /**
     * @param $pseudo
     * @param $mail
     * @param $pass
     * @return bool
     */
    public function addUser($pseudo, $mail, $pass)
    {
        $user = $this->pdo->prepare('INSERT IGNORE INTO users(pseudo, mail, pass, creation_date) VALUES( ?, ?, ?, CURRENT_DATE ())');
        $newUser = $user->execute(array( $pseudo, $mail, $pass ));

        return $newUser;
    }

    /**
     * @param $pseudo
     * @return mixed
     */
    public function dispoPseudo($pseudo)
    {
        $req = $this->pdo->prepare('SELECT COUNT(pseudo) AS test FROM users WHERE pseudo = ? ');
        $req->execute(array($pseudo));
        $test = $req->fetch(\PDO::FETCH_ASSOC);

        return $test;
    }

    /**
     * @param $pseudo
     * @return mixed
     */
    public function getUser($pseudo)
    {
        $req = $this->pdo->prepare('SELECT id, pseudo, pass FROM users WHERE pseudo = ? ');
        $req->execute(array($pseudo));
        $user = $req->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    /**
     * @param $pseudo
     * @param $new_pseudo
     * @param $new_mail
     * @param $new_pass
     */
    public function updateUser($pseudo, $new_pseudo, $new_mail, $new_pass)
    {
        $req = $this->pdo->prepare('UPDATE users SET pseudo = :new_pseudo, mail = :new_mail, pass = :new_pass, creation_date = NOW() WHERE pseudo = :pseudo');
        $req->execute(array('new_pseudo' => $new_pseudo,
            'new_mail' => $new_mail,
            'new_pass' => $new_pass,
            'pseudo' => $pseudo
        ));
    }

    /**
     * @param $pseudo
     */
    public function deleteUser($pseudo)
    {
        $req = $this->pdo->prepare('DELETE FROM users WHERE pseudo= :pseudo');
        $req->execute(array('pseudo' => $pseudo));
    }

    /**
     * @return mixed
     */
    public function userCount()
    {
        $req = $this->pdo->prepare('SELECT COUNT(*) AS nbUser FROM users');
        $req->execute(array());
        $nbUser = $req->fetch(\PDO::FETCH_ASSOC);

        return $nbUser;
    }
}
