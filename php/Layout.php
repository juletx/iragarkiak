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
		</span><br>
		<div class="home-title">
			<h1>Zerren bila zabiltza?</h1>
		</div>
		<div class="home">
			<form id="filtroak" name="filtroak">
				<fieldset>
					<legend>
						<h2>Filtroak gehitu</h2>
					</legend>
					<label for="category">Kategoria:</label>
					<select id="category" name="category">
						<option value="">Guztiak</option>
						<option value="Ibilgailuak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Ibilgailuak') echo 'selected'; ?>>
							Ibilgailuak</option>
						<option value="Eraikuntzak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Eraikuntzak') echo 'selected'; ?>>
							Eraikuntzak</option>
						<option value="Lana"
							<?php if(isset($_GET['category']) && $_GET['category']=='Lana') echo 'selected'; ?>>
							Lana</option>
						<option value="Heziketa"
							<?php if(isset($_GET['category']) && $_GET['category']=='Heziketa') echo 'selected'; ?>>
							Heziketa</option>
						<option value="Zerbitzuak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Zerbitzuak') echo 'selected'; ?>>
							Zerbitzuak</option>
						<option value="Negozioak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Negozioak') echo 'selected'; ?>>
							Negozioak</option>
						<option value="Informatika"
							<?php if(isset($_GET['category']) && $_GET['category']=='Informatika') echo 'selected'; ?>>
							Informatika</option>
						<option value="Ikus-entzunezkoak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Ikus-entzunezkoak') echo 'selected'; ?>>
							Ikus-entzunezkoak</option>
						<option value="Telefonia"
							<?php if(isset($_GET['category']) && $_GET['category']=='Telefonia') echo 'selected'; ?>>
							Telefonia</option>
						<option value="Jokoak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Jokoak') echo 'selected'; ?>>
							Jokoak</option>
						<option value="Etxetresnak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Etxetresnak') echo 'selected'; ?>>
							Etxetresnak</option>
						<option value="Moda"
							<?php if(isset($_GET['category']) && $_GET['category']=='Moda') echo 'selected'; ?>>
							Moda</option>
						<option value="Umeak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Umeak') echo 'selected'; ?>>
							Umeak</option>
						<option value="Zaletasunak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Zaletasunak') echo 'selected'; ?>>
							Zaletasunak</option>
						<option value="Kirolak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Kirolak') echo 'selected'; ?>>
							Kirolak</option>
						<option value="Maskotak"
							<?php if(isset($_GET['category']) && $_GET['category']=='Maskotak') echo 'selected'; ?>>
							Maskotak</option>
					</select>
					<br><br>
					<label for="min_price">Prezio minimoa:</label>
					<input type="number" id="min_price" name="min_price" min="0"
						value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : '' ?>">
					<br><br>
					<label for="max_price">Prezio maximoa:</label>
					<input type="number" id="max_price" name="max_price" min="0"
						value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : '' ?>">
					<br><br>
					<label for="city">Hiria:</label>
					<input type="text" id="city" name="city"
						value="<?php echo isset($_GET['city']) ? $_GET['city'] : '' ?>">
					<br><br>
					<label for="order">Ordenatu:</label>
					<select id="order" name="order">
						<option value="Berrienak"
							<?php if(isset($_GET['order']) && $_GET['order']=='Berrienak') echo 'selected'; ?>>
							Berrienak</option>
						<option value="Zaharrenak"
							<?php if(isset($_GET['order']) && $_GET['order']=='Zaharrenak') echo 'selected="true"'; ?>>
							Zaharrenak</option>
						<option value="Merkeenak"
							<?php if(isset($_GET['order']) && $_GET['order']=='Merkeenak') echo 'selected'; ?>>
							Merkeenak</option>
						<option value="Garestienak"
							<?php if(isset($_GET['order']) && $_GET['order']=='Garestienak') echo 'selected'; ?>>
							Garestienak</option>
					</select>
					<br><br>
					<label for="text">Testua:</label>
					<input type="text" id="text" name="text" maxlength="100"
						value="<?php echo isset($_GET['text']) ? $_GET['text'] : '' ?>">
					<input type="submit" id="submit" value="Filtroak gehitu">
					<input type="reset" value="Berrezarri">
				</fieldset>
			</form>
			<?php include '../php/ShowAdvertisementsFilter.php'; ?>
		</div>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>