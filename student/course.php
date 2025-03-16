<?php

require_once "../config/constant.php";
if (isset($_SESSION["role"]) && $_SESSION['role'] == 'student') {
    require_once "../classes/dbh.class.php";
    require_once "../classes/courses.class.php";
    require_once "../classes/users.class.php";
    require_once "../classes/enrollments.class.php";

    require_once "../partials/header.php";
    require_once "student_dashboard.php";


    $student_id = $user['id'];
    $email=$user['email'];
 

    // get total number of enrollment 
// we need course_id
    $cour = new course();
    $ava_courses = $cour->get_available_corses_by_student_id($student_id);


    ?>

    <div class="main-content">

        <h1>Available Courses</h1>
        <?php
        // session enrollment
        if (isset($_SESSION['enroll'])) {
            echo $_SESSION['enroll'];
            unset($_SESSION['enroll']);
        }
        if(isset( $_SESSION['email'])){
            echo $_SESSION['email'];
            unset($_SESSION['email']);
        }



        ?>
        <br>

        <table class="table">
            <?php if ($ava_courses) { ?>
                <thead>

                    <th>Course Title</th>
                    <th>Course Description</th>
                    <th>Instructor</th>
                    <th>Action</th>


                </thead>
                <tbody>
                    <?php

                    foreach ($ava_courses as $course) {
                        ?>
                        <tr>
                            <td><?php echo $course['title'] ?></td>
                            <td><?php echo $course['description'] ?></td>
                            <td><?php echo $course['inst_name'] ?></td>
                            <td>
                                <div class="btn-container">
                                    <form method="POST" action="<?php echo SITEURL ?>student/enroll_course.php" class="d-inline">
                                        <input type="hidden" name="course_id" value="<?php echo $course['id'] ?>">
                                        <input type="hidden" name="inst_id" value="<?php echo $course['instructor_id'] ?>">
                                        <input type="hidden" name="stu_id" value="<?php echo $student_id ?>">
                                        <input type="hidden"  name="email" value="<?php echo  $email?>">
                                        <input type="hidden"  name="title" value="<?php echo  $course['title']?>">
                                        <input class="btn btn-primary" type="submit" name="enroll" value="enroll">
                                    </form>
                                </div>
                            </td>



                        </tr>
                    <?php }
            } else {
                echo "<div class='text-danger'>No Courses Available</div>";
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