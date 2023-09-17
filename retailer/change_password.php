<?php
include("../includes/config.php");
include("../includes/validate_data.php");
session_start();
if (isset($_SESSION['retailer_login'])) {
    $id = $_SESSION['retailer_id'];
    $requireErr = $oldPasswordErr = $matchErr = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!empty($_POST['txtOldPassword'])) {
            $password = $_POST['txtOldPassword'];
            $query_oldPassword = "SELECT password FROM retailer WHERE retailer_id='$id' AND password='$password'";
            $result_oldPassword = mysqli_query($con, $query_oldPassword);
            $row_oldPassword = mysqli_fetch_array($result_oldPassword);
            if ($row_oldPassword) {
                if (!empty($_POST['txtNewPassword']) && !empty($_POST['txtConfirmPassword'])) {
                    $newPassword = $_POST['txtNewPassword'];
                    $confirmPassword = $_POST['txtConfirmPassword'];
                    if (strcmp($newPassword, $confirmPassword) == 0) {
                        $query_UpdatePassword = "UPDATE retailer SET password='$confirmPassword' WHERE retailer_id='$id'";
                        if (mysqli_query($con, $query_UpdatePassword)) {
                            echo "<script> alert(\"Password Updated Successfully\"); </script>";
                            header("Refresh:0");
                        } else {
                            $requireErr = "* Updating Password Failed";
                        }
                    } else {
                        $matchErr = "* Password do not match";
                    }
                } else {
                    $requireErr = "* All Fields are required";
                }
            } else {
                $oldPasswordErr = "* Old Password do not match";
            }
        }
    }
} else {
    header('Location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!--navigation bar left-->
    <div class="sidebar">
        <div class="logo-details">
            <!-- <i class='bx bx-grid-alt'></i>
            <span class="logo_name">Dashboard</span> -->
        </div>
        <ul class="nav-links">
            <li>
                <a href="index.php" class="active">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="view_products.php">
                    <i class='bx bx-box'></i>
                    <span class="links_name">Products</span>
                </a>
            </li>
            <li>
                <a href="view_my_orders.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">My Orders</span>
                </a>
            </li>
            <li>
                <a href="order_items.php">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Add Orders</span>
                </a>
            </li>
            <li>
				<a href="help.php">
					<i class='bx bx-help-circle'></i>
					<span class="links_name">Help</span>
				</a>
			</li>
			<li class="log_out">
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <!-- <span class="dashboard">Dashboard</span> -->
            </div>
            <div class="profile-details">
                <img src="images/profile.jpg" alt="">
                <span class="admin_name"><a style="text-decoration:none; color:black;" href="change_password.php">Profile</a></span>
                <!-- <i class='bx bx-chevron-down'></i> -->
            </div>
        </nav>
        <div style="padding-top: 100px; padding-left:10px; padding-right:10px;">
            <h1>Edit Profile</h1>
            <form action="" method="POST" class="form">
                <ul class="form-list">
                    <li>
                        <div class="label-block"> <label for="oldPassword">Old Password</label> </div>
                        <div class="input-box"> <input type="password" id="oldPassword" name="txtOldPassword" placeholder="Old Password" required /> </div> <span class="error_message"><?php echo $oldPasswordErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="newPassword">New Password</label> </div>
                        <div class="input-box"> <input type="password" id="newPassword" name="txtNewPassword" placeholder="New Password" required /> </div>
                    </li>
                    <li>
                        <div class="label-block"> <label for="confirmPassword">Confirm Password</label> </div>
                        <div class="input-box"> <input type="password" id="confirmPassword" name="txtConfirmPassword" placeholder="Confirm Password" required /> </div><span class="error_message"><?php echo $matchErr; ?></span>
                    </li>
                    <br>
                    <li>
                        <input type="submit" value="Change Password" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?>
                    </li>
                </ul>
            </form>
        </div>
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    </script>
</body>

</html>