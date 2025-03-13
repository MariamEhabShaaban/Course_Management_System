<?php
/* check set POST

   
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
  

    $user_name=$_POST['username'];
    $password=$_POST['password'];

    include '../classes/dbh.class.php';
    include '../classes/login.class.php';
    include '../classes/login_controller.class.php';
    require_once '../classes/users.class.php';
  //instance of login class
    $login = new LoginContr( $user_name,$password);


//running error handle
 $login->LoginUser();


//going back to front page
header("location:../dashboard/dashboard.php?login_success"); 



    
}


 


   


