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
    $vehicle_intime = date('Y-m-d H:i:s');

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
        }else if(!isset($_POST['vehicle_status'])){
            echo json_encode(array('error'=>'Vehicle Status Field is Empty.')); exit;
        }else{

            $db = new Database();
            $vehicle_id = $_POST['vehicle_id'];

            // get vehicle data
            $getVehicle = $db->select('vehicle','*',null,"id='$vehicle_id'",null,null);
            $vehicle = $db->getResult()[0];

            // get category charge
            $getCat = $db->select('vehicle_category','*',null,"id='".$vehicle['vehicle_cat']."'",null,null);
            $cat = $db->getResult()[0];

            $charge_per_hour = $cat['parking_charge'] ?? 0;

            // calculate time
            $in_time = strtotime($vehicle['vehicle_intime']);
            $out_time_real = $_POST['out_time'];
            $out_time = strtotime($out_time_real);

            $total_charge = 0;

            if($out_time > $in_time){
                $hours = ceil(($out_time - $in_time) / 3600);
                $total_charge = $hours * $charge_per_hour;
            }
            $params = [
                'vehicle_outtime'=>$db->escapeString($_POST['out_time']),
                'parking_charges'=>$total_charge,
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