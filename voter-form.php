
<?php 

session_start();

if(!isset($_SESSION['password']) && !isset($_SESSION['email'])){
    header('location: login-form.php');
}
if(isset($_GET['message'])){
    $error = $_GET['message'];
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
    .container{
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .forvoters{
        position:absolute;
        top:20%;
        left:80%;
        border:1px solid;
        padding:50px;
        height:200px;
        width:200px;
        display:flex;
        align-items:center;
        justify-content:center;
        box-shadow:1px 1px 1px 1px red;
        overflow:hidden;
    }
    .forcandidates{
        overflow-y: scroll;
        width:65%;
        position:absolute;
        top:10%;
        left:34%;
        height:580px;
    }
    .jandel img{
      height:200px;
    }
    .ungo{       
        display:flex;
        align-items:center;
        gap:40%;
    }
    .radio{
        margin-left:70px;
       
    }
   
    h3{
       margin-left:300px;
    }

    .one{
        color:blue;
         margin-left:170px;
         
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
            <!-- Sidebar-->
            <div class="border-end bg-white col-2" id="sidebar-wrapper">
                <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 AND 0 ? 'd-lock' : 'd-none') ?>" href="dashboard.php?id=<?php echo $_SESSION['ID'];?>">Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="userprofile.php">User Profile</a> 
                <a class="list-group-item list-group-item-action list-group-item-light p-3 active <?php echo($role == 0 ? 'd-lock' : 'd-none') ?>" href="voter-form.php">Vote now</a>             
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo($role == 1 ? 'd-lock' : 'd-none') ?>" href="forvoters-dashboard.php?/">Voters</a>
                </div>
            </div>
            <form action="voter.php" method="post" enctype="multipart/form-data">  
                 
    <h1 class="text-center" ></h1>
        <div class="container">
          <div class="forvoters"hidden>   
             <div class="vote">
                <label for="">Voter's fullname:</label><br>
                <input type="text" name="votersname" placeholder="Enter Your Fullname" value="<?php echo $_SESSION['fullname']; ?>"><br>

                <label for="">Voter's Registered Email ID:</label>
                <input type="email"name="votersemailid" placeholder="Enter Your Email ID"value="<?php echo $_SESSION['email']; ?>"><br>
                <label for="">Voter's Card Number:</label>
                <input type="text"name="voterscardnum" value="<?php echo $_SESSION['voterscardnumber']; ?>" placeholder="Enter Your Voter Unique ID"><br> 
                <label for="">Image:</label>
                <input type="file"name="image" value="<?php echo $_SESSION['Image']; ?>"><br> 
                <label for="">Password:</label>
                <input type="text"name="password" value="<?php echo $_SESSION['password']; ?>"><br>   
            </div>
           </div>
           <?php 
include 'db-conn.php';
include 'user.php';

$database = new Database('localhost', 'dfoiwidm_voting-system-oop', 'voting-system-oop', 'dfoiwidm_voting-system-oop');
$user = new User($database);
$data = $user->candidatesvote();
?>
   
<div class="forcandidates">
<div class="alert alert-danger text-center <?php echo($error == "already_voted" ? 'd-block' : 'd-none') ?> " role="alert">
                   This user was already voted!
     </div> 
     <h2 class="one">Please Vote Wisely</h2>
    <h3>President</h3><br>
    <div class="ungo">
        <div class="jandel">
            <img src="images/wmicon.png">
            <select name="president">
                <?php foreach ($data as $row): ?>
                    <option value="<?php echo $row['president']; ?>" ><?php echo $row['president']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
   
    <h3>Vice President</h3><br>
    <div class="ungo">
        <div class="jandel">
            <img src="images/mnicon.png">
            <select name="vicepresident">
                <?php foreach ($data as $row): ?>
                    <option value="<?php echo $row['vice_president']; ?>"><?php echo $row['vice_president']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <h3>Secretary</h3><br>
    <div class="ungo">
        <div class="jandel">
            <img src="images/mnicon.png">
            <select name="secretary">
                <?php foreach ($data as $row): ?>
                    <option value="<?php echo $row['secretary']; ?>"><?php echo $row['secretary']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <h3>Treasurer</h3><br>
    <div class="ungo">
        <div class="jandel">
            <img src="images/wmicon.png">
            <select name="treasurer">
                <?php foreach ($data as $row): ?>
                    <option value="<?php echo $row['treasurer']; ?>"><?php echo $row['treasurer']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <h3>Pio</h3><br>
    <div class="ungo">
        <div class="jandel">
            <img src="images/wmicon.png">
            <select name="pio">
                <?php foreach ($data as $row): ?>
                    <option value="<?php echo $row['pio']; ?>"><?php echo $row['pio']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <input type="submit" value="Submit Votes">
    <a href="index.php">Back</a>
</div>

    </form>

 </div>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>