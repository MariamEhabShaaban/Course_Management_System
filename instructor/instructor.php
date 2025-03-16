<?php

require_once "../config/constant.php";
if (isset($_SESSION["role"]) && $_SESSION['role'] == 'instructor') {

    require_once "../partials/header.php";
    require_once "instructor_dashboard.php";
    ?>
    <?php require '../partials/footer.php';
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