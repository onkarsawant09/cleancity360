<?php
session_start();

// REGISTER
if (isset($_POST['register'])) {
    $_SESSION['name'] = $_POST['reg_name'];
    $_SESSION['email'] = $_POST['reg_email'];
    $_SESSION['password'] = $_POST['reg_password'];
    $_SESSION['address'] = $_POST['reg_address'];
    $_SESSION['gender'] = $_POST['gender'];

    echo "<script>alert('Registration Successful! Now you can login.'); window.location.href='index.html';</script>";
    exit();
}

// LOGIN
if (isset($_POST['login'])) {
    $enteredEmail = $_POST['login_email'] ?? '';
    $enteredPhone = $_POST['login_phone'] ?? '';
    $enteredPassword = $_POST['login_password'];

    if (isset($_SESSION['email']) && $enteredEmail === $_SESSION['email']) {
        if ($enteredPassword === $_SESSION['password']) {
            header("Location: backup.php");
            exit();
        } else {
            echo "<script>alert('Invalid Password!'); window.location.href='index.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('No account found! Please register.'); window.location.href='index.html';</script>";
        exit();
    }
}
?>
