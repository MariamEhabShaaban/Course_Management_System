<?php
require_once "../config/constant.php";
class Login extends Dbh{
   
    protected function getUser($uname,$pass){
        session_start();
        $st=$this->connect(DNS,DB_USERNAME,PASSWORD)->prepare('SELECT password FROM users WHERE name=?');
        //$hashpass=md5($pass);
        $hashpass=$pass;
    
        if(!$st->execute(array($uname))){
            $st=null;
        
            header("location:".SITEURL."?error=stfailed");
            die();
           
        }
      
      
       

       if($st->rowCount()==0){
        $st=null;
        header("location:".SITEURL."?error=user_not_found");
        die();
       }

       $passHased=$st->fetchAll(PDO::FETCH_ASSOC);
       $checkpass=($pass==$passHased[0]["password"]);
      

       if(!$checkpass){
        $st=null;
        
        $_SESSION["error"]="wrong_password";
        header("location: ".SITEURL."?error=wrong_password");
        die();
       }
       else if($checkpass){
        $st=$this->connect(DNS,DB_USERNAME,PASSWORD)->prepare('SELECT password ,name FROM users WHERE name=?');
        if(!$st->execute(array($uname))){
            $st=null;
         
            header("location:".SITEURL."?error=stfailed");
            die();
           
        }
        if($st->rowCount()==0){
            $st=null;
            $_SESSION["error"]="user_not_found";
            header("location:".SITEURL."?error=user_not_found");
            die();
           }
           $user=$st->fetchAll(PDO::FETCH_ASSOC);
           session_start();
           $_SESSION["name"]=$user[0]["name"];
           $st=null;

       }
       $st=null;
    }






}