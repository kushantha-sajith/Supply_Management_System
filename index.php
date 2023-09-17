<?php
	include('includes/config.php');
	$reqErr = $loginErr = "";
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(!empty($_POST['txtUsername']) && !empty($_POST['txtPassword']) && isset($_POST['login_type'])){
			session_start();
			$username = $_POST['txtUsername'];
			$password = $_POST['txtPassword'];
			$_SESSION['sessLogin_type'] = $_POST['login_type'];
			if($_SESSION['sessLogin_type'] == "retailer") {
				$query_selectRetailer = "SELECT retailer_id,username,password FROM retailer WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con,$query_selectRetailer);
				$row = mysqli_fetch_array($result);
				if($row) {
					$_SESSION['retailer_id'] =  $row['retailer_id'];
					$_SESSION['sessUsername'] = $_POST['txtUsername'];
					$_SESSION['sessPassword'] = $_POST['txtPassword'];
					$_SESSION['retailer_login'] = true;
					header('Location:retailer/index.php');
				}
				else {
					$loginErr = "* Username or Password is incorrect.";
				}
			}
			else if($_SESSION['sessLogin_type'] == "manufacturer") {
				$query_selectManufacturer = "SELECT man_id,username,password FROM manufacturer WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con,$query_selectManufacturer);
				$row = mysqli_fetch_array($result);
				if($row) {
					$_SESSION['manufacturer_id'] =  $row['man_id'];
					$_SESSION['sessUsername'] = $_POST['txtUsername'];
					$_SESSION['sessPassword'] = $_POST['txtPassword'];
					$_SESSION['manufacturer_login'] = true;
					header('Location:manufacturer/index.php');
				}
				else {
					$loginErr = "* Username or Password is incorrect.";
				}
			}
			else if($_SESSION['sessLogin_type'] == "admin") {
				$query_selectAdmin = "SELECT username,password FROM admin WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con,$query_selectAdmin);
				$row = mysqli_fetch_array($result);
					if($row) {
						$_SESSION['admin_login'] = true;
						$_SESSION['sessUsername'] = $_POST['txtUsername'];
						$_SESSION['sessPassword'] = $_POST['txtPassword'];
						header('Location:admin/index.php');
					}
					else {
						$loginErr = "* Username or Password is incorrect.";
					}
				}
			}
		else {
			$reqErr = "* All fields are required.";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Log In</title>
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
  <h1 style="text-align: center;">Welcome to SCM</h1>
    <form  action="" method="POST" class="login-form">
      <label for="login:username">Username :</label>
      <input type="text" id="login:username" name="txtUsername" placeholder="Username" required>
      <label for="login:password">Password :</label>
      <input type="password" id="login:password" name="txtPassword" placeholder="Password" required>
      <br>
      <label for="login:type">Log In As :</label><br>
      <select name="login_type" id="login:type" required>
      <option style="text-align:center;" value="" disabled selected>-- Select Type --</option>
      <option value="admin">Admin</option>
      <option value="manufacturer">Manufacturer</option>
      <option value="retailer">Retailer</option>
      </select><br>
      <input style="margin-top: 40px; margin-left: 90px;" type="submit" value="Login" class="submit_button" /> <span class="error_message"> <?php echo $loginErr; echo $reqErr; ?> </span>
    </form>
  </div>
</div>
</body>
</html>