<?php
require_once "../config/constant.php";
class Login extends Dbh
{

    protected function getUser($uname, $pass)
    {
        session_start();
        $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare('SELECT * FROM users WHERE name=?');
        //$hashpass=md5($pass);
        $hashpass = $pass;

        if (!$st->execute(array($uname))) {
            $st = null;

            header("location:" . SITEURL . "?error=stfailed");
            die();

        }




        if ($st->rowCount() == 0) {
            $st = null;
            $_SESSION["error"] = "<div class='text-danger'>Can't Login user not found</div>";
            header("location:" . SITEURL . "?error=user_not_found");
            die();
        }

        $passHased = $st->fetchAll(PDO::FETCH_ASSOC);
        $checkpass = ($pass == $passHased[0]["password"]);


        if (!$checkpass) {
            $st = null;

            $_SESSION["error"] = "<div class='text-danger'>Can't Login wrong password</div>";
            header("location: " . SITEURL . "?error=wrong_password");
            die();
        } else if ($checkpass) {
            $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare('SELECT * FROM users WHERE name=?');
            if (!$st->execute(array($uname))) {
                $st = null;
              
                header("location:" . SITEURL . "?error=stfailed");
                die();

            }
            if ($st->rowCount() == 0) {
                $st = null;
                $_SESSION["error"] = "<div class='text-danger'>Can't Login user not found</div>";
                header("location:" . SITEURL . "?error=user_not_found");
                die();
            }
            $user = $st->fetchAll(PDO::FETCH_ASSOC);


            $_SESSION["name"] = $user[0]["name"];
            $_SESSION["role"] = $user[0]["role"];



            $st = null;

        }
        $st = null;
    }






}