<?php 
session_start();
require_once "../classes/dbh.class.php";
require_once "../classes/courses.class.php";
require_once "../classes/users.class.php";
require_once "../classes/enrollments.class.php";
require_once "../partials/header.php";
require_once "instructor_dashboard.php";

$enroll = new enrollment();
$enrollmets=$enroll->get_enrollment($user['id']);
?>
    <div class="main-content">
        <h1>All Enrollments</h1>
        <table class="table">
            <thead>
                <th>Student Name</th>
                <th>Email</th>
                <th>Enrolled In Course</th>
            </thead>
            <?php
                if($enrollmets){
            ?>
            <tbody>
                <?php
                 foreach($enrollmets as $en){
                  $st_name=$en['name'];
                  $st_email=$en['email'];
                  $cour_title=$en['title'];
                ?>
                <tr>
                    <td><?php echo $st_name?></td>
                    <td><?php echo $st_email?></td>
                    <td><?php echo $cour_title?></td>

                </tr>

                <?php }?>

            </tbody>
            <?php
                } else{
                    echo "<div class='text-danger'> Not Enrollments</div>";
                }
            ?>

        </table>
        
    </div>

<?php require '../partials/footer.php';?>