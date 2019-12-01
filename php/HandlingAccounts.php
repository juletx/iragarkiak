<?php include '../php/SecurityAdmin.php' ?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
	<script src="../js/ChangeStateAjax.js"></script>
	<script src="../js/RemoveUserAjax.js"></script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <div class="main">
        <div id="taula">
			<h2>Erabiltzaileak kudeatu</h2>
			<br>
            <?php
                include '../php/DbConfig.php';
				$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
			
				$sql = "SELECT * FROM users";
				$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

				echo '<table> <thead> <tr> <th> EPOSTA </th> 
            	<th> PASAHITZA </th> <th> IZENA </th> 
            	<th> ABIZENA 1 </th> <th> ABIZENA 2 </th> 
				<th> TELEFONOA </th> <th> EGOERA </th>
				<th> ALDATU </th> <th> EZABATU </th> </tr> </thead> <tbody>';
				   
				while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
					echo '<tr> <td>'.$row['email'].'</td> <td style="word-wrap:break-word; max-width:300px">'.$row['password'].
					'</td> <td>'.$row['name'].'</td> <td>'.$row['surname1'].'</td> <td>'.$row['surname2'].'</td> <td>'.$row['telephone'].'</td>
					<td>'.banned($row['banned']).'</td> <td> <button class="aldatu">Egoera aldatu</button>
					</td> <td> <button class="ezabatu">Ezabatu</button> </td> </tr>';
				}
	
				echo '</tbody> </table>';

				function banned($banned) {
					if ($banned)
						return "Baneatuta";
					return "Aktibatuta";
				}

				mysqli_free_result($emaitza);
            	mysqli_close($esteka);
            ?>
        </div>
	</div>
    <?php include '../html/Footer.html' ?>
</body>

</html>