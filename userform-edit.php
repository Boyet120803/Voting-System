<?php 
session_start();
include 'db-conn.php';
include 'user.php';

if(!isset($_SESSION['password']) && !isset($_SESSION['email'])){
    header('location: login-form.php');
    exit();
}

$database = new Database('localhost', 'dfoiwidm_voting-system-oop', 'voting-system-oop', 'dfoiwidm_voting-system-oop');
$user = new User($database);
$id = $_SESSION['ID'];
$data = $user->getUserById($id); 
$role = isset($_SESSION['Role']) ? $_SESSION['Role'] : 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="userprofile.css">
</head>
<style>
   span { color:white; }
   #sidebar-wrapper { height: 87vh; }
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>">Admin</a>
                    <a class="nav-link text-white <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>">User</a>                      
                </li>
            </ul>
        </div>
        <div class="dropdown">
            <a class="btn btn-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav> 

<div class="d-flex" id="wrapper">
    <div class="border-end bg-white col-2" id="sidebar-wrapper">
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 AND 0 ? 'd-lock' : 'd-none') ?>" href="dashboard.php?id=<?php echo $_SESSION['ID'];?>">Dashboard</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3  active <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>" href="#">User Profile</a>             
            <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="forvoters-dashboard.php?/">Voters</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>" href="voter-form.php">Vote now</a>
        </div>
        
    </div>
    <div class="container mt-3 col-md-9 <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>">
        <div class="container">
            <main>
                <center><h2>User Profile</h2></center>
                <form method="POST" action="crud.php" enctype="multipart/form-data">
                    <div class="profile-info">
                        <div class="left">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" required>
                            <label for="fullname"><strong>Full Name:</strong></label>
                            <input type="text" name="fullname" value="<?php echo $data['fullname']; ?>" required>

                            <label for="email"><strong>Email:</strong></label>
                            <input type="email" name="email" value="<?php echo $data['email']; ?>" required>

                            <label for="voterscardnumber"><strong>Voter's Card Number:</strong></label>
                            <input type="text" name="voterscardnumber" value="<?php echo $data['voters_cardnum']; ?>" required>

                            <label for="password"><strong>Password:</strong></label>
                            <input type="password" name="password" value="<?php echo $data['password']; ?>" required>
                            <label for="picture"><strong>Profile Picture:</strong></label>
                            <?php 
                                $images = $data['images'];
                                if (!empty($images)) {
                                    echo '<img src="' . $images . '" alt="Profile Image" style="width: 180px; max-height: 130px;border-radius:20px;">';
                                } else {
                                    echo 'No Image';
                                }
                            ?>
                            <br>
                            <input type="file" id="picture" name="image">
                        </div>
                        <div class="center">
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
