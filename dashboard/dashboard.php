<?php


require_once "../config/constant.php";
if (isset($_SESSION["role"])) {
    require_once '../classes/dbh.class.php';
    require_once '../classes/users.class.php';
    require_once "../partials/header.php";

    $user_name = $user['name'];
    $role = $user['role'];
    $email = $user['email'];
    $id = $user['id'];
    if ($role == 'admin') {
        require_once '../admin/admin_dashboard.php';
        require_once "../partials/user_info.php";

        ?>


        <?php
    } else if ($role == 'student') {
        require_once '../student/student_dashboard.php';

        require_once "../partials/user_info.php";


        ?>


        <?php
    } else if ($role == 'instructor') {
        require_once '../instructor/instructor_dashboard.php';
        require_once "../partials/user_info.php";


    }
    ?>


    <?php
    require_once "../partials/footer.php";
    require_once "../partials/user_info.php";
} else {
    $_SESSION['login'] = "<div class='text-danger'>Please Login First</div>";
    header("location:" . SITEURL);
}

?>