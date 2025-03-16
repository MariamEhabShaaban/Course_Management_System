<?php

require_once("../config/constant.php");

if (isset($_SESSION["role"]) && $_SESSION['role'] == 'admin') {
    if (isset($_POST['delete'])) {
        require_once "../classes/dbh.class.php";
        require_once "../classes/users.class.php";
        $student_id = $_POST['id'];
        $student = new users();
        $del = $student->delete_student($student_id);
        if ($del) {
            $_SESSION['delete_student'] = "<div class='text-success'>The Student deleted successfully</div>";
            header("location:" . SITEURL . "admin/students.php");

        } else {
            $_SESSION['delete_student'] = "<div class='text-danger'>Failed To Delete Student</div>";
            header("location:" . SITEURL . "admin/students.php");

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