<?php
	$page = 'login';
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Final Project</title>
	<?php require_once "style/bootstrap.php";?>
</head>
<body>
	<?php require_once 'style/navbar.php';?>
	<?php require_once 'views/pages/'.$page.'.php' ?>
</body>
</html>