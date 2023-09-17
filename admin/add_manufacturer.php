<?php
include("../includes/config.php");
include("../includes/validate_data.php");
session_start();
if (isset($_SESSION['admin_login'])) {
    if ($_SESSION['admin_login'] == true) {
        $name = $email = $phone = $username = $password = "";
        $nameErr = $emailErr = $phoneErr = $usernameErr = $passwordErr = $requireErr = $confirmMessage = "";
        $nameHolder = $emailHolder = $phoneHolder = $usernameHolder = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!empty($_POST['txtManufacturerName'])) {
                $nameHolder = $_POST['txtManufacturerName'];
                $resultValidate_name = validate_name($_POST['txtManufacturerName']);
                if ($resultValidate_name == 1) {
                    $name = $_POST['txtManufacturerName'];
                } else {
                    $nameErr = $resultValidate_name;
                }
            }
            if (!empty($_POST['txtManufacturerEmail'])) {
                $emailHolder = $_POST['txtManufacturerEmail'];
                $resultValidate_email = validate_email($_POST['txtManufacturerEmail']);
                if ($resultValidate_email == 1) {
                    $email = $_POST['txtManufacturerEmail'];
                } else {
                    $emailErr = $resultValidate_email;
                }
            }
            if (!empty($_POST['txtManufacturerPhone'])) {
                $phoneHolder = $_POST['txtManufacturerPhone'];
                $resultValidate_phone = validate_phone($_POST['txtManufacturerPhone']);
                if ($resultValidate_phone == 1) {
                    $phone = $_POST['txtManufacturerPhone'];
                } else {
                    $phoneErr = $resultValidate_phone;
                }
            }
            if (!empty($_POST['txtManufacturerUname'])) {
                $usernameHolder = $_POST['txtManufacturerUname'];
                $resultValidate_username = validate_username($_POST['txtManufacturerUname']);
                if ($resultValidate_username == 1) {
                    $username = $_POST['txtManufacturerUname'];
                } else {
                    $usernameErr = $resultValidate_username;
                }
            }
            if (!empty($_POST['txtManufacturerPassword'])) {
                $resultValidate_password = validate_password($_POST['txtManufacturerPassword']);
                if ($resultValidate_password == 1) {
                    $password = $_POST['txtManufacturerPassword'];
                } else {
                    $passwordErr = $resultValidate_password;
                }
            }
            if ($name != null && $email != null && $username != null && $password != null) {
                $query_addManufacturer = "INSERT INTO manufacturer(man_name,man_email,man_phone,username,password) VALUES('$name','$email','$phone','$username','$password')";
                if (mysqli_query($con, $query_addManufacturer)) {
                    echo "<script> alert(\"Manufacturer Added Successfully\"); </script>";
                    header('Refresh:0');
                } else {
                    $requireErr = "Adding Manufacturer Failed";
                }
            } else {
                $requireErr = "* Valid Name, Email, Username & Password are compulsory";
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
                <a href="add_manufacturer.php" class="active">
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
            <h1>Add Manufacturer</h1>
            <br>
            <form action="" method="POST" class="form">
                <ul class="form-list">
                    <li>
                        <div class="label-block"> <label for="manufacturer:name">Name</label> </div>
                        <div class="input-box"> <input type="text" id="manufacturer:name" name="txtManufacturerName" placeholder="Name" value="<?php echo $nameHolder; ?>" required /> </div> <span class="error_message"><?php echo $nameErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="manufacturer:email">Email</label> </div>
                        <div class="input-box"> <input type="text" id="manufacturer:email" name="txtManufacturerEmail" placeholder="Email" value="<?php echo $emailHolder; ?>" required /> </div> <span class="error_message"><?php echo $emailErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="manufacturer:phone">Phone</label> </div>
                        <div class="input-box"> <input type="text" id="manufacturer:phone" name="txtManufacturerPhone" placeholder="Phone" value="<?php echo $phoneHolder; ?>" /> </div> <span class="error_message"><?php echo $phoneErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="manufacturer:username">Username</label> </div>
                        <div class="input-box"> <input type="text" id="manufacturer:username" name="txtManufacturerUname" placeholder="Username" value="<?php echo $usernameHolder; ?>" required /> </div> <span class="error_message"><?php echo $usernameErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="manufacturer:password">Password</label> </div>
                        <div class="input-box"> <input type="password" id="manufacturer:password" name="txtManufacturerPassword" placeholder="Password" required /> </div> <span class="error_message"><?php echo $passwordErr; ?></span>
                    </li>
                    <br>
                    <li>
                        <input type="submit" value="Add Manufacturer" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
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