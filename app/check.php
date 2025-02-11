<?php

if(isset($_POST['id'])){
	require '../db_conn.php';

	$id = $_POST['id'];

	if(empty($id)){
		echo 'error';

	}else{
		$todos = $conn->prepare("SELECT id, checked FROM todos WHERE id = ?");
		$todos->execute([$id]);
		$todo = $todos->fetch(PDO::FETCH_ASSOC);
		
		if ($todo) {
			$uId = $todo['id'];
			$checked = $todo['checked'];
			$uChecked = $checked ? 0 : 1;
		
			$stmt = $conn->prepare("UPDATE todos SET checked = ? WHERE id = ?");
			$res = $stmt->execute([$uChecked, $uId]);
		
			if($res){
				echo $checked;
			} else {
				echo "error";
			}
		} else {
			echo "error";
		}
		
		$conn = null;
		exit();
	}
}else{
	header("Location: ../index.php?mess=error" );

}