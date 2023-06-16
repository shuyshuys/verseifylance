<?php
include('auth.php');
$email = $_POST['email'];
$user = $_POST['username'];
$pass = $_POST['password'];
$role = $_POST['role'];
$fullname = $_POST['fullname'];
echo 'tes';
if (empty($user) || empty($pass)) {
    $error_message = "USERNAME atau PASSWORD tidak boleh kosong!";
    echo $error_message;
} else if (register($email, $user, $pass, $role, $fullname)) {
    header('Location: sign-in');
    exit();
}
