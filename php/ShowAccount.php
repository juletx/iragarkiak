<?php include '../php/SecurityLoggedIn.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div id="taula">
			<h2>Kontua kudeatu</h2>
			<br>
            <?php
                include '../php/DbConfig.php';
				$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
				
				$email = $_SESSION['email'];
			
				$sql = "SELECT * FROM users WHERE email='$email'";
				$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

				echo '<table> <thead> <tr> <th> EPOSTA </th> 
            	<th> PASAHITZA </th> <th> IZENA </th> 
            	<th> ABIZENA 1 </th> <th> ABIZENA 2 </th> 
				<th> TELEFONOA </th> </thead> <tbody>';
				   
				while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
					echo '<tr> <td>'.$row['email'].'</td> <td style="word-wrap:break-word; max-width:300px">'.$row['password'].
					'</td> <td>'.$row['name'].'</td> <td>'.$row['surname1'].'</td> <td>'.$row['surname2'].'</td> <td>'.$row['telephone'].'</td> </tr>';
				}
	
				echo '</tbody> </table>';

				mysqli_free_result($emaitza);
            	mysqli_close($esteka);
            ?>
        </div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>