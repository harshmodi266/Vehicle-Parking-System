<?php $title = "Settings";
include "header.php" ?>
<div class="message"></div>
<div class="container">
    <div class="admin-content">
        <div class="card">
            <div class="card-header">
                <h2 class="d-inline">Edit Settings</h2>
            </div>
            <div class="card-body position-relative">
                <?php
                  $conn = new mysqli("localhost", "root", "", "install");

                    $query = "SELECT * FROM settings";
                    $res = $conn->query($query);

                    $result = [];

                    while ($row = $res->fetch_assoc()) {
                        $result[] = $row;
                    }
                if(!empty($result)){
              $row = $result[0];
            ?>
                <form class="yourform" id="update-settings" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Site Name</label>
                        <input type="hidden" name="site_id" value="<?php echo $row['site_id']; ?>">
                        <input type="text" class="form-control site_name" placeholder="" name="site_name"
                            value="<?php echo $row['site_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Site Logo</label>
                        <input type="file" class="new_logo image" name="new_logo" />
                        <input type="hidden" class="old_logo image" name="old_logo"
                            value="<?php echo $row['site_logo']; ?>">
                        <?php if($row['site_logo'] != ''){ ?>
                        <img id="image" src="../images/site-logo/<?php echo $row['site_logo']; ?>" alt=""
                            width="100px" />
                        <?php }else{ ?>
                        <img id="image" src="../images/site-logo/default.jpg" alt="" width="100px" />
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Currency Format</label>
                        <input type="text" class="form-control site_currency" placeholder="" name="site_currency"
                            value="<?php echo $row['currency']; ?>" required>
                    </div>
                    <input type="submit" name="update-settings" class="btn btn-dark float-right" value="Update">
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>