<?php

include 'db-conn.php';
include 'user.php';

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'new_vsystem';

$db = new Database($host, $username, $password, $database);

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $president = $_POST["pres"];
    $v_pres = $_POST["vice_pres"];
    $secre = $_POST["sec"];
    $treasur = $_POST['treas'];
    $pio = $_POST['pio'];
    $partylist = $_POST["np"];
   

    if ($user->candidates($president, $v_pres, $secre, $treasur, $pio,$partylist)) {
        
        header("Location: candidates-form.php?message=success");
        exit();
    } else {
        header("Location: signup-form.php?error");
        exit();
    }
}

?>

