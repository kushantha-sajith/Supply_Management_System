<?php
include("../includes/config.php");
session_start();
if (isset($_SESSION['admin_login'])) {
    if ($_SESSION['admin_login'] == true) {
        $query_selectRetailer = "SELECT * FROM retailer ORDER BY retailer_id DESC LIMIT 5";
        $result_selectRetailer = mysqli_query($con, $query_selectRetailer);
        $query_selectManufacturer = "SELECT * FROM manufacturer ORDER BY man_id DESC LIMIT 5";
        $result_selectManufacturer = mysqli_query($con, $query_selectManufacturer);
        $query_selectProducts = "SELECT * FROM products,categories,unit WHERE products.pro_cat=categories.cat_id AND products.unit=unit.id ORDER BY pro_id DESC LIMIT 5";
        $result_selectProducts = mysqli_query($con, $query_selectProducts);
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
                <a href="add_product.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Add Products</span>
                </a>
            </li>
            <li>
                <a href="view_orders.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Orders</span>
                </a>
            </li>
            <li>
                <a href="add_retailer.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Add Retailers</span>
                </a>
            </li>
            <li>
                <a href="add_manufacturer.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Add Manufacturers</span>
                </a>
            </li>
            <li>
                <a href="view_unit.php">
                    <i class='bx bx-unite'></i>
                    <span class="links_name">Manage Unit</span>
                </a>
            </li>
            <li>
                <a href="view_category.php">
                    <i class='bx bx-duplicate'></i>
                    <span class="links_name">Manage Category</span>
                </a>
            </li>
            <li class="log_out">
                <a href="../logout.php">
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
            <div class="nav-btn">
                <span class=""><a href="index.php">Home</a></span>
            </div>
            <div class="nav-btn">
                <span class=""><a href="view_retailer.php">Retailers</a></span>
            </div>
            <div class="nav-btn">
                <span class=""><a href="view_manufacturer.php">Manufacturers</a></span>
            </div>
            <div class="nav-btn">
                <span class=""><a href="help.php">Help</a></span>
            </div>
            <div class="profile-details">
                <img src="images/profile.jpg" alt="">
                <span class="admin_name"><a style="text-decoration:none; color:black;" href="change_password.php">Profile</a></span>
                <!-- <i class='bx bx-chevron-down'></i> -->
            </div>
        </nav>
        <div style="padding-top: 100px; padding-left:10px; padding-right:10px;">
            <h1>Welcome Admin</h1>
            <br>
            <h2>Recently Added Retailers</h2><br>
            <table class="table_displayData">
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                </tr>
                <?php $i = 1;
                while ($row_selectRetailer = mysqli_fetch_array($result_selectRetailer)) { ?>
                    <tr>
                        <td> <?php echo $i; ?> </td>
                        <td> <?php echo $row_selectRetailer['username']; ?> </td>
                        <td> <?php echo $row_selectRetailer['phone']; ?> </td>
                        <td> <?php echo $row_selectRetailer['email']; ?> </td>
                        <td> <?php echo $row_selectRetailer['address']; ?> </td>
                    </tr>
                <?php $i++;
                } ?>
            </table>
            <br>
            <h2>Recently Added Manufacturers</h2><br>
            <table class="table_displayData">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>
                </tr>
                <?php $i = 1;
                while ($row_selectManufacturer = mysqli_fetch_array($result_selectManufacturer)) { ?>
                    <tr>
                        <td> <?php echo $i; ?> </td>
                        <td> <?php echo $row_selectManufacturer['man_name']; ?> </td>
                        <td> <?php echo $row_selectManufacturer['man_email']; ?> </td>
                        <td> <?php echo $row_selectManufacturer['man_phone']; ?> </td>
                        <td> <?php echo $row_selectManufacturer['username']; ?> </td>
                    </tr>
                <?php $i++;
                } ?>
            </table><br>
            <h2>Recently Added Products</h2><br>
            <table class="table_displayData">
                <tr>
                    <th> Code </th>
                    <th> Name </th>
                    <th> Price </th>
                    <th> Unit </th>
                    <th> Category </th>
                    <th> Quantity </th>
                </tr>
                <?php $i = 1;
                while ($row_selectProducts = mysqli_fetch_array($result_selectProducts)) { ?>
                    <tr>
                        <td> <?php echo $row_selectProducts['pro_id']; ?> </td>
                        <td> <?php echo $row_selectProducts['pro_name']; ?> </td>
                        <td> <?php echo $row_selectProducts['pro_price']; ?> </td>
                        <td> <?php echo $row_selectProducts['unit_name']; ?> </td>
                        <td> <?php echo $row_selectProducts['cat_name']; ?> </td>
                        <td> <?php if ($row_selectProducts['quantity'] == NULL) {
                                    echo "N/A";
                                } else {
                                    echo $row_selectProducts['quantity'];
                                } ?> </td>
                    </tr>
                <?php $i++;
                } ?>
            </table>
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