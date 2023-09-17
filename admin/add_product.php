<?php
include("../includes/config.php");
include("../includes/validate_data.php");
session_start();
if (isset($_SESSION['admin_login'])) {
    if ($_SESSION['admin_login'] == true) {
        $query_selectCategory = "SELECT cat_id,cat_name FROM categories";
        $query_selectUnit = "SELECT id,unit_name FROM unit";
        $result_selectCategory = mysqli_query($con, $query_selectCategory);
        $result_selectUnit = mysqli_query($con, $query_selectUnit);
        $name = $price = $unit = $category = $rdbStock = $description = "";
        $nameErr = $priceErr = $requireErr = $confirmMessage = "";
        $nameHolder = $priceHolder = $descriptionHolder = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!empty($_POST['txtProductName'])) {
                $nameHolder = $_POST['txtProductName'];
                $name = $_POST['txtProductName'];
            }
            if (!empty($_POST['txtProductPrice'])) {
                $priceHolder = $_POST['txtProductPrice'];
                $resultValidate_price = validate_price($_POST['txtProductPrice']);
                if ($resultValidate_price == 1) {
                    $price = $_POST['txtProductPrice'];
                } else {
                    $priceErr = $resultValidate_price;
                }
            }
            if (isset($_POST['cmbProductUnit'])) {
                $unit = $_POST['cmbProductUnit'];
            }
            if (isset($_POST['cmbProductCategory'])) {
                $category = $_POST['cmbProductCategory'];
            }
            if (!empty($_POST['txtProductDescription'])) {
                $description = $_POST['txtProductDescription'];
                $descriptionHolder = $_POST['txtProductDescription'];
            }
            if ($name != null && $price != null && $unit != null && $category != null) {
                $query_addProduct = "INSERT INTO products(pro_name,pro_desc,pro_price,unit,pro_cat) VALUES('$name','$description','$price','$unit','$category')";
                if (mysqli_query($con, $query_addProduct)) {
                    echo "<script> alert(\"Product Added Successfully\"); </script>";
                    header('Refresh:0');
                } else {
                    $requireErr = "Adding Product Failed";
                }
            } 
            else {
                $requireErr = "* All Fields are Compulsory with valid values except Description";
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
                <a href="add_product.php" class="active">
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
                <span class="admin_name"><a style="text-decoration:none;color:black;" href="change_password.php">Profile</a></span>
                <!-- <i class='bx bx-chevron-down'></i> -->
            </div>
        </nav>
        <div style="padding-top: 100px; padding-left:10px; padding-right:10px;">
            <h1>Add Product</h1>
            <br>
            <form action="" method="POST" class="form">
                <ul class="form-list">
                    <li>
                        <div class="label-block"> <label for="product:name">Product Name</label> </div>
                        <div class="input-box"> <input type="text" id="product:name" name="txtProductName" placeholder="Product Name" value="<?php echo $nameHolder; ?>" required /> </div> <span class="error_message"><?php echo $nameErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="product:price">Price</label> </div>
                        <div class="input-box"> <input type="text" id="product:price" name="txtProductPrice" placeholder="Price" value="<?php echo $priceHolder; ?>" required /> </div> <span class="error_message"><?php echo $priceErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="product:unit">Unit Type</label> </div>
                        <div class="input-box">
                            <select name="cmbProductUnit" id="product:unit">
                                <option value="" disabled selected>--- Select Unit ---</option>
                                <?php while ($row_selectUnit = mysqli_fetch_array($result_selectUnit)) { ?>
                                    <option value="<?php echo $row_selectUnit["id"]; ?>"> <?php echo $row_selectUnit["unit_name"]; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="label-block"> <label for="product:category">Category</label> </div>
                        <div class="input-box">
                            <select name="cmbProductCategory" id="product:category">
                                <option value="" disabled selected>--- Select Category ---</option>
                                <?php while ($row_selectCategory = mysqli_fetch_array($result_selectCategory)) { ?>
                                    <option value="<?php echo $row_selectCategory["cat_id"]; ?>"> <?php echo $row_selectCategory["cat_name"]; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="label-block"> <label for="product:description">Description</label> </div>
                        <div class="input-box"> <textarea type="text" id="product:description" name="txtProductDescription" placeholder="Description"><?php echo $descriptionHolder; ?></textarea> </div>
                    </li>
                    <li>
                        <input type="submit" value="Add Product" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
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