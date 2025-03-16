<?php

require_once "../config/constant.php";
if (isset($_SESSION["role"]) && $_SESSION['role'] == 'instructor') {
    require_once "../classes/dbh.class.php";
    require_once "../classes/courses.class.php";
    require_once "../classes/users.class.php";
    require_once "../classes/enrollments.class.php";

    require_once "../partials/header.php";
    require_once "instructor_dashboard.php";


    $inst_id = $user['id'];
    $cour = new course();
    $courses = $cour->all_courses('instructor', $inst_id);
    // get total number of enrollment 
// we need course_id
    $enroll = new enrollment();

    if (isset($_SESSION['delete-course'])) {
        echo $_SESSION['delete-course'];
        unset($_SESSION['delete-course']);
    }




    ?>

    <div class="main-content">

        <form method="post" action="<?php echo SITEURL ?>instructor/create_course.php">
            <input type="hidden" name="inst_id" value="<?php echo $inst_id ?>">
            <input class="btn btn-primary" type="submit" name="create_course" value="Create Course">
        </form>
        <?php
        if (isset($_SESSION['create-course'])) {
            echo $_SESSION['create-course'];
            unset($_SESSION['create-course']);
        }

        if (isset($_SESSION['delete_course'])) {
            echo $_SESSION['delete_course'];
            unset($_SESSION['delete_course']);
        }
        if (isset($_SESSION['update-course'])) {
            echo $_SESSION['update-course'];
            unset($_SESSION['update-course']);
        }
        ?>
        <br>

        <table class="table">
            <?php if ($courses) { ?>
                <thead>
                    <th>Title</th>
                    <th>description</th>
                    <th>Total Num Enrollment</th>
                    <th>Action</th>


                </thead>
                <tbody>
                    <?php

                    foreach ($courses as $course) {
                        $enrollmets = $enroll->get_enrollment_by_inst_id($course['id'], $course['instructor_id']);
                        $cnt = sizeof($enrollmets);
                        ?>
                        <tr>
                            <td><?php echo $course['title'] ?></td>
                            <td><?php echo $course['description'] ?></td>
                            <td><?php echo $cnt ?></td>
                            <td>
                                <div class="btn-container">
                                    <form method="POST" action="<?php echo SITEURL ?>instructor/delete_course.php" class="d-inline">
                                        <input type="hidden" name="course_id" value="<?php echo $course['id'] ?>">
                                        <input class="btn btn-danger" type="submit" name="delete_course" value="Delete">
                                    </form>
                                    <form method="POST" action="<?php echo SITEURL ?>instructor/update_course.php" class="d-inline">
                                        <input type="hidden" name="course_id" value="<?php echo $course['id'] ?>">
                                        <input type="hidden" name="title" value="<?php echo $course['title'] ?>">
                                        <input type="hidden" name="description" value="<?php echo $course['description'] ?>">
                                        <input class="btn btn-primary" type="submit" name="update_course" value="Update">
                                    </form>
                                </div>
                            </td>



                        </tr>
                    <?php }
            } else {
                echo "<div class='text-danger'>No Courses Added</div>";
            } ?>
            </tbody>
        </table>
    </div>

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