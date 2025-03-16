<?php
require_once "../config/constant.php";
class users extends Dbh
{
    private $id;
    private $name;
    private $email;
    private $role;
    private $password;

    public function __construct()
    {
    }

    public function get_user_by_name($name)
    {
        $user = [];
        $sql = "SELECT * FROM users WHERE name=? ";
        $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
        if (!$st->execute(array($name))) {
            $st = null;
        } else {
            $st = $st->fetch(PDO::FETCH_ASSOC);
            $user["role"] = $this->role = $st["role"];
            $user["email"] = $this->email = $st["email"];
            $user["password"] = $this->password = $st["password"];
            $user["name"] = $this->name = $st["name"];
            $user['id'] = $this->id = $st['id'];

        }
        return $user;
    }
    public function get_all_student()
    {
        $students = [];
        $sql = "SELECT * FROM users WHERE role=?";
        $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
        if ($st->execute(array('student'))) {
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                $students[] = $row;
            }
        } else {
            $st = null;
        }
        return $students;
    }

    public function delete_student($id)
    {
        $sql = "DELETE FROM users WHERE id=?";
        $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
        if ($st->execute(array($id))) {
            return true;
        } else {
            return false;
        }


    }

    public function get_all_instructor()
    {
        $students = [];
        $sql = "SELECT * FROM users WHERE role=?";
        $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
        if ($st->execute(array('instructor'))) {
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                $students[] = $row;
            }
        } else {
            $st = null;
        }
        return $students;
    }

    public function delete_instuctor($id)
    {
        $sql = "DELETE FROM users WHERE id=?";
        $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
        if ($st->execute(array($id))) {
            return true;
        } else {
            return false;
        }


    }



}











?>