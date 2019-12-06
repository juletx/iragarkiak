<?php session_start (); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<script src="../js/ClientGeolocationAjax.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	
		
	<div class="main" id="Credits">
		<br><br><br>
		<h2>Babesleak</h2>

		<a href="https://basqueindustry.spri.eus">
			<figure class="credits-image">
					<img src="../images/basque40.png" alt="Industry" height=70>
					<figcaption>Basque Industry 4.0</figcaption>
			</figure>
		</a>

		<a href="https://www.goierrivalley.com/eu/">
			<figure class="credits-image">
					<img src="../images/goierri.png" alt="Goierri" height=70>
					<figcaption>Goierry Valley Alliance</figcaption>
			</figure>
		</a>

		<a href="https://www.bermeotunaworldcapital.org/eu/hasiera/">
			<figure class="credits-image">
					<img src="../images/bermeo.jpg" alt="Bermeo" height=70>
					<figcaption>Bermeo World Tuna Capital</figcaption>
			</figure>
		</a>

		<a href="https://sansebastianregion.com/eu/">
			<figure class="credits-image">
					<img src="../images/sansebastian.png" alt="SanSebastian" height=70>
					<figcaption>Explore San Sebastian Region</figcaption>
			</figure>
		</a>

		<div class="main" id="Credits">
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
		<div>

		<div class="main">
			<h2>Kredituak</h2><br>

			<h4>Egileak: Markel Azpeitia, Julen Etxaniz, Jokin Irastorza eta Aitor Zubillaga</h4>
			<h4>Gradua: Ingeniaritza Informatikoa</h4>
			<h4>Espezialitateak: Software Ingeniaritza eta Konputagailuen Ingeniaritza</h4>
			<h4>Ikasgaia: Sare Zerbitzuak eta Aplikazioak</h4>
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


	</div>
	
	<?php include '../html/Footer.html' ?>
</body>

</html>