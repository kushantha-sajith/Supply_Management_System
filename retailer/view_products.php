<?php
include("../includes/config.php");
session_start();
if (isset($_SESSION['retailer_login'])) {
    $query_selectProducts = "SELECT * FROM products,categories,unit WHERE products.pro_cat=categories.cat_id AND products.unit=unit.id ORDER BY pro_id";
    $result_selectProducts = mysqli_query($con, $query_selectProducts);
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
                <a href="view_products.php" class="active">
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
            <h1>View Products</h1>
            <form action="" method="POST" class="form">
                <table class="table_displayData">
                    <tr>
                        <th> ID </th>
                        <th> Name </th>
                        <th> Price </th>
                        <th> Unit </th>
                        <th> Category </th>
                    </tr>
                    <?php $i = 1;
                    while ($row_selectProducts = mysqli_fetch_array($result_selectProducts)) { ?>
                        <tr>
                            <td> <?php echo $row_selectProducts['pro_id']; ?> </td>
                            <td> <?php echo $row_selectProducts['pro_name']; ?> </td>
                            <td> <?php echo $row_selectProducts['pro_price']; ?> </td>
                            <td> <?php echo $row_selectProducts['unit_name']; ?> </td>
                            <td> <?php echo $row_selectProducts['cat_name']; ?> </td>
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