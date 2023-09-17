<?php
include("../includes/config.php");
session_start();
if (isset($_SESSION['manufacturer_login'])) {
    if ($_SESSION['manufacturer_login'] == true) {
        $querySelectProduct = "SELECT * FROM products,unit WHERE products.unit=unit.id";
        $resultSelectProduct = mysqli_query($con, $querySelectProduct);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['txtQuantity'])) {
                $arrayQuantity = $_POST['txtQuantity'];
                foreach ($arrayQuantity as $key => $value) {
                    $queryUpdateStock = "UPDATE products SET quantity='$value' WHERE pro_id='$key'";
                    $result = mysqli_query($con, $queryUpdateStock);
                }
                if (!$result) {
                    $requireErr = "Updating Product Failed";
                } else {
                    echo "<script> alert(\"Stock Updated Successfully\"); </script>";
                    header('Refresh:0');
                }
            }
        }
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
                <a href="manage_stock.php" class="active">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Manage Stock</span>
                </a>
            </li>
            <li>
                <a href="view_category.php">
                    <i class='bx bx-book-alt'></i>
                    <span class="links_name">Manage Categories</span>
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
            </div>
            <div class="nav-btn">
                <span class=""><a href="index.php">Home</a></span>
            </div>
            <div class="nav-btn">
                <span class=""><a href="view_retailer.php">Retailers</a></span>
            </div>
            <div class="nav-btn">
                <span class=""><a href="help.php">Help</a></span>
            </div>
            <div class="profile-details">
                <img src="images/profile.jpg" alt="">
                <span class="admin_name"><a style="text-decoration:none; color:black;" href="change_password.php">Profile</a></span>
            </div>
        </nav>
        <div style="padding-top: 100px; padding-left:10px; padding-right:10px;">
            <h1>Manage Stock</h1>
            <form action="" method="POST" class="form">
                <table class="table_displayData" style="margin-top:20px;">
                    <tr>
                        <th> Product ID </th>
                        <th> Name </th>
                        <th> Unit </th>
                        <th> Quantity </th>
                    </tr>
                    <?php while ($rowSelectProduct = mysqli_fetch_array($resultSelectProduct)) { ?>
                        <tr>
                            <td><?php echo $rowSelectProduct['pro_id']; ?></td>
                            <td><?php echo $rowSelectProduct['pro_name']; ?></td>
                            <td><?php echo $rowSelectProduct['unit_name']; ?></td>
                            <td><input type="text" name="txtQuantity[<?php echo $rowSelectProduct['pro_id']; ?>]" value="<?php echo $rowSelectProduct['quantity']; ?>" size="10" /></td>
                        </tr>
                    <?php } ?>
                </table>
                <br>
                <input id="btnSubmit" type="submit" value="Update Stock" class="submit_button" />
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