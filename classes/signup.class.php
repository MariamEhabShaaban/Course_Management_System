<?php
class Signup extends Dbh{

    protected function setUser($uname,$pass,$email){
        $st=$this->connect()->prepare('INSERT INTO users (name ,password,email) VALUES (?,?,?);');
        //$hashpass=md5($pass);
        $hashpass=$pass;
    
        if(!$st->execute(array($uname,$hashpass,$email))){
            $st=null;
            
            header("location: index.php?error=stfailed");
            die();
           
        }
      
        $st=null;
       }
    
    



   protected function checkUser($uname,$email){
    $st=$this->connect()->prepare('SELECT name FROM users WHERE name=? OR email=?;');

    if(!$st->execute(array($uname,$email))){
        $st=null;
      
        header("location: index.php?error=stfailed");
        die();
   
    }
    $resultCheck=true;
    if($st->rowCount()>0){
         $resultCheck=false;
    }
   
    return $resultCheck;

   }




}