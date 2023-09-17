<?php
include("../includes/config.php");
include("../includes/validate_data.php");
session_start();
if (isset($_SESSION['manufacturer_login'])) {
	if ($_SESSION['manufacturer_login'] == true) {
		$id = $_GET['id'];
		$query_selectProductDetails = "SELECT * FROM products WHERE pro_id='$id'";
		$result_selectProductDetails = mysqli_query($con, $query_selectProductDetails);
		$row_selectProductDetails = mysqli_fetch_array($result_selectProductDetails);
		$query_selectCategory = "SELECT cat_id,cat_name FROM categories";
		$query_selectUnit = "SELECT id,unit_name FROM unit";
		$result_selectCategory = mysqli_query($con, $query_selectCategory);
		$result_selectUnit = mysqli_query($con, $query_selectUnit);
		$name = $price = $unit = $category = $description = "";
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
				$query_UpdateProduct = "UPDATE products SET pro_name='$name',pro_desc='$description',pro_price='$price',unit='$unit',pro_cat='$category' WHERE pro_id='$id'";
				if (mysqli_query($con, $query_UpdateProduct)) {
					echo "<script> alert(\"Product Updated Successfully\"); </script>";
					header('Refresh:0;url=view_products.php');
				} else {
					$requireErr = "Updating Product Failed";
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
				<a href="view_products.php" class="active">
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
			<h1>Edit Product</h1>
			<form action="" method="POST" class="form">
				<ul class="form-list">
					<li>
						<div class="label-block"> <label for="product:name">Product Name</label> </div>
						<div class="input-box"> <input type="text" id="product:name" name="txtProductName" placeholder="Product Name" value="<?php echo $row_selectProductDetails['pro_name']; ?>" required /> </div> <span class="error_message"><?php echo $nameErr; ?></span>
					</li>
					<li>
						<div class="label-block"> <label for="product:price">Price</label> </div>
						<div class="input-box"> <input type="text" id="product:price" name="txtProductPrice" placeholder="Price" value="<?php echo $row_selectProductDetails['pro_price']; ?>" required /> </div> <span class="error_message"><?php echo $priceErr; ?></span>
					</li>
					<li>
						<div class="label-block"> <label for="product:unit">Unit Type</label> </div>
						<div class="input-box">
							<select name="cmbProductUnit" id="product:unit">
								<option value="" disabled selected>--- Select Unit ---</option>
								<?php while ($row_selectUnit = mysqli_fetch_array($result_selectUnit)) { ?>
									<option value="<?php echo $row_selectUnit["id"]; ?>" <?php if ($row_selectProductDetails['unit'] == $row_selectUnit["id"]) {
																								echo "selected";
																							} ?>> <?php echo $row_selectUnit["unit_name"]; ?> </option>
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
									<option value="<?php echo $row_selectCategory["cat_id"]; ?>" <?php if ($row_selectProductDetails['pro_cat'] == $row_selectCategory["cat_id"]) {
																										echo "selected";
																									} ?>> <?php echo $row_selectCategory["cat_name"]; ?> </option>
								<?php } ?>
							</select>
						</div>
					</li>
					<li>
						<div class="label-block"> <label for="product:description">Description</label> </div>
						<div class="input-box"> <textarea type="text" id="product:description" name="txtProductDescription" placeholder="Description"><?php echo $row_selectProductDetails['pro_desc']; ?></textarea> </div>
					</li>
					<li>
						<input type="submit" value="Update Product" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
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