<?php 
    include "config.php";

    //add vehicle
    if(isset($_POST['addvehicle'])){

    $conn = mysqli_connect("localhost","root","","install");

    $vehicle_cat = $_POST['vehicle_cat'];
    $vehicle_company = $_POST['vehicle_company'];
    $reg_no = $_POST['reg_no'];
    $owner_name = $_POST['owner_name'];
    $owner_contact = $_POST['owner_contact'];
    $vehicle_intime = $_POST['vehicle_intime'];

    if($vehicle_cat == '' || $vehicle_company == '' || $reg_no == ''){
        echo json_encode(['error'=>'All fields required']); exit;
    }

    $sql = "INSERT INTO vehicle 
            (parking_number, vehicle_cat, vehicle_company, reg_number, owner_name, owner_contact, vehicle_intime, vehicle_status)
            VALUES 
            ('".rand(1000,9999)."', '$vehicle_cat', '$vehicle_company', '$reg_no', '$owner_name', '$owner_contact', '$vehicle_intime', 0)";

    if(mysqli_query($conn,$sql)){
        echo json_encode(['success'=>true]);
    }else{
        echo json_encode(['error'=>mysqli_error($conn)]);
    }

    exit;
}

    //update vehicle
    if(isset($_POST['updateVehicle'])){
        if(!isset($_POST['out_time']) || empty($_POST['out_time'])){
            echo json_encode(array('error'=>'Vehicle Out Time Field is Empty.')); exit;
        }else if(!isset($_POST['parking_charge']) || empty($_POST['parking_charge'])){
            echo json_encode(array('error'=>'Parking Charge Field is Empty.')); exit;
        }else if(!isset($_POST['vehicle_status']) || empty($_POST['vehicle_status'])){
            echo json_encode(array('error'=>'Vehicle Status Field is Empty.')); exit;
        }else{

            $db = new Database();

            $params = [
                'id' => $db->escapeString($_POST['vehicle_id']),
                'vehicle_outtime'=>$db->escapeString($_POST['out_time']),
                'parking_charges'=>$db->escapeString($_POST['parking_charge']),
                'vehicle_status'=>$db->escapeString($_POST['vehicle_status']),
            ];

            $db->update('vehicle',$params,"id='{$_POST['vehicle_id']}'");
            $response = $db->getResult();
            if(!empty($response)){
                echo json_encode(array('success'=>$response));
            }else{
                echo json_encode(array('error'=>'Data not updated.'));
            }
        }
    } 





?>