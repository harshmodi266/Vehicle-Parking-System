<?php

$title = "View Vehicle";
include "header.php";

if(isset($_POST['submit'])){
    $vehicle_id = $_POST['vehicle_id'] ?? 0;
    $status = $_POST['vehicle_status'] ?? '';

   $conn = mysqli_connect("localhost","root","","install");

mysqli_query($conn, "
    UPDATE vehicle 
    SET vehicle_status='$status', vehicle_outtime='".date("Y-m-d H:i:s")."' 
    WHERE id=".(int)$vehicle_id
);


    echo "<script>window.location.href='vehicle.php';</script>";
    exit;
}


?>
<div class="message"></div>
<div class="container">
    <div class="admin-content">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="d-inline">View Vehicle</h2>
                <a href="vehicle.php" class="btn btn-success float-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                    </svg>
                    Vehicle List
                </a>
            </div>
            <div class="card-body position-relative">
                <?php 
                $vehicle_id = isset($_GET['veid']) ? (int)$_GET['veid'] : 0;

if($vehicle_id <= 0){
    echo "<div class='alert alert-danger'>Invalid Vehicle ID</div>";
    exit;
}
                $db = new Database();
               $db->select("SELECT * FROM vehicle WHERE id=$vehicle_id");
                $result = $db->getResult();
                if(count($result) > 0){
    $row = $result[0];
            ?>
                <table class="table table-bordered">
                    <tr>
                        <th>Parking Number</th>
                        <td><?php echo $row['parking_number']; ?></td>
                    </tr>
                    <tr>
                        <th>Vehicle Category</th>
                        <td>
                            <?php 
$db->select("SELECT * FROM vehicle_category WHERE id=".$row['vehicle_cat']);
$result1 = $db->getResult();

$vehicle_cat = (int)$row['vehicle_cat']; 

$parking_charge_value = 0;

if(!empty($result1)){
    foreach($result1 as $row1){
        if($row1['id'] == $vehicle_cat){
            $parking_charge_value = $row1['parking_charge'];
?>
                            <input type="hidden" id="charge" value="<?php echo $parking_charge_value; ?>">
                            <input type="hidden" id="pcharge" value="<?php echo $parking_charge_value; ?>">
                            <?php echo $row1['category_name']; ?>
                            <?php
        }
    }
}
?>
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
                            <input type="hidden" id="in_time" value="<?php echo $row['vehicle_intime']; ?>">
                            <?php
                          $in_time = $row['vehicle_intime']; 
                          // $in_time = substr($in_time, 0, strpos($in_time, '('));
                          // echo date('Y-m-d h:i:s a', strtotime($in_time. "+270 minutes"));
                          echo date('Y-m-d h:i:s a', strtotime($in_time));
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Out Time</th>
                        <td>
                            <input type="hidden" id="out_time" value="<?php  echo date('Y-m-d H:i:s') ?>">
                            <div id="clock" class="form-control out_time"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Parking Charges</th>
                        <td>
                            <input type="hidden" id="currency_format" value="<?php echo $currency_format; ?>">
                            <div id="parking_charge"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php 
                        if($row['vehicle_status'] == '0'){ ?>
                            Vehicle In
                            <?php }else{ ?>
                            Vehicle Out
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- <tr>
                    <th>Remark</th>
                    <td>
                        <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                    </td>
                </tr> -->
                </table>

                <?php
    // end foreach
} else {
    echo "<div class='alert alert-danger'>Vehicle not found!</div>";
}
?>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">View Vehicle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body position-relative">
                                <form id="update-form" action="" method="post" autocomplete="off">
                                    <div class="form-group">
                                        <label><b>In Time :</b></label>
                                        <input type="hidden" name="vehicle_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" id="modal_in_time"
                                            value="<?php echo $row['vehicle_intime']; ?>">
                                        <input type="hidden" id="modal_currency_format"
                                            value="<?php echo $currency_format ?? '₹'; ?>">

                                        <!-- Use parking charge from the table row1 -->
                                        <input type="hidden" id="modal_charge"
                                            value="<?php echo $parking_charge_value; ?>">

                                        <?php
                                        $in_time = $row['vehicle_intime'];
                                        echo date('Y-m-d h:i:s a', strtotime($in_time));
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <label><b>Out Time :</b></label>
                                        <span id="clock1"></span>
                                    </div>

                                    <div class="form-group">
                                        <label><b>Parking Charge :</b></label>
                                        <span id="p-charge"
                                            style="font-weight:bold; color:green; font-size:18px;"></span>
                                    </div>

                                    <div class="form-group">
                                        <label><b>Status :</b></label>
                                        <select class="form-control" name="vehicle_status" required>
                                            <option value="1">Outgoing Vehicle</option>
                                        </select>
                                    </div>

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="submit"
                                        class="btn btn-primary float-right">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" id="loaddata" class="btn btn-dark float-right" data-toggle="modal"
                    data-target="#exampleModalCenter">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts should be here - after all HTML -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
function displayclick() {
    var time = new Date();
    var month = ("0" + (time.getUTCMonth() + 1)).slice(-2);
    var day = ("0" + time.getUTCDate()).slice(-2);
    var year = time.getUTCFullYear();
    var hrs = time.getHours();
    var min = ("0" + time.getMinutes()).slice(-2);
    var sec = ("0" + time.getSeconds()).slice(-2);
    var en = hrs >= 12 ? 'pm' : 'am';
    if (hrs > 12) hrs -= 12;
    if (hrs === 0) hrs = 12;

    var clockEl = document.getElementById('clock');
    if (clockEl) clockEl.innerHTML = year + "-" + month + "-" + day + ' ' + hrs + ':' + min + ':' + sec + ' ' + en;
}
setInterval(displayclick, 500);
</script>

<script>
// Main page charge calculation - Extremely Safe
document.addEventListener('DOMContentLoaded', function() {
    const chargeEl = document.getElementById('charge');
    if (!chargeEl || !chargeEl.value) return;

    const parking_charges = parseInt(chargeEl.value) || 0;
    if (parking_charges <= 0) return;

    const currencyEl = document.getElementById('currency_format');
    if (!currencyEl) return;

    const currency_format = currencyEl.value || '₹';
    const inTimeEl = document.getElementById('in_time');
    if (!inTimeEl || !inTimeEl.value) return;

    try {
        const dateOne = inTimeEl.value.replace(/-/g, "/");
        const diffHours = Math.abs(Math.ceil((new Date() - new Date(dateOne)) / 1000 / 3600));
        const charge = diffHours * parking_charges;

        const parkingDiv = document.getElementById('parking_charge');
        if (parkingDiv) parkingDiv.innerHTML = currency_format + charge;
    } catch (e) {
        console.log("Main charge error:", e);
    }
});
</script>

<script>
// Modal charge calculation
$('#exampleModalCenter').on('shown.bs.modal', function() {
    // Clock
    const updateClock1 = () => {
        const now = new Date();
        const formatted = now.getFullYear() + "-" +
            ("0" + (now.getMonth() + 1)).slice(-2) + "-" +
            ("0" + now.getDate()).slice(-2) + " " +
            ("0" + now.getHours()).slice(-2) + ":" +
            ("0" + now.getMinutes()).slice(-2) + ":" +
            ("0" + now.getSeconds()).slice(-2);
        $("#clock1").text(formatted);
    };
    updateClock1();

    // Charge
    const chargeEl = document.getElementById('modal_charge');
    const chargeValue = chargeEl ? parseInt(chargeEl.value) || 0 : 0;

    console.log("🔍 Modal Charge Value =", chargeValue);

    if (chargeValue <= 0) {
        document.getElementById('p-charge').innerHTML = "₹0";
        return;
    }

    const currencyEl = document.getElementById('modal_currency_format');
    const currency = currencyEl ? currencyEl.value : '₹';

    const inTimeEl = document.getElementById('modal_in_time');
    if (!inTimeEl) return;

    try {
        const dateOne = inTimeEl.value.replace(/-/g, "/");
        const diffHours = Math.ceil(Math.abs((new Date() - new Date(dateOne)) / 3600000));
        const totalCharge = diffHours * chargeValue;
        document.getElementById('p-charge').innerHTML = currency + totalCharge;
    } catch (e) {
        console.log("Modal charge error:", e);
    }
});
</script>

<script>
// Safe Form Submit Handler
document.getElementById('update-form').addEventListener('submit', function(e) {
    console.log("Form is submitting normally...");

    var statusVal = document.querySelector('select[name="vehicle_status"]').value;
    console.log("Status value sent to PHP:", statusVal);

    if (!statusVal) {
        e.preventDefault();
        alert("Status is required!");
    }
});
</script>

<?php include "footer.php" ?>