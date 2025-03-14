<?php

require_once "../config/constant.php";
 if(isset($_SESSION["role"]) && $_SESSION['role']=='instructor' ){
require_once "../classes/dbh.class.php";
require_once "../classes/courses.class.php";
require_once "../classes/users.class.php";
require_once "../classes/enrollments.class.php";

require_once "../partials/header.php";
require_once "instructor_dashboard.php";
?>

<div class="main-content">
    <h1>Create Course</h1>
    <?php
      if (isset( $_SESSION['create-course'])) {
        echo  $_SESSION['create-course'];
        unset( $_SESSION['create-course']);
      }
    
    ?>
    <form class="form" method="POST" action="">
        <input type="hidden" name="inst_id" value="<?php echo $user['id']?>">
        <input class="form-control" type="text" name="title" placeholder="course title" >
        <br>
        <textarea  class="form-control" name="description" placeholder="course description "></textarea>
        <br>
        <input class="btn btn-primary" type="submit" value="Create Coures" name="submit">

    </form>





</div>

<?php require_once "../partials/footer.php"?>
<?php
  if(isset($_POST['submit'])){
    $instructor_id = $_POST['inst_id'];
    $title= $_POST['title'];
    $description= $_POST['description'];
    $add=new course();
    $res=$add->create_course($title,$description,$instructor_id);
    if($res){
        $_SESSION['create-course']="<div class='text-success'>Course Created Successfully</div>";
        $id=$user['id'];
        header("location:".SITEURL."instructor/instructor_courses.php?id='$id'");
    } else{
        $_SESSION['create-course']="<div class='text-danger'>Failed To Create Course</div>";
        header("location:".SITEURL."instructor/create_course.php");
    }


     


  }
}
else{
  $_SESSION['login']="<div class='text-danger'>Please Login First</div>";
  header("location:".SITEURL);
}





?>


