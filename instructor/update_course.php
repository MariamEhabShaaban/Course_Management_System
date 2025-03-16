<?php

require_once "../config/constant.php";
if (isset($_SESSION["role"]) && $_SESSION['role'] == 'instructor') {

    require_once "../classes/dbh.class.php";
    require_once "../classes/courses.class.php";
    require_once "../classes/users.class.php";
    require_once "../classes/enrollments.class.php";

    require_once "../partials/header.php";
    require_once "instructor_dashboard.php";

    if (isset($_POST["submit"])) {

        $inst_id = $_POST["inst_id"];
        $course_id = $_POST["course_id"];
        $title = $_POST["title"];
        $description = $_POST["description"];


        $cour_up = new course();
        $res = $cour_up->update_course($title, $description, $course_id, $inst_id);
        if ($res) {
            $_SESSION['update-course'] = "<div class='text-success'>The Course Updated Successfully</div>";
            header("location:" . SITEURL . "instructor/instructor_courses.php");
        } else {
            $_SESSION['update-course'] = "<div class='text-danger'>Failed To Update Course</div>";
            header("location:" . SITEURL . "instructor/instructor_courses.php");
        }


    }



    if (isset($_POST['update_course'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $course_id = $_POST['course_id'];
        $inst_id = $user['id'];
    }
    ?>

    <div class="main-content">
        <h1>Update Course</h1>

        <form class="form" method="POST" action="">
            <input type="hidden" name="inst_id" value="<?php echo $inst_id ?>">
            <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
            <input class="form-control" type="text" name="title" placeholder="course title" value="<?php echo $title ?>">
            <br>
            <textarea class="form-control" name="description"
                placeholder="course description "><?php echo $description ?></textarea>
            <br>
            <input class="btn btn-primary" type="submit" value="Update Coures" name="submit">

        </form>





    </div>

    <?php require_once "../partials/footer.php";
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