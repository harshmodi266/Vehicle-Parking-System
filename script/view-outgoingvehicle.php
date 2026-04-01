<?php $title = "View Outgoing Vehicle";
include "header.php" ?>
<div class="message"></div>
<div class="container">
    <div class="admin-content">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="d-inline">View Outgoing Vehicle</h2>
                <a href="manage-outgoingvehicle.php" class="btn btn-success float-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                    </svg>
                    Outgoing Vehicle List
                </a>
            </div>
            <div class="card-body position-relative">
                <?php 
$vehicle_id = $_GET['void'];
$conn = mysqli_connect("localhost","root","","install");

$result = mysqli_query($conn, "SELECT * FROM vehicle WHERE id=".(int)$vehicle_id);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);

    // Get category + charge
    $catQuery = mysqli_query($conn, "SELECT * FROM vehicle_category WHERE id=".$row['vehicle_cat']);
    $cat = mysqli_fetch_assoc($catQuery);
    $parking_charge = $cat['parking_charge'] ?? 0;

    // Calculate charge
    $in_time = strtotime($row['vehicle_intime']);
    $out_time = strtotime($row['vehicle_outtime']);

    $total_charge = 0;

    if(!empty($row['vehicle_outtime']) && $out_time > $in_time){
        $hours = ceil(($out_time - $in_time) / 3600);
        $total_charge = $hours * $parking_charge;
    }
?>
                <table class="table table-bordered">
                    <tr>
                        <th>Parking Number</th>
                        <td><?php echo $row['parking_number']; ?></td>
                    </tr>
                    <tr>
                        <th>Vehicle Category</th>
                        <td>
                            <input type="hidden" id="charge" value="<?php echo $parking_charge; ?>">
                            <?php echo $cat['category_name']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Vehicle Company Name</th>
                        <td><?php echo $row['vehicle_company']; ?></td>
                    </tr>
                    <tr>
                        <th>Vehicle Registration Number</th>
                        <td><?php echo $row['reg_number']; ?></td>
                    </tr>
                    <tr>
                        <th>Owner Name</th>
                        <td><?php echo $row['owner_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Owner Contact Number</th>
                        <td><?php echo $row['owner_contact']; ?></td>
                    </tr>
                    <tr>
                        <th>In Time</th>
                        <td>
                            <?php echo date('d M Y, h:i:s A', strtotime($row['vehicle_intime'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Out Time</th>
                        <td>
                            <?php echo date('d M Y, h:i:s A', strtotime($row['vehicle_outtime'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Parking Charges</th>
                        <td>
                            <?php if($row['parking_charges'] != NULL){
    echo $currency_format.$row['parking_charges'];
} else {
    echo $currency_format.$total_charge;
}
?>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php 
                        if($row['vehicle_status'] == '1'){ ?>
                            Vehicle Out
                            <?php }else{ ?>
                            Vehicle In
                            <?php } ?>
                        </td>
                    </tr>
                </table>

                <?php 
            }
        
                ?>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>