<?php 
session_start();
if(isset($_SESSION['Role'])){
    $role = $_SESSION['Role'];
}

if(!isset($_SESSION['password']) && !isset($_SESSION['email'])){
    header('location: login-form.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<style>
   body {
       margin: 0;
       padding: 0;
       height: 100vh;
       overflow: hidden;
   }
   span {
       color: white;
   }
   .name {
       position: absolute;
       left: 40%;
       color: white;
       font-size: 25px;
   }

   #sidebar-wrapper {
       height: 87vh; 
       overflow: hidden;
   }
   .Main {
       height: 87vh;
       overflow-y: auto;
   }


</style>
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>">Admin</a>
                            <a class="nav-link text-white  <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>">User</a>                      
                        </li>
                      
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="btn btn-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php 
                                            $imagePath = $_SESSION['Image'];
                                            if (!empty($imagePath)) {
                                                echo '<img src="' . $imagePath . '" alt="Profile Image" style="width: 50px; max-height: 50px;border-radius:40px;">';
                                            } else {
                                                echo 'No Image';
                                            }
                                        ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="logout.php">logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white col-2" id="sidebar-wrapper">
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3 active <?php echo($role == 1 AND 0 ? 'd-lock' : 'd-none') ?>" href="dashboard.php?id=<?php echo $_SESSION['ID'];?>">Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>" href="userprofile.php?id=<?php echo $_SESSION['ID'];?>">User Profile</a>    
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>" href="voter-form.php">Vote now</a>    
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="candidatesfetch.php">Candidates</a>     
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="forvoters-dashboard.php?/">Voters</a>
            </div>
        </div>
        <div class="container mt-3 col-md-9 text-center <?php echo($role == 1 AND 0 ? 'd-lock' : 'd-none') ?>">
               <h1>Welcome  <?php   echo $_SESSION['fullname'];  ?></h1>
            </div>
        <div class="container mt-3 col-md-9 <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>">
          
          
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
