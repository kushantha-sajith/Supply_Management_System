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
				<a href="help.php" class="active">
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
			</div>
		</nav>
		<div style="padding-top: 100px; padding-left:10px; padding-right:10px;">
		<h1>Need Some Help?</h1>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Solution</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>How to View Products?</td>
                            <td> Go to Dashboard > Product. You will have a familiar interface which can view products to the system
                            </td>
                        </tr>
                        <tr>
                            <td>How to View Orders?</td>
                            <td>Go to Dashboard > Orders. You will have a familiar interface which can view Orders of the system
                            </td>
                        </tr>
                        <tr>
                            <td>How to Add Orders?</td>
                            <td>Go to Dashboard > Add Orders. You will have a familiar interface which can add new Orders of the system</td>
                        </tr>
                        <!-- <tr>
                            <td>How to check Completed Order</td>
                            <td>Go to Dashboard >Complete Orders. After complete an order in the system, there will be an complete order created and will be displayed in complete orders screen
                            </td>
                        </tr> -->
                    </tbody>
                </table>
                <br>
            <p>If you have any other problems, please send us a message.</p>
            <br>
            <input type="submit" value="Contact US" class="submit_button" />
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