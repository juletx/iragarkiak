<?php session_start (); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html' ?>
	<script src="../js/GetFullDescription.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<div class="main">
		<span class="sarrera">
			<h3>Ongi etorri 100 Iragarki-ra bigarren eskuko erosketak eta salmentak egiteko toki egokiena</h3>
		</span>
		<div class="home">
			<div class="home-title">
				<h1>Zerren bila zabiltza?</h1>
			</div>
			<div class="home-kategoriak">
				<ul class="home-kategoriak-lista">
					<li>KOTXIAK</li>
					<li>MOBILAK</li>
					<li>ETXIAK</li>
				</ul>
			</div>
			<?php
            include '../php/DbConfig.php';
            $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
            
            $sql = "SELECT * FROM ads NATURAL JOIN users";
			$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

			while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
				echo '
						<div class="home-anuntzio" id="home-anuntzio'.$row['ad_id'].'">
							<div class="home-anuntzio-head"></div>
							<div class="home-anuntzio-detail">
								<div class="home-anuntzio-detail-textu">
									<a href="Ad.php?ad_id='.$row['ad_id'].'" class="home-anuntzio-detail-textu-title"><b>'.$row['title'].'</b></a><br>
									<i class="fa fa-list-alt" aria-hidden="true">'.$row['category'].'</i>
									<div class="home-anuntzio-detail-textu-tokiordu">
										<span class="home-anuntzio-detail-textu-toki"><i class="fa fa-map-marker"
											style="font-size:24px">'.$row['city'].'</i></span>
										<span class="home-anuntzio-detail-textu-denbora"><i class="fa fa-clock-o"
											aria-hidden="true" style="font-size:24px">'.$row['date'].'</i></span>
									</div>
									<div class="home-anuntzio-detail-deskripzio">';
									  echo substr($row['text'] , 0, 400);
									  if(strlen($row['text'])>400){
										echo '<a href=\'javascript:;\' onclick=\'GetFullDescription('. $row['ad_id'] .');\'> ... Gehiago erakutsi[+] </a>';
										}
									//Aukeratu anuntzioari dagokion irudien karpetatik lehenengo irudaren izena
										$files = scandir ($row['images']);
										$firstFile = $row['images'] . $files[2];// because [0] = "." [1] = ".." 
									echo '</div>
								</div>
								<div class="home-anuntzio-detail-irudi">
									<img class="home-anuntzio-detail-irudi-txiki" src="'. $firstFile .'">
								</div>
							</div>
							<p class="prezioa">'.$row['price'].'€</p><br><br><br>
							<div class="home-anuntzio-footer">
								<a href="#" class="home-anuntzio-footer-kontaktua">&#9743;'.$row['telephone'].'</a>
								<a href="#" class="home-anuntzio-footer-kontaktua">&#9993;'.$row['email'].'</a>
							</div>
						</div>';
			}

			mysqli_free_result($emaitza);
            mysqli_close($esteka);
			?>
		</div>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>