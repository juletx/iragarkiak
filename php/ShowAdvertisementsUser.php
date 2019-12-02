<?php session_start (); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html' ?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<div class="main">
		<h2>Iragarki pertsonalak</h2>
		<?php include '../php/ShowAdvertisementsFilter.php'; ?>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>