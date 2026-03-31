<?php $title = "Dashboard";
include "header.php";
?>
<div class="admin-content">
    <div class="container">
        <div id="admin-dashboard">
            <div class="row">
                <div class="col-md-3">
                    <?php 
                $db = new Database();

                // $db->sql("SELECT COUNT(*) AS incoming_vehicle FROM vehicle WHERE date(vehicle_intime)=CURDATE() AND vehicle_status=0;");
                $db->select('vehicle','COUNT(*) AS incoming_vehicle',null,"date(vehicle_intime)=CURDATE() AND vehicle_status=0",null,null);
                $result = $db->getResult();
                if(!empty($result)){
                  foreach($result as $row){
              ?>
                    <div class="card young-passion-gradient">
                        <div class="card-body text-center">
                            <span class="icon"><i class="fas fa-taxi"></i></span>
                            <p class="card-text mb-3"><?php echo $row['incoming_vehicle']; ?></p>
                            <h5 class="card-title text-white mb-0">Today Incoming Vehicle Entries</h5>
                        </div>
                    </div>
                    <?php 
                  }
                }
              ?>
                </div>
                <div class="col-md-3">
                    <?php 
                $db = new Database();

                // $db->sql("SELECT COUNT(*) AS outgoing_vehicle FROM vehicle WHERE date(vehicle_intime)=CURDATE() AND vehicle_status=1;");
                $db->select('vehicle','COUNT(*) AS outgoing_vehicle',null,"date(vehicle_intime)=CURDATE() AND vehicle_status=1",null,null);
                $result = $db->getResult();
                if(!empty($result)){
                  foreach($result as $row){
              ?>
                    <div class="card young-passion-gradient">
                        <div class="card-body text-center">
                            <span class="icon"><i class="fas fa-taxi"></i></span>
                            <p class="card-text mb-3"><?php echo $row['outgoing_vehicle']; ?></p>
                            <h5 class="card-title text-white mb-0">Today Outgoing Vehicle Entries</h5>
                        </div>
                    </div>
                    <?php 
                  }
                }
              ?>
                </div>
                <div class="col-md-3">
                    <?php 
                $db = new Database();

                // $db->sql("SELECT COUNT(*) AS total_category FROM vehicle_category");
                $db->select('vehicle_category','COUNT(*) AS total_category',null,null,null,null);
                $result = $db->getResult();
                if(!empty($result)){
                  foreach($result as $row){
              ?>
                    <div class="card purple-gradient">
                        <div class="card-body text-center">
                            <span class="icon"><i class="fas fa-file"></i></span>
                            <p class="card-text mb-3"><?php echo $row['total_category']; ?></p>
                            <h5 class="card-title text-white mb-0">Vehicle Category</h5>
                        </div>
                    </div>
                    <?php 
                  }
                }
              ?>
                </div>
                <div class="col-md-3">
                    <?php 
                $db = new Database();

                // $db->sql("SELECT COUNT(*) AS total_incoming FROM vehicle WHERE vehicle_status=0");
               $db->select('vehicle','COUNT(*) AS total_incoming',null,"vehicle_status=0",null,null);
                $result = $db->getResult();
                if(!empty($result)){
                  foreach($result as $row){
              ?>
                    <div class="card peach-gradient">
                        <div class="card-body text-center">
                            <span class="icon"><i class="fas fa-taxi"></i></span>
                            <p class="card-text mb-3"><?php echo $row['total_incoming']; ?></p>
                            <h5 class="card-title text-white mb-0">Total Incoming Vehicle</h5>
                        </div>
                    </div>
                    <?php 
                  }
                }
              ?>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h2>Latest Incoming Vehicle</h2>
                    </div>
                    <div class="card-body table-responsive">
                        <?php 
                        $conn = mysqli_connect("localhost","root","","install");

                        $result = mysqli_query($conn, "
                            SELECT * FROM vehicle 
                            WHERE vehicle_status = 0 
                            ORDER BY id DESC 
                            LIMIT 5
                        ");
                    ?>
                        <table class="table table-bordered">
                            <thead>
                                <th>S.No</th>
                                <th>Parking Number</th>
                                <th>Owner Name</th>
                                <th>Vehicle Reg Number</th>
                                <th>Vehicle InTime</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php if(isset($result) && !empty($result)){
                                    $i=0;
                                    while($row = mysqli_fetch_assoc($result)){
                                        $i++;
                                ?>
                                <tr class='tr-shadow'>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['parking_number']; ?></td>
                                    <td><?php echo $row['owner_name']; ?></td>
                                    <td><?php echo $row['reg_number']; ?></td>
                                    <td>
                                        <?php echo date('j M, Y',strtotime($row['vehicle_intime'])); ?><br>
                                        <small><?php echo date('H:i:s a',strtotime($row['vehicle_intime'])); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                        if($row['vehicle_status'] == '0'){ ?>
                                        <span class="badge badge-info">Vehicle In</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="view-vehicle.php?veid=<?php echo $row['id']; ?>"
                                                    class="btn btn-primary btn-sm"><img src="images/eye.png" alt=""></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                    }else{ ?>
                                <tr>
                                    <td colspan="6" align="center">No Record Found.</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?>