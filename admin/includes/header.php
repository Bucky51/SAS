<div class="header">
    <div class="pull-left">
        <div class="logo"><a href="dashboard.php">
            <!-- <img src="assets/images/logo.png" alt="Logo" /> -->
            <span>Subject Allocation Portal</span></a></div>
        <div class="hamburger sidebar-toggle">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </div>

    <div class="pull-right p-r-15">
        <ul>
            <?php
            $aid = $_SESSION['tsasaid'];
            $sql = "SELECT * from tbladmin where ID=?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $aid);
            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <li class="header-icon dib"><img class="avatar-img" src="../assets/images/avatar/images (1).png" alt="" /> <span class="user-avatar"> <?php echo $row['AdminName']; ?> <i class="ti-angle-down f-s-10"></i></span>
                        <div class="drop-down dropdown-profile">
                            <div class="dropdown-content-heading">
                                <span class="text-left"><?php echo $row['Email']; ?></span>
                                <p class="trial-day"><?php echo $row['MobileNumber']; ?></p>
                            </div>
                            <div class="dropdown-content-body">
                                <ul>
                                    <li><a href="profile.php"><i class="ti-user"></i> <span>Profile</span></a></li>
                                    <li><a href="change-password.php"><i class="ti-settings"></i> <span>Setting</span></a></li>
                                    <li><a href="logout.php"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
            <?php }
            } ?>
        </ul>
    </div>
</div>
