 <?php
 session_start();
 include 'classes/dbh.class.php';
 require_once "classes/users.class.php";
 $user_name=$_SESSION['name'];
 $userobj=new users();
 $user=$userobj->get_user_by_name($user_name);
 $role=$user['role'];
 if($role=='admin'){
require_once 'admin/admin.php';

    ?>


<?php
 }else if($role== 'student'){
    require_once 'student/student.php';
?>


<?php
 }
 else if($role== 'instructor'){
    require_once 'instructor/instructor.php';
 }
?>


<?php
 require_once "partials/footer.php";
 ?>