<?php 
require 'config.php';

$msg = '';
if(isset($_GET['email']) && isset($_GET['token']))
{
    $email = $_GET['email'];
    $token = $_GET['token'];

    $sql = "SELECT id FROM users WHERE email=? AND token=? AND token<>'' AND tokenexp>NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$email,$token);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        if(isset($_POST['submit']))
        {
            $newpassword = sha1($_POST['new_password']);
            $cnewpassword = sha1($_POST['cnew_password']);
            if($newpassword == $cnewpassword){
                $sql = "UPDATE users SET token='', password=? WHERE email=?";
                $stmt_u = $conn->prepare($sql);
                $stmt_u->bind_param("ss",$newpassword,$email);
                $stmt_u->execute();
                $msg = "Password changed successfully.! <br> <a href='index.php' class='btn btn-success'>Login Here</a>";
            }else{
                $msg = "Password and confirm password didn't match";
            }
        }
    }else{
        header("location:index.php");
        exit();
    }
}else{
    header("location:index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 mt-5">
                <h3 class="text-center bg-dark text-light p-2 rounded">
                    Reset Your Password here!
                </h3>
                <h4 class="text-center text-success"><?= $msg; ?></h4>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="password">Enter New Password</label>
                        <input type="password" name="new_password" class="form-control" placeholder="New Password" require>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Enter New Password</label>
                        <input type="password" name="cnew_password" class="form-control" placeholder="Confirm New Password" require>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Reset Password" name="submit" class="btn btn-success btn-block"> 
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Javascript file -->
<script src="js/jquery.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/script.js"></script>
</body>
</html>