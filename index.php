
<?php
require_once 'config/constant.php';
require 'partials/header.php';


?>
 <?php if( isset($_POST['signup'])){?>
    <div class="container">
        <div class="card mt-5 p-3 mb-2 bg-dark text-white text-center" style="margin:auto; width:30%;">
            <h3 class="text-center">SIGN UP</h3>
            <p>Don't have an account yet? Sign up here</p>
            <form action="<?php echo SITEURL?>login_sys/signup.php" method="POST">
                <input type="text" class="form-group form-control" placeholder="Username" name="username">
                <input type="password" class="form-group form-control" placeholder="Password" name="password">
                <input type="password" class="form-group form-control" placeholder="Repeat Password" name="repeatpass">
                
                <input type="text" class="form-group form-control" placeholder="E-mail" name="email">
                <select class="form-group form-control" name="role">
                    <option value="student" >Student</option>
                    <option value="instructor">Instructor</option>
                </select>
                <input type="submit" name="signup" value="SIGN UP" class=" btn btn-primary align-center">
              

            </form>
        </div>
    </div>
<?php }else {?>
 <div class="container">
        <div class="card mt-5 p-3 mb-2 bg-dark text-white text-center" style="margin:auto; width:30%;">
            <h3 class="text-center">LOGIN</h3>
            <p>Don't have an account yet? 
                    <form action="" method="POST">
                        <input type="hidden" name="signup" value="signup">
                        <button class="btn btn-link">Sign up</button>
                    </form>
            </p>
            <form action="<?php echo SITEURL?>login_sys/login.php" method="POST">
                <input type="text" class="form-group form-control" placeholder="Username" name="username">
                <input type="password" class="form-group form-control" placeholder="Password" name="password">
                <input type="submit" name="login" value="LOGIN" class=" btn btn-primary align-center">

            </form>
        </div>
    </div>
<?php }?>
    <?php require 'partials/footer.php';?>