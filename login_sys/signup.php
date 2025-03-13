<?php
/* check set POST

   check set POST[submit]
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {

    $user_name=$_POST['username'];
    $password=$_POST['password'];
    $repeat_pass=$_POST["repeatpass"];
    $email=$_POST["email"];
    $role=$_POST['role'];

    include '../classes/dbh.class.php';
    include '../classes/signup.class.php';
    include '../classes/signup_controller.class.php';
  //instance of signup class
    $signup = new SignupContr( $user_name,$password,$repeat_pass, $email,$role);


//running error handle
 $signup->signupUser();


//going back to front page
header("location:".SITEURL."index.php?error=none"); 



    
}


 


   


