<?php

require_once("../config/constant.php");

if(isset($_SESSION["role"]) && $_SESSION['role']=='admin'){

require_once "../classes/dbh.class.php";
require_once "../classes/courses.class.php";
require_once "../classes/users.class.php";
require_once "../classes/enrollments.class.php";

require_once "../partials/header.php";
require_once "admin_dashboard.php";


$admin_id = $user['id'];
$cour = new course();
$courses = $cour->all_courses('admin', $admin_id);
// get total number of enrollment 
// we need course_id



?>

<div class="main-content">

    <h1>All Courses</h1>
    <?php
    // session delete course
   
       if(isset($_SESSION['delete_course'])){
            echo $_SESSION['delete_course'];
            unset($_SESSION['delete_course']);
       }


    ?>
    <br>

    <table class="table">
        <?php if ($courses) { ?>
            <thead>

                <th>Course Title</th>
                <th>Course Description</th>
                <th>Instructor</th>
                <th>Action</th>


            </thead>
            <tbody>
                <?php

                foreach ($courses as $course) {
                    ?>
                    <tr>
                        <td><?php echo $course['title'] ?></td>
                        <td><?php echo $course['description'] ?></td>
                        <td><?php echo $course['inst_name'] ?></td>
                        <td>
                            <div class="btn-container">
                                <form method="POST" action="<?php echo SITEURL ?>admin/delete_course.php" class="d-inline">
                                    <input type="hidden" name="course_id" value="<?php echo $course['id'] ?>">
                                    <input type="hidden" name="inst_id" value="<?php echo $course['instructor_id'] ?>">
                                    <input type="hidden" name="stu_id" value="<?php echo $student_id ?>">
                                    <input class="btn btn-danger" type="submit" name="delete" value="Delete">
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
<?php }
else{
    $_SESSION['login']="<div class='text-danger'>Please Login First</div>";
    header("location:".SITEURL);
}


?>

<?php require '../partials/footer.php'; ?>
    