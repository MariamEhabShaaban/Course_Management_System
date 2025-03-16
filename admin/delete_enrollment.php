<?php

require_once("../config/constant.php");

if (isset($_SESSION["role"]) && $_SESSION['role'] == 'admin') {
    if (isset($_POST['delete'])) {
        require_once '../classes/dbh.class.php';
        require_once '../classes/enrollments.class.php';
        $id = $_POST['id'];
        $del = new enrollment();
        if ($del->delete_enrollment($id)) {
            $_SESSION['delete_enroll'] = "<div class='text-success'>The Enrollment Deleted Successfully</div>";
            header("location:" . SITEURL . "admin/enrollment.php");

        } else {
            $_SESSION['delete_enroll'] = "<div class='text-danger'>Failed To Delete Enrollment</div>";
            header("location:" . SITEURL . "admin/enrollment.php");

        }


    } else {
        $_SESSION['delete_enroll'] = "<div class='text-danger'>Failed To Delete Enrollment</div>";
        header("location:" . SITEURL . "admin/enrollment.php");

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