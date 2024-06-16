<?php 
// session_start();

// include 'db-conn.php';
// include 'user.php';

// $host = 'localhost';
// $username = 'root';
// $password = '';
// $database = 'new_vsystem';

// $db = new Database($host, $username, $password, $database);
// $users = new User($db);



// if (isset($_POST['update'])) {   
  
//     $votersfullname = $_POST['votersfullname'];
//     $email = $_POST['email'];
//     $voterscardnumber = $_POST['voterscardnumber'];
//     $password = $_POST['password'];
//     $id = $_POST['id'];

//      $users->userupdate($votersfullname,$email,$voterscardnumber,$password,$id);

//      header("location:userform-edit.php?updatedsuccessfully");
// }




session_start();
include 'db-conn.php';
include 'user.php';

$database = new Database('localhost', 'root', '', 'new_vsystem');
$user = new User($database);
//for user candidates
if (isset($_GET['deletecandidatessuccesfully'])) {
    $id = $_GET['deletecandidatessuccesfully'];
    $user->deletecandidates($id);

    header("location:candidatesfetch.php?deletesuccessfully");
}
//for user signup
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $user->delete($id);

    header("location:forvoters-dashboard.php?deletesuccessfully");
}





if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $voterscardnumber = $_POST['voterscardnumber'];
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

    $update = $user->userupdate($fullname, $email, $voterscardnumber, $password, $id, $images);

    if ($update) {
        header("Location: userprofile.php?/=update_successfully!");
        exit();
    } else {
        header("Location: userform-edit.php?update_failed");
        exit();
    }
}

//update for admin-signup

if (isset($_POST['adminupdate'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $voterscardnumber = $_POST['voterscardnumber'];
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

    $update = $user->adminusersignup($fullname, $email, $voterscardnumber, $password, $id, $images);

    if ($update) {
        $_SESSION["success_message"] = "Update Successful";
        header("Location: viewforadmin.php?id=$id");
        exit();
    } else {
        $_SESSION["error_message"] = "Update Failed";
        header("Location:viewforadmin.php");
        exit();
    }
}



?>