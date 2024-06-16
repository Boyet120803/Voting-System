


<?php 
session_start();

if(isset($_GET['/'])){
    $error = $_GET['/'];
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row mt-5">
                   <div class="alert alert-danger text-center <?php echo($error == "Not-Eligible-To-Vote" ? 'd-block' : 'd-none') ?> " role="alert">
                   Only for those 18 years and older.
                    </div>  
    <div class="alert alert-info text-center <?php echo($error == "Signup-Successfully" ? 'd-block' : 'd-none') ?> " role="alert">
                   Signup-Successfully
                </div> 
        <div class="offset-md-4 col-md-4 d-flex align-items-center justify-content-center border border-primary rounded-3 p-4">
             
            <form action = "signup.php" method = "POST" enctype="multipart/form-data">
                <div class="mb-3">              
                    <label for="exampleInputEmail1" class="form-label"></label>
                  <select name="role"hidden>
                    <option value="1">User</option>
                  </select>              
                </div>
                <div class="mb-3">  
                    <div class="alert alert-danger text-center <?php echo($error == "Fullname-Required" ? 'd-block' : 'd-none') ?> " role="alert">
                       Fullname Required
                    </div>               
                    <label for="exampleInputEmail1" class="form-label">Fullname</label>
                    <input type="text" name="fullname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>                 
                </div>
                <div class="mb-3">    
                    <div class="alert alert-danger text-center <?php echo($error == "email-required" ? 'd-block' : 'd-none') ?> " role="alert">
                     Email Required
                    </div>      
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>                 
                </div>
                <div class="mb-3">   
                    <div class="alert alert-danger text-center <?php echo($error == "Age-required" ? 'd-block' : 'd-none') ?> " role="alert">
                     Age Required
                    </div>      
                    <label for="exampleInputEmail1" class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>                 
                </div>
                <div class="mb-3">      
                    <div class="alert alert-danger text-center <?php echo($error == "Voterscardnumber-required" ? 'd-block' : 'd-none') ?> " role="alert">
                    Voters Cardnumber Required
                    </div>          
                    <label for="exampleInputEmail1" class="form-label">Voters Number</label>
                    <input type="text" name="voterscardnum" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>                 
                </div>
                <div class="mb-3"> 
                    <div class="alert alert-danger text-center <?php echo($error == "Image-required" ? 'd-block' : 'd-none') ?> " role="alert">
                      Image Required
                    </div>             
                    <label for="exampleInputEmail1" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>                 
                </div>
                <div class="mb-3">
                    <div class="alert alert-danger text-center <?php echo($error == "password-required" ? 'd-block' : 'd-none') ?> " role="alert">
                      Password Required
                    </div> 
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password"class="form-control" id="exampleInputPassword1">
                       
                    </div>
                    <div class="d-grid gap-2 col-12 mt-3">
                            <input class="btn btn-primary" type="submit" value="Signup">
                            <a href="index.php" class="btn btn-secondary" type="button">Back</a>
                    </div>
            
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>