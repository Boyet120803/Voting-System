<?php

include 'db-conn.php';
include 'user.php';

$host = 'localhost';
$username = 'dfoiwidm_voting-system-oop';
$password = 'voting-system-oop';
$database = 'dfoiwidm_voting-system-oop';

$db = new Database($host, $username, $password, $database);

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST["role"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $voterscardnum = $_POST["voterscardnum"];
    $password = $_POST['password'];
 

    $images = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $imageName = basename($_FILES['image']['name']);
        $targetPath = $targetDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $images = $targetPath;
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image uploaded.";
    }
      
    if (empty($fullname)) {
        header('Location: signup-form.php?/=Fullname-Required');
        exit();
    } elseif (empty($password)) {
        header('Location: signup-form.php?/=password-required');
        exit();
    }elseif (empty($email)) {
        header('Location: signup-form.php?/=email-required');
        exit();
    }elseif (empty($voterscardnum)) {
        header('Location: signup-form.php?/=Voterscardnumber-required');
        exit();
    }elseif (empty($images)) {
        header('Location: signup-form.php?/=Image-required');
        exit();
    }

    if ($user->checkemail($email)) {
        header("Location: signup-form.php?message=This_email_is_already_used.");
        exit();
    } else {
    if ($user->signup($role,$fullname, $email, $voterscardnum, $password, $images)) {
        
        header("Location: signup-form.php?/=Signup-Successfully");
        exit();
    } else {
        header("Location: signup-form.php?/=something-wrong-with-your-signup");
        exit();
    }
}
}
?>
