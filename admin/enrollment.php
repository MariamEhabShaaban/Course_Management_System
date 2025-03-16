<?php

require_once("../config/constant.php");

if (isset($_SESSION["role"]) && $_SESSION['role'] == 'admin') {

    require_once "../classes/dbh.class.php";
    require_once "../classes/courses.class.php";
    require_once "../classes/users.class.php";
    require_once "../classes/enrollments.class.php";

    require_once "../partials/header.php";
    require_once "admin_dashboard.php";


    $admin_id = $user['id'];
    $enroll = new enrollment();
    $enrollments = $enroll->get_all_enrollment();
   


    ?>

    <div class="main-content">

        <h1>All Enrollments</h1>
        <?php
        // session delete enroll
    
        if (isset($_SESSION['delete_enroll'])) {
            echo $_SESSION['delete_enroll'];
            unset($_SESSION['delete_enroll']);
        }


        ?>
        <br>

        <table class="table">
            <?php if ($enrollments) { ?>
                <thead>

                    <th>Student name</th>
                    <th>Email</th>
                    <th>Course Title</th>
                    <th>Action</th>


                </thead>
                <tbody>
                    <?php

                    foreach ($enrollments as $enrollment) {
                        ?>
                        <tr>
                            <td><?php echo $enrollment['name'] ?></td>
                            <td><?php echo $enrollment['email'] ?></td>
                            <td><?php echo $enrollment['title'] ?></td>
                            <td>
                                <div class="btn-container">
                                    <form method="POST" action="<?php echo SITEURL ?>admin/delete_enrollment.php" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $enrollment['id'] ?>">
                                        <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                                    </form>
                                </div>
                            </td>



                        </tr>
                    <?php }
            } else {
                echo "<div class='text-danger'>No Enrollments</div>";
            } ?>
            </tbody>
        </table>
    </div>
<?php } else {
    if (isset($_SESSION["role"])) {
        $_SESSION['login'] = "<div class='text-danger'>No Permission</div>";
        header("location:" . SITEURL . "dashboard/dashboard.php");
    } else {
        $_SESSION['login'] = "<div class='text-danger'>Please Login First</div>";
        header("location:" . SITEURL);
    }
}


?>

<?php require '../partials/footer.php'; ?>