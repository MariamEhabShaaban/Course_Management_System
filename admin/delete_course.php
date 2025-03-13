<?php
session_start();
if(isset($_POST['delete'])){
    require_once '../classes/dbh.class.php';
    require_once '../classes/courses.class.php';
    $id=$_POST['course_id'];
    $del=new course();
    if($del->delete_course( $id )){
        $_SESSION['delete_course']="<div class='text-success'>The Course Deleted Successfully</div>";
        header("location:".SITEURL."admin/courses.php");
     
    }
    else{
        $_SESSION['delete_course']="<div class='text-danger'>Failed To Delete Course</div>";
        header("location:".SITEURL."admin/courses.php");
      
    }


}else{
    $_SESSION['delete_course']="<div class='text-danger'>Failed To Delete Course</div>";
    header("location:".SITEURL."admin/courses.php");  
        
}



?>