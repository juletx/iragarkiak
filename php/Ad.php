<?php session_start (); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html' ?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<div class="main">
		<?php
		$ad_id = trim($_GET["ad_id"]);
		if (empty($ad_id)) {
			echo "<script>alert('Id-rik ez dago'); history.go(-1);</script>";
			exit();
		}

		include '../php/DbConfig.php';
		$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
		
		$sql = "SELECT * FROM ads NATURAL JOIN users WHERE ad_id=$ad_id";
		$result = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");

		$lerroKopurua = mysqli_num_rows($result);
		if ($lerroKopurua == 0) {
			echo "<script>alert('Id okerra'); history.go(-1);</script>";
		}
		else {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			echo 	'<div class="ad-big">
						<div class="ad-big-header">
							<img class="avatar-small" src="../images/avatar.jpg" alt="Avatar">
							<p>'.$row['email'].'</p>
						</div>
						<div class="ad-image">
							<img src="'.$row['images'].'quiz.png">
						</div>
						<div class="ad-big-footer">
							<div class="ad-big-footer-price">'.$row['price'].'</div>
							<div class="ad-big-footer-title">'.$row['title'].'</div>
							<div class="ad-big-footer-description">
								'.$row['text'].'
							</div>
						</div>
					</div>';
		}

		mysqli_free_result($result);
		mysqli_close($link);
		?>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>