<?php
 class Dbh {
    public function __construct(){
      
    }
    protected function connect($dns, $username, $pass){
        try
        {
            
            $dbh=new PDO($dns,$username,$pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
       


        }catch(PDOException $e){
            echo 'Erorr '.$e->getMessage().'<br>';
            die();

        }
    }
 }