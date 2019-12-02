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
			$directory = "../images/ads/".$row['ad_id']."/";
			$files = scandir($directory);
			$firstFile = $directory . $files[2];// because [0] = "." [1] = ".." 
			$images = glob("../images/users/".$row['email'].".*");
			if (empty($images)) {
				$avatar = "../images/Anonimoa.png";
			}
			else {
				$avatar = $images[0];
			}
			echo 	'<div class="ad-big">
						<div class="ad-big-header">
							<img class="avatar-small" src="'.$avatar.'" alt="Avatar">
							<a href="ShowAdvertisementsUser.php?email='.$row['email'].'"><p>'.$row['email'].'</p></a>
						</div>
						<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
						<!--Slides-->
						<div class="carousel-inner" role="listbox">';
						$images = glob($directory."*.*");
						$i = 0;
						foreach ($images as $image) {
							if ($i == 0) {
								echo'<div class="carousel-item active">
								<img class="d-block w-100" src="'.$image.'"
								alt="First slide">
							</div>'; 
							}else {
								echo'<div class="carousel-item">
								<img class="d-block w-100" src="'.$image.'"
								alt="Next slides">
							</div>';
							}
							$i++;     
						}
						echo'</div>
						<!--/.Slides-->
						<!--Controls-->
						<a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						<!--/.Controls-->
						</div>
						<div class="ad-big-footer">
							<div class="ad-big-footer-title">'.$row['title'].'</div>
							<div class="ad-big-footer-price">'.$row['price'].'€</div>
							<div class="ad-big-footer-description">'.$row['text'].'</div>
						</div>';
						if (isset($_SESSION['email'])) {
							$email_db = $row['email'];
							$email_session = $_SESSION['email'];
			
							$sql = "SELECT admin FROM users WHERE email='$email_session'";
							$result2 = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");
			
							$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
			
							if ($row2['admin'] || $email_session == $email_db) {
								echo 	'<br><div>
											<span><a class="btn btn-success" href="EditAdvertisement.php?ad_id='.$row['ad_id'].'">Iragarkia editatu</a></span>
											<span><a class="btn btn-danger" onclick="'; echo 'if (confirm(\'Ziur al zaude?\')) location.href=\'DeleteAdvertisement.php?ad_id='.$row['ad_id'].'\'">Iragarkia ezabatu</a></span>
										</div>';
							}
						}
					echo '</div>';
		}

		mysqli_free_result($result);
		mysqli_close($link);
		?>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>