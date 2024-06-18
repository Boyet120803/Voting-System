<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="candidates.php" method="post">
       <label for="">president</label>
       <input type="text"name="pres"><br>
       
       <label for="">Vice president</label>
       <input type="text"name="vice_pres"><br>

       <label for="">Secretary</label>
       <input type="text"name="sec" required><br>

       <label for="">Treasurer</label>
       <input type="text"name="treas"><br>

       <label for="">Pio</label>
       <input type="text"name="pio"><br>

       <input type="submit"value="Add">
    </form>
</body>
</html> -->

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

    body {
        text-align: center;
     
    }

    #border {
        border:1px solid;
        width:250px;
        height:500px;
        
    }

    .back a {
        font-size:15px;
        color: black;
       
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
            <!-- Sidebar-->
            <div class="border-end bg-white col-2" id="sidebar-wrapper">
                <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 AND 0 ? 'd-lock' : 'd-none') ?>" href="dashboard.php?/">Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>" href="userprofile.php">User Profile</a>  
                <a class="list-group-item list-group-item-action list-group-item-light p-3 active <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="candidates-form.php">Candidates</a>           
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="forvoters-dashboard.php?/">Voters</a>
                  
                </div>
            </div>
            <div class="container mt-5 col-md-9  <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>">
            <form action="candidates.php" method="post" class="row g-3 needs-validation" novalidate>
  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">Name of Party List</label>
    <input type="text" name="np"class="form-control" id="validationCustom01"  required>
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">President</label>
    <input type="text"name="pres" class="form-control" id="validationCustom02" required>
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Vice President</label>
    <input type="text" name="vice_pres"class="form-control" id="validationCustom02" required>
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Secretary</label>
    <input type="text"name="sec" class="form-control" id="validationCustom02" required>
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Treasurer</label>
    <input type="text" name="treas"class="form-control" id="validationCustom02"  required>
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">PIO</label>
    <input type="text"name="pio" class="form-control" id="validationCustom02" required>
  </div>
 
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Add</button>
  </div>
</form>

<div class="back">
            <a href="candidatesfetch.php">BACK</a>
           </div>

