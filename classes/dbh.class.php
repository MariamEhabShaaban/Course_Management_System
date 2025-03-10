<?php
 class Dbh {
    public function __construct(){
        echo 'database';
    }
    protected function connect(){
        try
        {
            $dns="mysql:host=localhost;dbname=course_management_system";
            $username="root";
            $pass="";
            $dbh=new PDO($dns,$username,$pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
       


        }catch(PDOException $e){
            echo 'Erorr '.$e->getMessage().'<br>';
            die();

        }
    }
 }