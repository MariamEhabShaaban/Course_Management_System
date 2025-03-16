<?php
require_once "../config/constant.php";
class Signup extends Dbh
{

    protected function setUser($uname, $pass, $email, $role)
    {
        $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare('INSERT INTO users (name ,password,email,role) VALUES (?,?,?,?);');
        $hashpass = md5($pass);


        if (!$st->execute(array($uname, $hashpass, $email, $role))) {
            $st = null;

            header("location:" . SITEURL . "?error=stfailed");
            die();

        }

        $st = null;
    }





    protected function checkUser($uname, $email)
    {
        $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare('SELECT name FROM users WHERE name=? OR email=?;');

        if (!$st->execute(array($uname, $email))) {
            $st = null;

            header("location: " . SITEURL . "?error=stfailed");
            die();

        }
        $resultCheck = true;
        if ($st->rowCount() > 0) {
            $resultCheck = false;
        }

        return $resultCheck;

    }




}