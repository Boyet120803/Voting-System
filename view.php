
<?php 

session_start();

if(!isset($_SESSION['password']) && !isset($_SESSION['email'])){
    header('location: login-form.php');
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
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
    <link rel="stylesheet" href="userprofile.css">
</head>
<style>

   span{
    color:white;
   
   }
 

   #sidebar-wrapper {
        height: 87vh; 
    }



</style>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>">Admin</a>
                            <a class="nav-link text-white  <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>">User</a>                      
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
            <div class="border-end bg-white col-2" id="sidebar-wrapper">
                <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 AND 0 ? 'd-lock' : 'd-none') ?>" href="dashboard.php?id=<?php echo $_SESSION['ID'];?>">Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3  <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>" href="#">User Profile</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="candidatesfetch.php">Candidates</a> 
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>" href="voter-form.php">Vote now</a>             
                <a class="list-group-item list-group-item-action list-group-item-light p-3 active <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="forvoters-dashboard.php?/">Voters</a>
                </div>
            </div>
            <div class="container mt-3 col-md-9 <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>">
            <div class="container">
         <main>
        <center><h2>User Profile</h2></center>
            <form method="POST" action="crud.php" enctype="multipart/form-data">
            <?php 
                    include 'db-conn.php';
                    include 'user.php';

                    $database = new Database('localhost', 'root', '', 'new_vsystem');
                    $user = new User($database);
                    $id = $_GET['id'];
                    $data = $user->viewDatasignup($id);

                    foreach ($data as $row): ?>
                       
                    <?php endforeach; ?>
                </tbody>
                <div class="profile-info">
                    <div class="left">
                        <label for="votersfullname"><strong>Full Name:</strong></label>
                        <input type="text" id="votersfullname" value="<?php echo $row['fullname'];?>" aria-label="readonly input example" readonly>

                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" id="email"  value=" <?php echo $row['email'];?>" aria-label="readonly input example" readonly>

                        <label for="voterscardnumber"><strong>Voter's Card Number:</strong></label>
                        <input type="text" id="voterscardnumber"value=" <?php echo $row['voters_cardnum'];?>" aria-label="readonly input example" readonly>
                    </div>
                    <div class="right">
                        <label><strong>Password:</strong></label>
                        <input type="text" value=" <?php echo $row['password'];?>" aria-label="readonly input example" readonly>

                        <label for="picture"><strong>Profile Picture:</strong></label>
                        <?php 
                                        $images = $row['images'];
                                        if (!empty($images)) {
                                             echo '<img src="' . $images . '" alt="Profile Image" style="width: 180px; max-height: 130px;border-radius:20px;">';
                                         } else {
                                                echo 'No Image';
                                         }
                                 ?>
                                 <br>
                    
                       
                    </div>
                </div>
            </form>
            <a href="forvoters-dashboard.php">back</a>
    </main>
</div>
            </div>   
   </div>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>