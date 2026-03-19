<?php 
    include "config.php";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    //admin login script
   if(isset($_POST['login'])){
    if(!isset($_POST['username']) || empty($_POST['username'])){
        echo json_encode(array('error'=>'Username empty')); exit;
    }else if(!isset($_POST['password']) || empty($_POST['password'])){
        echo json_encode(array('error'=>'Password empty')); exit;
    }else{

        $db = new Database();
        $username = $_POST['username'];
$password = $_POST['password'];

        $conn = $db->conn;

$query = "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'";
$res = mysqli_query($conn, $query);

if(mysqli_num_rows($res) > 0){
    session_start();
    $row = mysqli_fetch_assoc($res);
    $_SESSION['admin_fullname'] = $row['admin_fullname'];
    echo json_encode(['success'=>'true']); 
    exit;
}else{
    echo json_encode(['error'=>'false']); 
    exit;
}

        if(!empty($result)){
            session_start();
            $_SESSION['admin_fullname'] = $result[0]['admin_fullname'];
            echo json_encode(array('success'=>'true')); exit;
        }else{
            echo json_encode(array('error'=>'false')); exit;
        }
    }
}

    //admin logout script
    if(isset($_POST['logout'])){
        /* session start */
        session_start();
        /* remove all session variable */
        session_unset();
        /* destroy the session */
        session_destroy();

        echo '1'; exit;
    }








?>