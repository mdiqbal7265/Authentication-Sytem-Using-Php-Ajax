<?php
include("config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$action = $_POST['action'] ?? '';

if ($action && "register" == $action) {
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $c_password = $_POST['c_password'] ?? '';

    $name = check_input($name);
    $username = check_input($username);
    $email = check_input($email);
    $password = check_input($password);
    $c_password = check_input($c_password);

    $hash_pass = sha1($password);
    $created = date('Y-m-d');

    if ($password != $c_password) {
        echo "Password did not matched!";
        exit();
    } else {
        $sql = $conn->prepare("SELECT username,email FROM users WHERE username=? OR email=?");
        $sql->bind_param("ss", $username, $email);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();

        if (isset($row['username']) && $row['username'] == $username) {
            echo "Username available try different!";
        } else if (isset($row['email']) && $row['email'] == $email) {
            echo "Email is already registread try different!";
        } else {
            $sql_stmt = $conn->prepare("INSERT INTO users (name,username,email,password,created_at) VALUES (?,?,?,?,?)");
            $sql_stmt->bind_param("sssss", $name, $username, $email, $hash_pass, $created);
            if ($sql_stmt->execute()) {
                echo "Registered Successfully. Login Now!";
            } else {
                echo "Something went wrong. Please Try again!";
            }
        }
    }
}

if ($action && "login" == $action) {
    session_start();
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $_password = sha1($password);

    $sql_login  = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $sql_login->bind_param("ss", $username, $_password);
    $sql_login->execute();
    $result = $sql_login->fetch();
    // $_password = $result['password'] ?? '';
    if ($result != NULL) {
        $_SESSION['username'] = $username;
        echo 1;
        if (!empty($_POST['rem'])) {
            setcookie('username', $username, time(10 * 365 * 24 * 60 * 60));
            setcookie('password', $password, time(10 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE['username'])) {
                setcookie("username", "");
            }
            if (isset($_COOKIE['password'])) {
                setcookie("password", "");
            }
        }
    } else {
        echo "User didn't find the database!";
    }
}

if($action && "forgot" == $action)
{
    $forgot_email = $_POST['forgot_email'];
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $forgot_email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0)
    {
        $token = bin2hex(random_bytes(10));
        $token = str_shuffle($token) ;
        $token = substr($token, 0 ,10);

        $sql = "UPDATE users SET token=?, tokenexp=DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE email=?";
        $stmt_ins = $conn->prepare($sql);
        $stmt_ins->bind_param("ss", $token, $forgot_email);
        $stmt_ins->execute();

        require 'vendor/autoload.php';

        $mail = new PHPMailer();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->Port = 2525;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = 'ef4113ce44efb0';
        $mail->Password = 'a0aff7124fdd5f';

        $mail->addAddress($forgot_email);
        $mail->setFrom('admin@admin.com','Admin');
        $mail->Subject = "Reset Your Password";
        $mail->isHTML(true);

        $mail->Body = "
        <h3>Click the below link to reset your password.</h3><br>
        <a href='http://localhost:3030/resetPassword.php?email=$forgot_email&token=$token'>Reset Password</a><br>
        <h3>Regards <br>Admin</h3>
        ";

        if($mail->send())
        {
            echo "We have send the reset link in your email ID, Please check your email.";
        }else{
            echo "Something went wrong. Please try again latter";
        }
    }else{
        echo "No email Found our Database.!";
    }
}

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}
