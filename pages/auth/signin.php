<?php
require_once "auth.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (authenticate($email, $password)) {
        // Redirect users based on their role
        if ($_SESSION['user']['ROLE'] == 'customers') {
            header('Location: ../../');
        } elseif ($_SESSION['user']['ROLE'] == 'freelancers') {
            header('Location: ../../dashboard/freelancer/');
        } else {
            // Redirect to a default dashboard page or display an error message
            header('Location: ../../index');
            // echo "why?";
        }
        exit();
    } else {
        $error_message = "email atau PASSWORD salah!";
        Header('Location: ../../pages/auth/sign-in');
    }
}
