<?php
include 'db-conn.php';
include 'user.php';

$host = 'localhost';
$username = 'dfoiwidm_voting-system-oop';
$password = 'voting-system-oop';
$database = 'dfoiwidm_voting-system-oop';

session_start();

$db = new Database($host, $username, $password, $database);
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    if (empty($email) && empty($password)) {
        header('Location: login-form.php?/=Email-and-Password-Required');
        exit();
    } elseif (empty($email)) {
        header('Location: login-form.php?/=email-required');
        exit();
    } elseif (empty($password)) {
        header('Location: login-form.php?/=password-required');
        exit();
    }

    $loggedInUser = $user->login($email, $password);

    if ($loggedInUser) {
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: login-form.php?/=Incorrect-Email-or-Password");
        exit();
    }
}
?>
