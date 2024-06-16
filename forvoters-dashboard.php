<?php 
session_start();

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
</head>
<style>

   span{
    color:white;
   
   }
   .name{
    position: absolute;
    left:40%;
    color:white;
    font-size:25px;
   }
   .student i{
    font-size:40px;
    position: absolute;
    top:28%;
    left:80%;
    color:white;
   }
   #sidebar-wrapper {
        height: 87vh; 
    }

</style>
<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <h5 class="name"> </h5>
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
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 AND 0 ? 'd-lock' : 'd-none') ?>" href="dashboard.php?/">Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>" href="userprofile.php">User Profile</a>  
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="candidatesfetch.php">Candidates</a>           
                <a class="list-group-item list-group-item-action list-group-item-light p-3 active <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="forvoters-dashboard.php?/">Voters</a>
                  
                </div>
            </div>
            <div class="container mt-2 col-md-9">
            <table class="table table-hover">
                <thead>
                    <tr>
                      
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>       
                        <th scope="col">Voter's Card Number</th>   
                        <th scope="col">Image</th>   

                       
                        <th scope="col">Action</th>     
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include 'db-conn.php';
                    include 'user.php';

                    $database = new Database('localhost', 'dfoiwidm_voting-system-oop', 'voting-system-oop', 'dfoiwidm_voting-system-oop');
                    $user = new User($database);
                    $data = $user->fetchDataAll();

                    foreach ($data as $row): ?>
                        <tr>
                          
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['email']; ?></td>  
                            <td><?php echo $row['voters_cardnum']; ?></td>
                            <td> <?php 
                                        $images = $row['images'];
                                        if (!empty($images)) {
                                             echo '<img src="' . $images . '" alt="Profile Image" style="max-width: 60px; max-height: 60px;border-radius:50px;">';
                                         } else {
                                                echo 'No Image';
                                         }
                                 ?></td>                      
                            <td><a href="viewforadmin.php?id=<?php echo $row['id'] ?>">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                            </a>
                            <td><a  href="crud.php?delete=<?php echo $row['id'] ?>">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round" color="red" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </a> 
                            <td><a href="view.php?id=<?php echo $row['id'] ?>">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                            </a>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>  
   </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
