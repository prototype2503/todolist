<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
	<!--デバイスの横長に合わせる-->
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<title>register</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="wrapper">
		<div class="form-box login">
			<h2>login</h2>
			<form method="post" action="app/register.php">
				<div class="input-box">
					<span class="icon"><ion-icon name="person"></ion-icon></span>
					<input name="username" required>
					<label>username</label>
				</div>
				<div class="input-box">
					<span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
					<input name="password" type="password" required>
					<label>Password</label>
				</div>
				<div class="remember-forgot">
					<label><input type="checkbox">Remember me</label>
					<a href="#">Forgot Password?</a>
				</div>
				<button type="submit" class="btn" id="loginbtn" name="login">Login</button>
				<div class="login-register"><p>Don't have an account?<a href="#" class="register-link">Register</a></p></div>
			</form>
		</div>

		<div class="form-box register">
			<h2>register</h2>
			<form method="post" action="app/register.php">
				<div class="input-box">
					<span class="icon"><ion-icon name="person"></ion-icon></span>
					<input name="username" required>
					<label>username</label>
				</div>
				<div class="input-box">
					<span class="icon"><ion-icon name="mail"></ion-icon></span>
					<input name="email" type="email" required>
					<label>Email</label>
				</div>
				<div class="input-box">
					<span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
					<input name="password" type="password" required>
					<label>Password</label>
				</div>
				<div class="remember-forgot">
					<label><input type="checkbox">Agree</label>
				</div>
				<button type="submit" class="btn" id="registerbtn" name="register">Register</button>
				<div class="login-register"><p>Already have an account?<a href="#" class="login-link">Login</a></p></div>
			</form>
		</div>
	</div>

	<script src="js/script.js"></script>
	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>