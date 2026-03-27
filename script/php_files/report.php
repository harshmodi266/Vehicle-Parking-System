<?php
include "config.php";

$db = new Database();

// GET FILTER VALUES

$search_type = $_POST['type'] ?? 'all';
$from_date = $_POST['from_date'] ?? date('Y-m-d 00:00:00');
$to_date = $_POST['to_date'] ?? date('Y-m-d 23:59:59');

$from_date = date('Y-m-d H:i:s', strtotime($from_date));
$to_date = date('Y-m-d H:i:s', strtotime($to_date));

// WHERE CONDITION

$where = "(
    (vehicle.vehicle_intime >= '$from_date' AND vehicle.vehicle_intime <= '$to_date') 
    OR 
    (vehicle.vehicle_outtime >= '$from_date' AND vehicle.vehicle_outtime <= '$to_date')
)";

if ($search_type == 'incoming') {
    $where .= " AND vehicle.vehicle_status = 0";
} elseif ($search_type == 'outgoing') {
    $where .= " AND vehicle.vehicle_status = 1";
}

// FETCH DATA

$db->select('vehicle', '*', null, $where, null, null);
$result = $db->getResult();

// FORMAT DATA FOR DATATABLE

$output = [];

if (!empty($result)) {
    foreach ($result as $row) {

        $data = [];

        // Parking Number
        $data['p_number'] = '<span>' . $row['parking_number'] . '</span>';

        // Owner Name
        $data['owner'] = '<span>' . $row['owner_name'] . '</span>';

        // Vehicle Number
        $data['vehicle_no'] = '<span>' . $row['reg_number'] . '</span>';

        
        // DATE & TIME FORMAT
        
        $dateTime = '<small><b>In Time: </b></small>' .
            date('j M, Y', strtotime($row['vehicle_intime'])) . '<br>' .
            '<small>' . date('h:i:s A', strtotime($row['vehicle_intime'])) . '</small><br>';

        if ($row['vehicle_status'] == 1 && !empty($row['vehicle_outtime'])) {
            $dateTime .= '<small><b>Out Time: </b></small>' .
                date('j M, Y', strtotime($row['vehicle_outtime'])) . '<br>' .
                '<small>' . date('h:i:s A', strtotime($row['vehicle_outtime'])) . '</small>';
        }

        $data['dateTime'] = $dateTime;

        
        // STATUS BADGE
        
        if ($row['vehicle_status'] == 1) {
            $data['status'] = '<span class="badge badge-success">Out</span>';
        } else {
            $data['status'] = '<span class="badge badge-info">In</span>';
        }

        
        // PARKING CHARGES FIX
        
        if (!empty($row['parking_charges'])) {
            $data['parking_charges'] = '₹ ' . $row['parking_charges'];
        } else {
            $data['parking_charges'] = '₹ 0';
        }

        $output[] = $data;
    }
}


// FINAL RESPONSE (DATATABLE)

$response = [
    "draw" => intval($_POST['draw'] ?? 1),
    "recordsTotal" => count($output),
    "recordsFiltered" => count($output),
    "data" => $output
];

echo json_encode($response);
exit;
?>