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
    $st = new users();
    $students = $st->get_all_student();
    // print_r($students);
// exit;




    ?>

    <div class="main-content">

        <h1>All Students</h1>
        <?php
        // session delete course
    
        if (isset($_SESSION['delete_student'])) {
            echo $_SESSION['delete_student'];
            unset($_SESSION['delete_student']);
        }


        ?>
        <br>

        <table class="table">
            <?php if ($students) { ?>
                <thead>

                    <th>Student name</th>
                    <th>Email</th>
                    <th>Action</th>


                </thead>
                <tbody>
                    <?php

                    foreach ($students as $student) {
                        ?>
                        <tr>
                            <td><?php echo $student['name'] ?></td>
                            <td><?php echo $student['email'] ?></td>
                            <td>
                                <div class="btn-container">
                                    <form method="POST" action="<?php echo SITEURL ?>admin/delete_student.php" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $student['id'] ?>">
                                        <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                                    </form>
                                </div>
                            </td>



                        </tr>
                    <?php }
            } else {
                echo "<div class='text-danger'>No Students Available</div>";
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