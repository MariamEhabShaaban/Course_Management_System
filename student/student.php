<?php


require_once "../config/constant.php";
 if(isset($_SESSION["role"]) && $_SESSION['role']=='student' ){
require_once "partials/header.php";
require_once "student_dashboard.php";
?>
 

    <?php require 'partials/footer.php';
    }
    else{
       $_SESSION['login']="<div class='text-danger'>Please Login First</div>";
       header("location:".SITEURL);
     }
    
    ?>