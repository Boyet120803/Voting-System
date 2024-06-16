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
    $votersname = $_POST["votersname"];
    $votersemailid = $_POST["votersemailid"];
    $voterscardnum = $_POST["voterscardnum"];
    $president = $_POST["president"];
    $vicepresident = $_POST["vicepresident"];
    $Secretary = $_POST["secretary"];
    $Treasurer = $_POST["treasurer"];
    $Pio = $_POST["pio"];
    $password = $_POST['password'];

    if ($user->hasVoted($votersemailid)) {
        header("Location: voter-form.php?message=already_voted");
        exit();
    } else {
        if ($user->voter($votersname, $votersemailid, $voterscardnum, $president, $vicepresident, $Secretary, $Treasurer, $Pio, $password)) {
            header("Location: voter-form.php?message=success");
            exit();
        } else {
            header("Location: voter-form.php?error");
            exit();
        }
    }
}
?>
