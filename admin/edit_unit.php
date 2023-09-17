<?php
include("../includes/config.php");
include("../includes/validate_data.php");
session_start();
if (isset($_SESSION['admin_login'])) {
    if ($_SESSION['admin_login'] == true) {
        $id = $_GET['id'];
        $query_selectUnitDetails = "SELECT * FROM unit WHERE id='$id'";
        $result_selectUnitDetails = mysqli_query($con, $query_selectUnitDetails);
        $row_selectUnitDetails = mysqli_fetch_array($result_selectUnitDetails);
        $unitName = $unitDetails = "";
        $unitNameErr = $requireErr = $confirmMessage = "";
        $unitNameHolder = $unitDetailsHolder = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!empty($_POST['txtUnitName'])) {
                $unitNameHolder = $_POST['txtUnitName'];
                $result = validate_name($_POST['txtUnitName']);
                if ($result == 1) {
                    $unitName = $_POST['txtUnitName'];
                } else {
                    $unitNameErr = $result;
                }
            }
            if (!empty($_POST['txtunitDetails'])) {
                $unitDetails = $_POST['txtunitDetails'];
                $unitDetailsHolder = $_POST['txtunitDetails'];
            }
            if ($unitName != null) {
                $query_UpdateUnit = "UPDATE unit SET unit_name='$unitName',unit_details='$unitDetails' WHERE id='$id'";
                if (mysqli_query($con, $query_UpdateUnit)) {
                    echo "<script> alert(\"Unit Updated Successfully\"); </script>";
                    header('Refresh:0;url=view_unit.php');
                } else {
                    $requireErr = "Updating Unit Failed";
                }
            } else {
                $requireErr = "* Valid Unit Name is required";
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
                <a href="view_unit.php" class="active">
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
            <h1>Update Unit</h1>
            <form action="" method="POST" class="form">
                <ul class="form-list">
                    <li>
                        <div class="label-block"> <label for="unitName">Unit Name</label> </div>
                        <div class="input-box"> <input type="text" id="unitName" name="txtUnitName" placeholder="Unit Name" value="<?php echo $row_selectUnitDetails['unit_name']; ?>" required /> </div> <span class="error_message"><?php echo $unitNameErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="unitDetails">Details</label> </div>
                        <div class="input-box"><textarea id="unitDetails" name="txtunitDetails" placeholder="Details"><?php echo $row_selectUnitDetails['unit_details']; ?></textarea> </div>
                    </li>
                    <li>
                        <input type="submit" value="Update Unit" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
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