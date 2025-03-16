<?php

require_once("../config/constant.php");

if (isset($_SESSION["role"]) && $_SESSION['role'] == 'admin') {
    if (isset($_POST['delete'])) {
        require_once '../classes/dbh.class.php';
        require_once '../classes/courses.class.php';
        $id = $_POST['course_id'];
        $del = new course();
        if ($del->delete_course($id)) {
            $_SESSION['delete_course'] = "<div class='text-success'>The Course Deleted Successfully</div>";
            header("location:" . SITEURL . "admin/courses.php");

        } else {
            $_SESSION['delete_course'] = "<div class='text-danger'>Failed To Delete Course</div>";
            header("location:" . SITEURL . "admin/courses.php");

        }


    } else {
        $_SESSION['delete_course'] = "<div class='text-danger'>Failed To Delete Course</div>";
        header("location:" . SITEURL . "admin/courses.php");

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