<?php
class SignupContr extends Signup{
   private $user_name;
   private $pass;
   private $r_pass;
   private $email;

   public function __construct($user,$password,$r_password,$email){
    $this->user_name=$user;
    $this->pass=$password;
    $this->r_pass=$r_password;
    $this->email=$email;
   }

   public function signupUser(){
   
    if(!$this->InputEmpty()){
        $_SESSION["error"]="Empty Input";
     header("location: index.php?error=emptyinput");
    die();
    

    }
    if(!$this->valid_name()){
        $_SESSION["error"]="Invalid Username";
        header("location: index.php?error=username");
        die();
        

    }
    if(!$this->valid_email()){
        $_SESSION["error"]="Invalid Email";
        header("location: index.php?error=email");
        die();
     

    }
    if(!$this->confirm_password()){
        $_SESSION["error"]="Password Don't Match";
        header("location: index.php?error=passwordmatch");
        die();
    

    }
    if(!$this-> uidTakenCheck()){
        $_SESSION["error"]="Email or Username is taken";
        header("location: index.php?error=emailorusername");
        exit();

    }


    $this->setUser( $this->user_name, $this->pass, $this->email);
    
    
   }

   // check empty input
   private function InputEmpty(){
    $result=true;
    if(empty($this->user_name) || empty($this->pass)  || empty($this->r_pass) || empty($this->email)){
        $result=false;
    }
   
    return $result;
   }



   // valid name

   private function valid_name(){
    $result=true;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->user_name)){
                $result=false;
        }
      
   return $result;
   }


   // valid email

   private function valid_email(){
    $result=true;
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
                $result=false;
        }
      
   return $result;
   }


   // pass==repeat

 private function confirm_password(){
    $result=true;
        if($this->pass!==$this->r_pass){
                $result=false;
            
        }
       
   return $result;
   }

// error handle

   private function uidTakenCheck(){
    $result=true;
        if(!$this->checkUser($this->user_name,$this->email)){
                $result=false;
        }
       
   return $result;
   }



}

