<?php
require_once "../config/constant.php";
if (isset($_SESSION["role"]) && $_SESSION['role'] == 'instructor') {
    ?>
    <div class="sidebar " style="height: calc(100vh - 100px);">
        <h5>DashBoard</h5>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEURL ?>dashboard/dashboard.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                    href="<?php echo SITEURL ?>instructor/instructor_courses.php?id=<?php echo $user['id'] ?>">Courses</a>

            <li class="nav-item">
                <a class="nav-link"
                    href="<?php echo SITEURL ?>instructor/enrollments.php?id=<?php echo $user['id'] ?>">Enrollments</a>
            </li>

        </ul>
    </div>
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