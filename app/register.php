<?php
require '../user_conn.php';

if(isset($_POST['register'])){
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$checkemail = "SELECT *From user where email='$email'";
	$resultemail = $conn -> query($checkemail);
	$checkuser = "SELECT *From user where email='$username'";
	$resultuser = $conn -> query($checkuser);
	if($resultemail -> rowCount() > 0){
		echo "exists";
	}
	else{
		if($resultuser -> rowCount() > 0){
			echo "exists";
		}
		else{
			$insertquery = "INSERT INTO user(username,email,password)
			VALUES('$username','$email','$password')";
			if($conn -> query($insertquery)==TRUE){
				header("location:../signin.php");
			}else{
				echo "Error";
			}
	
		}
	}
	
}

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT *From user where username='$username' and password='$password'";
	$result = $conn -> query($sql);
	if($result -> rowCount()>0){
		session_start();
		$row = $result -> fetch();
		$_SESSION['username'] = $row['username'];
		header("Location:../index.php");
		exit();
	}else{
		echo "not found";
	}
}
?>