<?php
include("../includes/config.php");
session_start();
if (isset($_SESSION['manufacturer_login'])) {
    if ($_SESSION['manufacturer_login'] == true) {
        $query_selectCategory = "SELECT * FROM categories";
        $result_selectCategory = mysqli_query($con, $query_selectCategory);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['chkId'])) {
                $chkId = $_POST['chkId'];
                foreach ($chkId as $id) {
                    $query_deleteCategory = "DELETE FROM categories WHERE cat_id='$id'";
                    $result = mysqli_query($con, $query_deleteCategory);
                }
                if (!$result) {
                    echo "<script> alert(\"Categories assigned to any product can not be deleted\"); </script>";
                    header('Refresh:0');
                } else {
                    echo "<script> alert(\"Category Deleted Successfully\"); </script>";
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
            <h1>View Category</h1>
            <form action="" method="POST" class="form">
                <table class="table_displayData">
                    <tr>
                        <th> <input type="checkbox" onClick="toggle(this)" /> </th>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Edit</th>
                    </tr>
                    <?php $i = 1;
                    while ($row_selectCategory = mysqli_fetch_array($result_selectCategory)) { ?>
                        <tr>
                            <td> <input type="checkbox" name="chkId[]" value="<?php echo $row_selectCategory['cat_id']; ?>" /> </td>
                            <td> <?php echo $i; ?> </td>
                            <td> <?php echo $row_selectCategory['cat_name']; ?> </td>
                            <td> <?php echo $row_selectCategory['cat_details']; ?> </td>
                            <td> <a href="edit_category.php?id=<?php echo $row_selectCategory['cat_id']; ?>">edit</a> </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </table>
                <br>
                <input type="submit" value="Delete" class="submit_button" />
                <a href="add_category.php"><input type="button" value="Add Category" class="submit_button" /></a>
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

        function toggle(source) {
            checkboxes = document.getElementsByName('chkId[]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
</body>

</html>