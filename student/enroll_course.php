<?php
session_start();
require_once "../classes/dbh.class.php";
require_once "../classes/enrollments.class.php";
if(isset($_POST['enroll'])){
    $inst_id=$_POST['inst_id'];
    $cour_id=$_POST['course_id'];
    $stu_id=$_POST['stu_id'];

    $enroll=new enrollment();
    $res=$enroll->add_enrollment($cour_id,$stu_id,$inst_id);
    if($res){
        $_SESSION['enroll']="<div class='text-success'>Enrolled Successfully</div>";
        header("location:".SITEURL.'student/course.php');
    }else{
        $_SESSION['enroll']="<div class='text-danger'>Failed To Enroll </div>";
        header("location:".SITEURL.'student/course.php');
    }

}




?>