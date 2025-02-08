<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['title'])){
	require '../db_conn.php';

	if (!isset($_SESSION['username'])) {
		header("Location: signin.php");
		exit();
	}
	
	$user = $_SESSION['username'];
	
	$title = $_POST['title'];

	if(empty($title)){
		header("Location: ../index.php?mess=error");

	}else{
		$stmt = $conn -> prepare("INSERT INTO todos(title,user) VALUES(?, ?)");
		$res = $stmt -> execute([$title, $user]);

		if($res){
			header("Location: ../index.php?mess=success" );
		}else{
			header("Location: ../index.php");
		}
		$conn = null;
		exit();
	}
}else{
	header("Location: ../index.php?mess=error" );

}
?>