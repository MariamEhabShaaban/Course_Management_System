<?php
session_start();

require_once "../classes/dbh.class.php";
require_once "../classes/courses.class.php";
require_once "../classes/users.class.php";
require_once "../classes/enrollments.class.php";

require_once "../partials/header.php";
require_once "student_dashboard.php";


$student_id = $user['id'];
$cour = new course();
$courses = $cour->all_courses('student', $student_id);
// get total number of enrollment 
// we need course_id
$enroll = new enrollment();
$courses = $enroll->get_enrollment_by_student_id($student_id);


?>

<div class="main-content">

    <h1>All Enrollments</h1>
    <?php
    // session enrollment
    



    ?>
    <br>

    <table class="table">
        <?php if ($courses) { ?>
            <thead>

                <th>Course Title</th>
                <th>Course Description</th>
                <th>Instructor</th>
               


            </thead>
            <tbody>
                <?php

                foreach ($courses as $course) {
                    ?>
                    <tr>
                        <td><?php echo $course['title'] ?></td>
                        <td><?php echo $course['description'] ?></td>
                        <td><?php echo $course['name'] ?></td>
                        



                    </tr>
                <?php }
        } else {
            echo "<div class='text-danger'>No Courses Added</div>";
        } ?>
        </tbody>
    </table>
</div>

<?php require '../partials/footer.php'; ?>