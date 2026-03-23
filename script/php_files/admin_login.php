<?php 
session_start(); //  MUST BE AT TOP

include "config.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['login'])){

    if(empty($_POST['username'])){
        echo json_encode(['error'=>'Username empty']); exit;
    }

    if(empty($_POST['password'])){
        echo json_encode(['error'=>'Password empty']); exit;
    }

    $db = new Database();
    $conn = $db->conn;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'";
    $res = mysqli_query($conn, $query);

    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        $_SESSION['admin_fullname'] = $row['admin_fullname'];

        echo json_encode(['success'=>'true']); 
    }else{
        echo json_encode(['error'=>'false']); 
    }
    exit;
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