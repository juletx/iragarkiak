<?php session_start (); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<script src="../js/ClientGeolocationAjax.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<div class="main">
		<div>
			<h2>Kredituak</h2>
			<br>
			<h3>Deiturak: Markel Azpeitia, Julen Etxaniz, Jokin Irastorza eta Aitor Zubillaga</h3>

			<h3>Gradua: Ingeniaritza Informatikoa</h3>

			<h3>Espezialitateak: Software Ingeniaritza eta Konputagailuen Ingeniaritza</h3>
			
			<h3>Ikasgaia: Sare Zerbitzuak eta Aplikazioak</h3>

			<br>
			<figure class="credits-image">
				<img src="../images/MarkelAzpeitia.png" alt="Markel Azpeitia">
				<figcaption>Markel Azpeitia</figcaption>
			</figure>
		
			<figure class="credits-image">
				<img src="../images/JulenEtxaniz.jpg" alt="Julen Etxaniz">
				<figcaption>Julen Etxaniz</figcaption>
			</figure>
			
			<figure class="credits-image">
				<img src="../images/JokinIrastorza.jpg" alt="Jokin Irastorza">
				<figcaption>Jokin Irastorza</figcaption>
			</figure>

			<figure class="credits-image">
				<img src="../images/AitorZubillaga.png" alt="Aitor Zubillaga">
				<figcaption>Aitor Zubillaga</figcaption>
			</figure>
		</div>
		<br>
		<div id="taula">
			<h2>Bezeroaren eta zerbitzariaren datuak</h2>
			<table>
				<thead>
					<tr>
						<th style="visibility:hidden;"></th>
						<th>IP</th>
						<th>HOSTNAME</th>
						<th>CONTINENT</th>
						<th>COUNTRY</th>
						<th>REGION</th>
						<th>CITY</th>
						<th>ZIP</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><b>CLIENT</b></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php include '../php/ClientGeolocation.php' ?>
				<tbody>
			</table>
		</div>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>