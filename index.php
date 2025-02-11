<?php
session_start(); 


if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

$user = $_SESSION['username'];
?>

<?php
require 'db_conn.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Todo list</title>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/earlyaccess/notosansjp.css" rel="stylesheet">
</head>
<body>
	<header>
		<div class="logo">ツミを数えろ</div>
		<div class="user">
		<a href="app/logout.php">logout</a>
		</div>
	</header>
	<div class="main-section">
		<div class="container">
			<div class="childcontainer">
				<div class="add-section">
					<form action="app/add.php" method="POST" autocomplete="off">
						<?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){?>
							<input type="text" 
							name="title" 
							style = "border-color: #ff6666"
							placeholder ="タスクを入力" />
							<button type="submit">追加 &nbsp; <span>&#43;</span></button>
						<?php }else{?>
							<input type="text" name="title" placeholder="タスク" />
							<button type="submit">追加</button>
						<?php }?>
					</form>
				</div>
				<?php
					$todos = $conn->prepare("SELECT * FROM todos WHERE user = ? ORDER BY id DESC");
					$todos->execute([$user]);
					$result = $todos->fetchAll(PDO::FETCH_ASSOC);
				?>
				<div class="show-todo-section">
					<?php if(count($result) <= 0){?>
						<div class="todo-item">
							<div class="empty">
								<img src="" alt="">
							</div>
						</div>
					<?php }?>

					<?php foreach($result as $todo){?>
						<div class="todo-item">
							<span id = "<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
							<?php if($todo['checked']){?>
								<input type="checkbox" 
								data-todo-id = "<?php echo $todo['id']; ?>"
								class="check-box" />
								<h2 class="checked"><?php echo $todo['title'] ?></h2>
							<?php } else {?>
								<input type="checkbox" 
								data-todo-id = "<?php echo $todo['id']; ?>"
								class="check-box" />
								<h2><?php echo $todo['title'] ?></h2>
							<?php }?>
							<br>
							<small>created:<?php echo $todo['date_time'] ?></small>
						</div>
					<?php }?>
				</div>
			</div>
			<?php
			$alltodos = $conn->prepare("SELECT * FROM todos ORDER BY id DESC");
			$alltodos->execute();
			$allresult = $alltodos->fetchAll(PDO::FETCH_ASSOC);
			?>
			<div class="show-alltodo-section">
				<?php if(count($allresult) <= 0){?>
					<div class="todo-item">
						<div class="empty">
							<img src="" alt="">
						</div>
					</div>
				<?php }?>

				<?php foreach($allresult as $todo){?>
					<div class="todo-item">
						<?php if($todo['checked']){?>
							<input type="checkbox" 
							data-todo-id = "<?php echo $todo['id']; ?>"
							class="check-box" />
							<h2 class="checked"><?php echo $todo['title'] ?></h2>
						<?php } else {?>
							<input type="checkbox" 
							data-todo-id = "<?php echo $todo['id']; ?>"
							class="check-box" />
							<h2><?php echo $todo['title'] ?></h2>
						<?php }?>
						<br>
						<small>created:<?php echo $todo['date_time'] ?></small>
					</div>
				<?php }?>
			</div>	
		</div>
	</div>


	<script src="js/jquery-3.2.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.remove-to-do').click(function(){
				const id = $(this).attr('id');
				$.post("app/remove.php",
					{
						id: id
					},
					(data) => {
						if(data){
							$(this).parent().hide(600);
						}
					}
				);
			});
			$(".check-box").click(function(e){
				const id = $(this).attr('data-todo-id');

				$.post('app/check.php',
					{
						id: id
					},
					(data) =>{
						if(data != 'error'){
							const h2 = $(this).next();
							if(data === '1'){
								h2.removeClass('checked');
							}else{
								h2.addClass('checked');
							}
						}
					}
				)
			});
		});
	</script>
</body>
</html>

