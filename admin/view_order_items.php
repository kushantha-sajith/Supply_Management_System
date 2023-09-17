<?php
require("../includes/config.php");
session_start();
if (isset($_SESSION['admin_login'])) {
    $order_id = $_GET['id'];
    $query_selectManOrderItems = "SELECT *,order_items.quantity as quantity FROM orders,order_items,products WHERE order_items.order_id='$order_id' AND order_items.pro_id=products.pro_id AND order_items.order_id=orders.order_id";
    $result_selectManOrderItems = mysqli_query($con, $query_selectManOrderItems);
    $query_selectManOrder = "SELECT date,approved,status FROM orders WHERE order_id='$order_id'";
    $result_selectManOrder = mysqli_query($con, $query_selectManOrder);
    $row_selectManOrder = mysqli_fetch_array($result_selectManOrder);
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
                <a href="add_product.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Add Products</span>
                </a>
            </li>
            <li>
                <a href="view_orders.php" class="active">
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
                <span class="admin_name"><a style="text-decoration:none;color:black;" href="change_password.php">Profile</a></span>
                <!-- <i class='bx bx-chevron-down'></i> -->
            </div>
        </nav>
        <div style="padding-top: 100px; padding-left:10px; padding-right:10px;">
            <h1>Order Details</h1>
            <table class="table_infoFormat">
                <tr>
                    <td> Order No: </td>
                    <td> <?php echo $order_id; ?> </td>
                </tr>
                <tr>
                    <td> Status: </td>
                    <td>
                        <?php
                        if ($row_selectManOrder['status'] == 0) {
                            echo "Pending";
                        } else {
                            echo "Completed";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td> Date: </td>
                    <td> <?php echo date("d-m-Y", strtotime($row_selectManOrder['date'])); ?> </td>
                </tr>
            </table>
            <form action="" method="POST" class="form">
                <table class="table_invoiceFormat">
                    <tr>
                        <th> Products </th>
                        <th> Unit Price </th>
                        <th> Quantity </th>
                        <th> Amount </th>
                    </tr>
                    <?php $i = 1;
                    while ($row_selectManOrderItems = mysqli_fetch_array($result_selectManOrderItems)) { ?>
                        <tr>
                            <td> <?php echo $row_selectManOrderItems['pro_name']; ?> </td>
                            <td> <?php echo $row_selectManOrderItems['pro_price']; ?> </td>
                            <td> <?php echo $row_selectManOrderItems['quantity']; ?> </td>
                            <td> <?php echo $row_selectManOrderItems['quantity'] * $row_selectManOrderItems['pro_price']; ?> </td>
                        </tr>
                    <?php $i++;
                    } ?>
                    <tr style="height:40px;vertical-align:bottom;">
                        <td colspan="3" style="text-align:right;"> Total Amount: </td>
                        <td>
                            <?php
                            mysqli_data_seek($result_selectManOrderItems, 0);
                            $row_selectManOrderItems = mysqli_fetch_array($result_selectManOrderItems);
                            echo $row_selectManOrderItems['total_amount'];
                            ?>
                        </td>
                    </tr>
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