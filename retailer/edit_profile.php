<?php
include("../includes/config.php");
include("../includes/validate_data.php");
session_start();
if (isset($_SESSION['retailer_login'])) {
	$username = $password = $areacode = $phone = $email = $address = "";
	$usernameErr = $passwordErr = $phoneErr = $emailErr = $requireErr = $confirmMessage = "";
	$usernameHolder = $phoneHolder = $areacodeHolder = $emailHolder = $addressHolder = "";
	$id = $_SESSION['retailer_id'];
	$query_selectRetailer = "SELECT * FROM retailer WHERE retailer_id='$id'";
	$result_selectRetailer = mysqli_query($con, $query_selectRetailer);
	$row_selectRetailer = mysqli_fetch_array($result_selectRetailer);
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (!empty($_POST['txtRetailerPhone'])) {
			$phoneHolder = $_POST['txtRetailerPhone'];
			$resultValidate_phone = validate_phone($_POST['txtRetailerPhone']);
			if ($resultValidate_phone == 1) {
				$phone = $_POST['txtRetailerPhone'];
			} else {
				$phoneErr = $resultValidate_phone;
			}
		}
		if (!empty($_POST['txtRetailerEmail'])) {
			$emailHolder = $_POST['txtRetailerEmail'];
			$resultValidate_email = validate_email($_POST['txtRetailerEmail']);
			if ($resultValidate_email == 1) {
				$email = $_POST['txtRetailerEmail'];
			} else {
				$emailErr = $resultValidate_email;
			}
		}
		if (!empty($_POST['txtRetailerAddress'])) {
			$address = $_POST['txtRetailerAddress'];
			$addressHolder = $_POST['txtRetailerAddress'];
		}
		if ($phone != null) {
			$query_updateRetailer = "UPDATE retailer SET phone='$phone',email='$email',address='$address' WHERE retailer_id='$id'";
			if (mysqli_query($con, $query_updateRetailer)) {
				echo "<script> alert(\"Retailer Updated Successfully\"); </script>";
				header("Refresh:0");
			} else {
				$requireErr = "Updating Retailer Failed";
			}
		} else {
			$requireErr = "* Valid Phone number is compulsory";
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
						<div class="label-block"> <label for="retailer:phone">Phone</label> </div>
						<div class="input-box"> <input type="text" id="retailer:phone" name="txtRetailerPhone" placeholder="Phone" value="<?php echo $row_selectRetailer['phone']; ?>" /> </div> <span class="error_message"><?php echo $phoneErr; ?></span>
					</li>
					<li>
						<div class="label-block"> <label for="retailer:email">Email</label> </div>
						<div class="input-box"> <input type="text" id="retailer:email" name="txtRetailerEmail" placeholder="Email" value="<?php echo $row_selectRetailer['email']; ?>" required /> </div> <span class="error_message"><?php echo $emailErr; ?></span>
					</li>
					<li>
						<div class="label-block"> <label for="retailer:address">Address</label> </div>
						<div class="input-box"> <textarea type="text" id="retailer:address" name="txtRetailerAddress" placeholder="Address"><?php echo $row_selectRetailer['address']; ?></textarea> </div>
					</li>
					<br>
					<li>
						<a href="change_password.php"><input type="button" value="Change Password" class="submit_button" /></a>
						<input type="submit" value="Update Profile" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
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