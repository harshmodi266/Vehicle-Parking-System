<?php $title = "Add Vehicle";
include "header.php" ?>
<div class="message"></div>
<div class="container">
    <div class="admin-content">
        <div class="card">
            <div class="card-header">
                <h2 class="d-inline">Add Vehicle</h2>
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
           $conn = mysqli_connect("localhost","root","","install");

            $result = mysqli_query($conn, "SELECT * FROM vehicle_category WHERE category_status = 1");
            if(empty($result)){ ?>
                <div class="alert alert-danger">First Add Vehicle Category</div>
                <?php } ?>
                <form class="yourform" id="add-vehicle" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
                    autocomplete="off">
                    <div class="form-group">
                        <label>Vehicle Category</label>
                        <select class="form-control vehicle_cat" name="vehicle_cat" id="">
                            <option value="">Select Vehicle Category</option>
                            <?php 
                                if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<option value='{$row['id']}'>{$row['category_name']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Vehicle Company</label>
                        <input type="text" class="form-control vehicle_company" name="vehicle_company"
                            placeholder="Vehicle Company" required>
                    </div>
                    <div class="form-group">
                        <label>Registration Number</label>
                        <input type="text" class="form-control reg_no" name="reg_no" placeholder="Registration Number"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Owner Name</label>
                        <input type="text" class="form-control owner_name" name="owner_name" placeholder="Owner Name"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Owner Contact Number</label>
                        <input type="text" class="form-control owner_contact" name="owner_contact"
                            placeholder="Owner Contact Number" required>
                    </div>
                    <div class="form-group">
                        <label>Vehicle In Time</label>
                        <!-- <input type="hidden" class="in_time" id="clock" name="in_time" value=""> -->
                        <div id="clock1" class="form-control"></div>
                    </div>
                    <input type="submit" name="save" class="btn btn-dark float-right" value="Save" required>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function displayclick() {
    var now = new Date();

    var year = now.getFullYear();
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var day = ("0" + now.getDate()).slice(-2);

    var hrs = ("0" + now.getHours()).slice(-2);
    var min = ("0" + now.getMinutes()).slice(-2);
    var sec = ("0" + now.getSeconds()).slice(-2);

    var display = day + "-" + month + "-" + year + " " + hrs + ":" + min + ":" + sec;

    document.getElementById('clock1').innerHTML = display;
}
setInterval(displayclick, 1000);
</script>

<?php include "footer.php" ?>