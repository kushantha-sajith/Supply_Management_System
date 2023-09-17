<?php
include("../includes/config.php");
include("../includes/validate_data.php");
session_start();
if (isset($_SESSION['manufacturer_login'])) {
    if ($_SESSION['manufacturer_login'] == true) {
        $categoryName = $categoryDetails = "";
        $categoryNameErr = $requireErr = $confirmMessage = "";
        $categoryNameHolder = $categoryDetailsHolder = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!empty($_POST['txtCategoryName'])) {
                $categoryNameHolder = $_POST['txtCategoryName'];
                $categoryName = $_POST['txtCategoryName'];
            }
            if (!empty($_POST['txtCategoryDetails'])) {
                $categoryDetails = $_POST['txtCategoryDetails'];
                $categoryDetailsHolder = $_POST['txtCategoryDetails'];
            }
            if ($categoryName != null) {
                $query_addCategory = "INSERT INTO categories(cat_name,cat_details) VALUES('$categoryName','$categoryDetails')";
                if (mysqli_query($con, $query_addCategory)) {
                    echo "<script> alert(\"Category Added Successfully\"); </script>";
                    header('Refresh:0');
                } else {
                    $requireErr = "Adding New Category Failed";
                }
            } else {
                $requireErr = "* Valid Category Name is required";
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
                <a href="manage_stock.php">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Manage Stock</span>
                </a>
            </li>
            <li>
                <a href="view_category.php" class="active">
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
                <!-- <span class="dashboard">Dashboard</span> -->
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
            <h1>Add Category</h1>
            <form action="" method="POST" class="form">
                <ul class="form-list">
                    <li>
                        <div class="label-block"> <label for="categoryName">Category Name</label> </div>
                        <div class="input-box"> <input type="text" id="categoryName" name="txtCategoryName" placeholder="Category Name" value="<?php echo $categoryNameHolder; ?>" required /> </div> <span class="error_message"><?php echo $categoryNameErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="categoryDetails">Details</label> </div>
                        <div class="input-box"><textarea id="categoryDetails" name="txtCategoryDetails" placeholder="Details"><?php echo $categoryDetailsHolder; ?></textarea> </div>
                    </li>
                    <li>
                        <input type="submit" value="Add Category" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
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