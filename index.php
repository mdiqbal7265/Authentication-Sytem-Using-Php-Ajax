<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        header("location: profile.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete User Registration & Login System using PHP & Ajax</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        #alert,#register-box,#forgot-box,#loader{
            display: none;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container mt-4">
        <!-- Alert Box -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4" id="alert">
                <div class="alert alert-success">
                    <strong id="result"></strong>
                </div>
            </div>
        </div>
        <!-- End Alert Box -->

        <div class="text-center">
            <img src="preload-1.gif" width="60px" height="60px" class="m-2" id="loader">
        </div>

        <!-- Login Box -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4 bg-light rounded" id="login-box">
                <h2 class="text-center mt-2">Login</h2>
                <form action="" method="post" role="form" class="p-2" id="login-form">
                    <div class="form-group">
                        <input value="<?php if(isset($_COOKIE['username'])){ echo $_COOKIE['username']; } ?>" type="text" name="username" class="form-control" placeholder="username" value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];} ?>" required autofocus> 
                    </div>
                    <br>
                    <div class="form-group">
                        <input value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>" type="password" name="password" class="form-control" placeholder="password" value="<?php if(isset($_COOKIE['pasword'])){echo $_COOKIE['pasword'];} ?>" required minlength="6"> 
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="rem" class="custom-control-input" id="custom_check">
                            <label for="custom_check" class="custom-control-label" <?php isset($_COOKIE['username']) ? 'checked' : '' ?>>Remember me</label>
                            <a href="#" id="forgot_link" class="float-end">Forgot Password?</a>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Login" name="login" id="login">
                    </div>
                    <div class="form-group">
                        <p class="text-center">New User? <a href="#" id="register_link">Register Here</a></p>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Login Box -->

        <!-- Register Box -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4 bg-light rounded" id="register-box">
                <h2 class="text-center mt-2">Register</h2>
                <form action="" method="post" role="form" class="p-2" id="register-form">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Full name" id="" required> 
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" id="" required autofocus> 
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" id="" required autofocus> 
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="pass" required minlength="6"> 
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="password" name="c_password" class="form-control" placeholder="Confirm password" id="cpass" required minlength="6"> 
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="rem" class="custom-control-input" id="custom_check2">
                            <label for="custom_check2" class="custom-control-label">I agree to the <a href="#">terms & condition</a></label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Register" name="register" id="register">
                    </div>
                    <div class="form-group">
                        <p class="text-center">Already Registered? <a href="#" id="login_link">Login Here</a></p>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Register Box -->

        <!-- Forgot Password Box -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4 bg-light rounded" id="forgot-box">
                <h2 class="text-center mt-2">Reset Password </h2>
                <form action="" method="post" role="form" class="p-2" id="forgot-form">
                    <div class="form-group">
                        <small class="text-muted">
                            To reset your password, enter the email address and we will send reset password instructions on your email.
                        </small>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="email" name="forgot_email" class="form-control" placeholder="Email" id="" required> 
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Reset" name="forgot" id="forgot">
                    </div>
                    <div class="form-group text-center">
                        <a href="#" id="back_link">Back</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Forgot password box -->





<!-- Javascript file -->
<script src="js/jquery.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/script.js"></script>
</body>
</html>