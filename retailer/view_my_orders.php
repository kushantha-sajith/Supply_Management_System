<?php
require("../includes/config.php");
include("../includes/validate_data.php");
session_start();
if (isset($_SESSION['retailer_login'])) {
	if (isset($_SESSION['retailer_login']) == true && isset($_SESSION['retailer_id'])) {
		$retailer_id = $_SESSION['retailer_id'];
		$error = "";
		$query_selectOrder = "SELECT * FROM orders WHERE retailer_id='$retailer_id'";
		$result_selectOrder = mysqli_query($con, $query_selectOrder);
	} else {
		header('Location:../index.php');
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
				<a href="index.php">
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
				<a href="view_my_orders.php" class="active">
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
			<h1>My Orders</h1>
			<form action="" method="POST" class="form">
				<table class="table_displayData" style="margin-top:20px;">
					<tr>
						<th> Order ID </th>
						<th> Date </th>
						<th> Approved </th>
						<th> Status </th>
						<th> Details </th>
					</tr>
					<?php $i = 1;
					while ($row_selectOrder = mysqli_fetch_array($result_selectOrder)) { ?>
						<tr>
							<td> <?php echo $row_selectOrder['order_id']; ?> </td>
							<td> <?php echo date("d-m-Y", strtotime($row_selectOrder['date'])); ?> </td>
							<td>
								<?php
								if ($row_selectOrder['approved'] == 0) {
									echo "Not Approved";
								} else {
									echo "Approved";
								}
								?>
							</td>
							<td>
								<?php
								if ($row_selectOrder['status'] == 0) {
									echo "Pending";
								} else {
									echo "Completed";
								}
								?>
							</td>
							<td> <a href="view_order_items.php?id=<?php echo $row_selectOrder['order_id']; ?>">Details</a> </td>
						</tr>
					<?php $i++;
					} ?>
				</table>
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