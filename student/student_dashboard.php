<?php

require_once "../config/constant.php";
 if(isset($_SESSION["role"]) && $_SESSION['role']=='student' ){
?>
<div class="sidebar " style="height: calc(100vh - 100px);">
        <h5>DashBoard</h5>
        <ul class="nav flex-column" >
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEURL?>dashboard/dashboard.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEURL?>student/course.php">Available Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEURL?>student/enrollments.php">Enrollments</a>
            </li>
            
        </ul>
    </div>
<?php
}
else{
   $_SESSION['login']="<div class='text-danger'>Please Login First</div>";
   header("location:".SITEURL);
 }

?>