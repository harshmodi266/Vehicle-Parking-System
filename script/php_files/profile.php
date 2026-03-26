<?php 
include "config.php";

// ✅ match button name (save)
if(isset($_POST['save'])){

    $db = new Database();

    // ✅ validation
    if(empty($_POST['admin_id'])){
        echo json_encode(['error'=>'Admin Id missing']); exit;
    }
    if(empty($_POST['name'])){
        echo json_encode(['error'=>'Name missing']); exit;
    }
    if(empty($_POST['email'])){
        echo json_encode(['error'=>'Email missing']); exit;
    }
    if(empty($_POST['phone'])){
        echo json_encode(['error'=>'Phone missing']); exit;
    }
    if(empty($_POST['address'])){
        echo json_encode(['error'=>'Address missing']); exit;
    }
    if(empty($_POST['username'])){
        echo json_encode(['error'=>'Username missing']); exit;
    }

    // ✅ password logic
    if(!empty($_POST['new_password'])){
        // 🔥 use secure hash
        $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $logout = true;
    } else {
        $password = $db->escapeString($_POST['old_password']);
        $logout = false;
    }

    // ✅ prepare data
    $params = [
        'admin_fullname' => $db->escapeString($_POST['name']),
        'admin_email'    => $db->escapeString($_POST['email']),
        'admin_phone'    => $db->escapeString($_POST['phone']),
        'admin_address'  => $db->escapeString($_POST['address']),
        'admin_username' => $db->escapeString($_POST['username']),
        'admin_password' => $password
    ];

    // ✅ safe id
    $admin_id = (int) $_POST['admin_id'];

    // ✅ update
    $db->update('admin', $params, "admin_id='$admin_id'");
    $result = $db->getResult();

    if(!empty($result)){

        if($logout){
            session_start();
            session_destroy();
            echo json_encode(['login'=>'1']); exit;
        } else {
            echo json_encode(['success'=>'1']); exit;
        }

    } else {
        echo json_encode(['error'=>'Update failed']); exit;
    }
}
?>