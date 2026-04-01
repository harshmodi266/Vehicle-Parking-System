<?php 
    include "config.php";

    //add vehicle category
    
    if(isset($_POST['add-Vehiclecategory'])){

    $conn = mysqli_connect("localhost","root","","install");

    $cat_name = $_POST['cat_name'];
    $parking_charge = $_POST['parking_charge'];
    $cat_status = $_POST['cat_status'];

    if($cat_name == ''){
        echo json_encode(['error'=>'Category name required']); exit;
    }

    // duplicate check
    $check = mysqli_query($conn, "SELECT * FROM vehicle_category WHERE category_name='$cat_name'");
    if(mysqli_num_rows($check) > 0){
        echo json_encode(['error'=>'Category already exists']); exit;
    }

    // insert
    $sql = "INSERT INTO vehicle_category (category_name, parking_charge, category_status) 
            VALUES ('$cat_name','$parking_charge','$cat_status')";

    if(mysqli_query($conn,$sql)){
        echo json_encode(['success'=>true]);
    }else{
        echo json_encode(['error'=>mysqli_error($conn)]);
    }

    exit;
}

    //update vehicle category
  if(isset($_POST['update-Vehiclecategory'])){

    $conn = mysqli_connect("localhost","root","","install");

    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $parking_charge = $_POST['parking_charge'];
    $cat_status = $_POST['cat_status'];

    // duplicate check
    $check = mysqli_query($conn, "SELECT * FROM vehicle_category 
                                 WHERE category_name='$cat_name' AND id != '$cat_id'");

    if(mysqli_num_rows($check) > 0){
        echo json_encode(['error'=>'Category already exists']); exit;
    }

    $sql = "UPDATE vehicle_category 
            SET category_name='$cat_name',
                parking_charge='$parking_charge',
                category_status='$cat_status'
            WHERE id='$cat_id'";

    if(mysqli_query($conn,$sql)){
        echo json_encode(['success'=>true]);
    }else{
        echo json_encode(['error'=>mysqli_error($conn)]);
    }

    exit;
}

    //delete vehicle category
if(isset($_POST['cat_delete'])){
    $id = $_POST['cat_delete'];

    $conn = mysqli_connect("localhost","root","","install");

    $sql = "UPDATE vehicle_category 
            SET category_status = 0 
            WHERE id = '$id'";

    if(mysqli_query($conn, $sql)){

        //  CHECK affected rows
        if(mysqli_affected_rows($conn) > 0){
            echo json_encode(['success' => true]);
        }else{
            echo json_encode(['error' => 'Category already inactive or not found.']);
        }

    }else{
        echo json_encode(['error' => mysqli_error($conn)]);
    }
}


?>