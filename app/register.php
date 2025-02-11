<?php
session_start();
require '../user_conn.php';

if(isset($_POST['register'])){
	$username = $_POST['username'];
	$email    = $_POST['email'];
	$password = $_POST['password'];

	$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
	if($stmt->rowCount() > 0){
        echo "exists";
        exit;
    }

	$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->execute([$username]);
    if($stmt->rowCount() > 0){
        echo "exists";
        exit;
    }

	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	$stmt = $conn->prepare("INSERT INTO user(username, email, password) VALUES(?, ?, ?)");
    if($stmt->execute([$username, $email, $hashedPassword])){
        header("location:../signin.php");
        exit;
    } else {
        echo "Error";
    }
	
}

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        session_start();
        $_SESSION['username'] = $user['username'];
        header("Location:../index.php");
        exit();
    } else {
        echo "not found";
    }
}
?>