<?php include '../php/SecurityLoggedIn.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<div class="main">
		<div>
			<?php
			session_destroy();
			echo "<script>window.location.href = '../php/Layout.php'</script>".PHP_EOL;
			// echo "<script>if (confirm('Ziur al zaude?')) {alert('Gero arte ".$_GET['eposta']."'); window.location.href = '../php/Layout.php'} else {history.go(-1)}</script>".PHP_EOL; 
		?>
		</div>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>