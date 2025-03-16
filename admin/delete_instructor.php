<?php

require_once("../config/constant.php");

if (isset($_SESSION["role"]) && $_SESSION['role'] == 'admin') {
    if (isset($_POST['delete'])) {
        require_once "../classes/dbh.class.php";
        require_once "../classes/users.class.php";
        $inst_id = $_POST['id'];
        $instructor = new users();
        $del = $instructor->delete_instuctor($inst_id);
        if ($del) {
            $_SESSION['delete_student'] = "<div class='text-success'>The Instructor deleted successfully</div>";
            header("location:" . SITEURL . "admin/instructor.php");

        } else {
            $_SESSION['delete_student'] = "<div class='text-danger'>Failed To Delete Instructor</div>";
            header("location:" . SITEURL . "admin/instructor.php");

        }





    }

    ?>



    <?php

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