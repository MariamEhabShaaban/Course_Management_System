<?php
class LoginContr extends Login {
   private $user_name;
   private $pass;
   

   public function __construct($user,$password){
    $this->user_name=$user;
    $this->pass=$password;
   

   }

   public function LoginUser(){
    if(!$this->InputEmpty()){
     $_SESSION["error"]="Empty Input";
     header("location: index.php?error=emptyinput");
    die();
    

    }
    $this->getUser( $this->user_name, $this->pass);
    
    
   }

   // check empty input
   private function InputEmpty(){
    $result=true;
    if(empty($this->user_name) || empty($this->pass) ){
        $result=false;
    }
    
    return $result;
   }




}

