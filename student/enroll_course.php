<?php

require_once "../config/constant.php";
if (isset($_SESSION["role"]) && $_SESSION['role'] == 'student') {

    require_once "../classes/dbh.class.php";
    require_once "../classes/enrollments.class.php";
    if (isset($_POST['enroll'])) {
        $inst_id = $_POST['inst_id'];
        $cour_id = $_POST['course_id'];
        $stu_id = $_POST['stu_id'];
        $email= $_POST['email'];
        $cour_title= $_POST['title'];
       

        $enroll = new enrollment();
        $res = $enroll->add_enrollment($cour_id, $stu_id, $inst_id,$email, $cour_title);
        if ($res) {
            $_SESSION['enroll'] = "<div class='text-success'>Enrolled Successfully</div>";

            header("location:" . SITEURL . 'student/course.php');
        } else {
            $_SESSION['enroll'] = "<div class='text-danger'>Failed To Enroll </div>";
            header("location:" . SITEURL . 'student/course.php');
        }

    }

} else {
    if (isset($_SESSION["role"])) {
        $_SESSION['login'] = "<div class='text-danger'>No Permission</div>";
        header("location:" . SITEURL . "dashboard/dashboard.php");
    } else {
        $_SESSION['login'] = "<div class='text-danger'>Please Login First</div>";
        header("location:" . SITEURL);
    }
}


?>