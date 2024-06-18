<?php

class User {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }



    public function voter($votersname, $votersemailid, $voterscardnum, $president, $vicepresident, $Secretary, $Treasurer, $Pio, $password) {
        $sql = "INSERT INTO users (voters_fullname, voters_registered_email_id, voters_card_number, president, vice_president, secretary, treasurer, pio,password) VALUES ('$votersname', '$votersemailid', '$voterscardnum', '$president', '$vicepresident', '$Secretary', '$Treasurer', '$Pio', '$password')";
        return $this->db->executeQuery($sql);
    }

 
    //login user
    public function login($email, $password) {
        $sql = "SELECT * FROM signup WHERE email = '$email' AND password = '$password'";
        $result = $this->db->executeQuery($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($user['password'] == $password && $user['email'] == $email) {
                $_SESSION['ID'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['voterscardnumber'] = $user['voters_cardnum'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['Image'] = $user['images'];
                $_SESSION['Role'] = $user['role'];
                return true;
            }
        }
        return false;
    }

   
    
    public function fetchData() {
        $sql = "SELECT * FROM users";
        $result = $this->db->executeQuery($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }


//delete for signup
public function delete($id)
{
    $conn = $this->db->getConnection();
    $sql = "DELETE FROM signup WHERE id=$id";
    return $conn->query($sql);
}

//for candidates
public function deletecandidates($id)
{
    $conn = $this->db->getConnection();
    $sql = "DELETE FROM candidates WHERE id=$id";
    return $conn->query($sql);
}

//user update 

public function getUserById($id) {
    $conn = $this->db->getConnection();
    $sql = "SELECT * FROM signup WHERE id = '$id'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

public function userupdate($fullname, $email, $voterscardnumber, $password, $id, $images = null) {
    $conn = $this->db->getConnection();
    $sql = "UPDATE signup SET fullname = '$fullname', email = '$email', voters_cardnum = '$voterscardnumber', password = '$password'";
    if ($images) {
        $sql .= ", images = '$images'";
    }
    $sql .= " WHERE id = '$id'";
    return $conn->query($sql);
}

//for admin usersignup
public function adminsignupUserById($id) {
    $conn = $this->db->getConnection();
    $sql = "SELECT * FROM signup WHERE id = '$id'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

public function adminusersignup($fullname, $email, $voterscardnumber, $password, $id, $images = null) {
    $conn = $this->db->getConnection();
    $sql = "UPDATE signup SET fullname = '$fullname', email = '$email', voters_cardnum = '$voterscardnumber', password = '$password'";
    if ($images) {
        $sql .= ", images = '$images'";
    }
    $sql .= " WHERE id = '$id'";
    return $conn->query($sql);
}

//signup 
public function signup($role, $fullname, $email, $voterscardnum, $password, $age, $images = null) {
    if ($age < 18) {
        return false; 
    }
    $sql = "INSERT INTO signup (role, fullname, email, voters_cardnum, password, ages, images) VALUES ('$role', '$fullname', '$email', '$voterscardnum', '$password', '$age', '$images')";
    return $this->db->executeQuery($sql);
}

 
public function fetchDatasignup($id) {
    $sql = "SELECT * FROM signup where id = $id";
    $result = $this->db->executeQuery($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

//viewforusersignup

public function viewDatasignup($id) {
    $sql = "SELECT * FROM signup where id = $id";
    $result = $this->db->executeQuery($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

public function fetchDataAll() {
    $sql = "SELECT * FROM signup where role = '1'";
    $result = $this->db->executeQuery($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

//forcandidates

public function fetchDataAllcandidates() {
    $sql = "SELECT * FROM candidates";
    $result = $this->db->executeQuery($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

//hingvote for president

public function president() {
    $sql = "SELECT president, COUNT(*) as count FROM users GROUP BY president ORDER BY count DESC LIMIT 1";
    $result = $this->db->executeQuery($sql);
    $highestPresident = $result->fetch_assoc();

    $sql = "SELECT president, COUNT(*) as count FROM users GROUP BY president ORDER BY count ASC LIMIT 1";
    $result = $this->db->executeQuery($sql);
    $lowestPresident = $result->fetch_assoc();

    $data = array(
        'highest' => $highestPresident,
        'lowest' => $lowestPresident
    );

    return $data;
}

//hingvote for vicepresident

public function vicepresident() {
    $sql = "SELECT vice_president, COUNT(*) as count FROM users GROUP BY vice_president ORDER BY count DESC LIMIT 1";
    $result = $this->db->executeQuery($sql);
    $highestvicePresident = $result->fetch_assoc();  
    $sql = "SELECT vice_president, COUNT(*) as count FROM users GROUP BY vice_president ORDER BY count ASC LIMIT 1";
    $result = $this->db->executeQuery($sql);
    $lowestvicePresident = $result->fetch_assoc();

    $data = array(
        'highest' => $highestvicePresident,
        'lowest' => $lowestvicePresident
    );

    return $data;
}

//for secretary

public function secretary() {

    $sql = "SELECT secretary, COUNT(*) as count FROM users GROUP BY secretary ORDER BY count DESC LIMIT 1";
    $result = $this->db->executeQuery($sql);
    $highestsecretary = $result->fetch_assoc();

  
    $sql = "SELECT secretary, COUNT(*) as count FROM users GROUP BY secretary ORDER BY count ASC LIMIT 1";
    $result = $this->db->executeQuery($sql);
    $lowestvicesecretary = $result->fetch_assoc();

    $data = array(
        'highest' => $highestsecretary,
        'lowest' => $lowestvicesecretary
    );

    return $data;
}

// for treasurer 

public function treasurer() {
    $sql = "SELECT treasurer, COUNT(*) as count FROM users GROUP BY treasurer ORDER BY count DESC LIMIT 1";
    $result = $this->db->executeQuery($sql);
    $highesttreasurer = $result->fetch_assoc();

  
    $sql = "SELECT treasurer, COUNT(*) as count FROM users GROUP BY treasurer ORDER BY count ASC LIMIT 1";
    $result = $this->db->executeQuery($sql);
    $lowestvicetreasurer = $result->fetch_assoc();

    $data = array(
        'highest' => $highesttreasurer,
        'lowest' => $lowestvicetreasurer
    );

    return $data;
}

//pio 

public function pio() {
    $sql = "SELECT pio, COUNT(*) as count FROM users GROUP BY pio ORDER BY count DESC LIMIT 1";
    $result = $this->db->executeQuery($sql);
    $highestpio = $result->fetch_assoc();


    $sql = "SELECT pio, COUNT(*) as count FROM users GROUP BY pio ORDER BY count ASC LIMIT 1";
    $result = $this->db->executeQuery($sql);
    $lowestpio = $result->fetch_assoc();

    $data = array(
        'highest' => $highestpio,
        'lowest' => $lowestpio
    );

    return $data;
}
public function candidatesvote() {
    $sql = "SELECT * FROM candidates";
    $result = $this->db->executeQuery($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

public function candidates( $president, $v_pres,$secre, $treasur,$pio,$partylist,) {
    $sql = "INSERT INTO candidates (president,vice_president,secretary,treasurer,pio,n_partylist) VALUES ('$president', '$v_pres','$secre', '$treasur', '$pio','$partylist,')";
    return $this->db->executeQuery($sql);
}
//check kung kani nga gmail nag balik2
public function checkemail($email) {
    $sql = "SELECT COUNT(*) as count FROM signup WHERE email = '$email'";
    $result = $this->db->executeQuery($sql);
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}

//check kung ang user kay voted na
public function hasVoted($votersemailid) {
    $sql = "SELECT COUNT(*) as count FROM users WHERE voters_registered_email_id = '$votersemailid'";
    $result = $this->db->executeQuery($sql);
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}



}

?>
