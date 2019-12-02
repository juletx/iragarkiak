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

				echo '<table> <thead> <tr> <th> EPOSTA </th> <th> IZENA </th> 
				<th> ABIZENA 1 </th> <th> ABIZENA 2 </th> <th> TELEFONOA </th> <th> MOTA </th>
				<th> EGOERA </th> <th> EGOERA ALDATU </th> <th> EZABATU </th> </tr> </thead> <tbody>';
				   
				while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
					echo '<tr> <td>'.$row['email'].'</td> <td>'.$row['name'].'</td> <td>'.$row['surname1'].'</td> 
					<td>'.$row['surname2'].'</td> <td>'.$row['telephone'].'</td> <td>'.admin($row['admin']).'</td> 
					<td>'.banned($row['banned']).'</td> <td>'.aldatuButton($row['admin']).'</td> <td> '.ezabatuButton($row['admin']).' </td> </tr>';
				}
	
				echo '</tbody> </table>';

				function admin($admin) {
					if ($admin)
						return "<span style='color:blue'>Admin</span>";
					return "<span>Arrunta</span>";
				}

				function banned($banned) {
					if ($banned)
						return "<span style='color:red'>Baneatuta</span>";
					return "<span style='color:green'>Aktibatuta</span>";
				}

				function aldatuButton($admin) {
					if ($admin)
						return '<button class="aldatu btn btn-warning" disabled>Egoera aldatu</button>';
					return '<button class="aldatu btn btn-warning">Egoera aldatu</button>';
				}

				function ezabatuButton($admin) {
					if ($admin)
						return '<button class="ezabatu btn btn-danger" disabled>Ezabatu</button>';
					return '<button class="ezabatu btn btn-danger">Ezabatu</button>';
				}

				mysqli_free_result($emaitza);
            	mysqli_close($esteka);
            ?>
        </div>
	</div>
    <?php include '../html/Footer.html' ?>
</body>

</html>