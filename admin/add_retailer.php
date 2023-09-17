<?php
include("../includes/config.php");
include("../includes/validate_data.php");
session_start();
if (isset($_SESSION['admin_login'])) {
    if ($_SESSION['admin_login'] == true) {
        $username = $password = $phone = $email = $address = "";
        $usernameErr = $passwordErr = $phoneErr = $emailErr = $requireErr = $confirmMessage = "";
        $usernameHolder = $phoneHolder = $emailHolder = $addressHolder = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!empty($_POST['txtRetailerUname'])) {
                $usernameHolder = $_POST['txtRetailerUname'];
                $resultValidate_username = validate_username($_POST['txtRetailerUname']);
                if ($resultValidate_username == 1) {
                    $username = $_POST['txtRetailerUname'];
                } else {
                    $usernameErr = $resultValidate_username;
                }
            }
            if (!empty($_POST['txtRetailerPassword'])) {
                $resultValidate_username = validate_password($_POST['txtRetailerPassword']);
                if ($resultValidate_username == 1) {
                    $password = $_POST['txtRetailerPassword'];
                } else {
                    $passwordErr = $resultValidate_username;
                }
            }
            if (!empty($_POST['txtRetailerPhone'])) {
                $phoneHolder = $_POST['txtRetailerPhone'];
                $resultValidate_phone = validate_phone($_POST['txtRetailerPhone']);
                if ($resultValidate_phone == 1) {
                    $phone = $_POST['txtRetailerPhone'];
                } else {
                    $phoneErr = $resultValidate_phone;
                }
            }
            if (!empty($_POST['txtRetailerEmail'])) {
                $emailHolder = $_POST['txtRetailerEmail'];
                $resultValidate_email = validate_email($_POST['txtRetailerEmail']);
                if ($resultValidate_email == 1) {
                    $email = $_POST['txtRetailerEmail'];
                } else {
                    $emailErr = $resultValidate_email;
                }
            }
            if (!empty($_POST['txtRetailerAddress'])) {
                $address = $_POST['txtRetailerAddress'];
                $addressHolder = $_POST['txtRetailerAddress'];
            }
            if ($username != null && $password != null && $phone != null) {
                $query_addRetailer = "INSERT INTO retailer(username,password,address,phone,email) VALUES('$username','$password','$address','$phone','$email')";
                if (mysqli_query($con, $query_addRetailer)) {
                    echo "<script> alert(\"Retailer Added Successfully\"); </script>";
                    header('Refresh:0');
                } else {
                    $requireErr = "Adding Retailer Failed";
                }
            } else {
                $requireErr = "* Valid Username, Password & Email are compulsory";
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
                <a href="add_retailer.php" class="active">
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
            <h1>Add Retailer</h1>
            <form action="" method="POST" class="form">
                <ul class="form-list">
                    <li>
                        <div class="label-block"> <label for="retailer:username">Username</label> </div>
                        <div class="input-box"> <input type="text" id="retailer:username" name="txtRetailerUname" placeholder="Username" value="<?php echo $usernameHolder; ?>" required /> </div> <span class="error_message"><?php echo $usernameErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="retailer:password">Password</label> </div>
                        <div class="input-box"> <input type="password" id="retailer:password" name="txtRetailerPassword" placeholder="Password" required /> </div> <span class="error_message"><?php echo $passwordErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="retailer:phone">Phone</label> </div>
                        <div class="input-box"> <input type="text" id="retailer:phone" name="txtRetailerPhone" placeholder="Phone" value="<?php echo $phoneHolder; ?>" /> </div> <span class="error_message"><?php echo $phoneErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="retailer:email">Email</label> </div>
                        <div class="input-box"> <input type="text" id="retailer:email" name="txtRetailerEmail" placeholder="Email" value="<?php echo $emailHolder; ?>" required /> </div> <span class="error_message"><?php echo $emailErr; ?></span>
                    </li>
                    <li>
                        <div class="label-block"> <label for="retailer:address">Address</label> </div>
                        <div class="input-box"> <textarea type="text" id="retailer:address" name="txtRetailerAddress" placeholder="Address"><?php echo $addressHolder; ?></textarea> </div>
                    </li>
                    <li>
                        <input type="submit" value="Add Retailer" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
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