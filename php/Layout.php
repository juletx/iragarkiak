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
			<h3>Ongi etorri 100 Iragarki-ra</h3>
            <h4>Zure erakusleiho digitala</h4>
		</span><br>
		<div class="home-title">
			<h1>Zer bilatu nahi duzu duzu?</h1>
		</div>
		<div class="home">
			<form id="filtroak" name="filtroak">
				<fieldset>
					<legend>
						<h2>Filtroa gehitu</h2>
					</legend>
					<label for="category">Kategoria:</label>
					<select id="category" name="category">
						<option value="">Guztiak</option>
						<?php
							isset($_GET['category']) ? $category = $_GET['category'] : $category = "";
						?>
						<option value="Ibilgailuak" <?php if($category=='Ibilgailuak') echo 'selected'; ?>>
							Ibilgailuak</option>
						<option value="Eraikuntzak" <?php if($category=='Eraikuntzak') echo 'selected'; ?>>
							Eraikuntzak</option>
						<option value="Lana" <?php if($category=='Lana') echo 'selected'; ?>>
							Lana</option>
						<option value="Heziketa" <?php if($category=='Heziketa') echo 'selected'; ?>>
							Heziketa</option>
						<option value="Zerbitzuak" <?php if($category=='Zerbitzuak') echo 'selected'; ?>>
							Zerbitzuak</option>
						<option value="Negozioak" <?php if($category=='Negozioak') echo 'selected'; ?>>
							Negozioak</option>
						<option value="Informatika" <?php if($category=='Informatika') echo 'selected'; ?>>
							Informatika</option>
						<option value="Ikus-entzunezkoak" <?php if($category=='Ikus-entzunezkoak') echo 'selected'; ?>>
							Ikus-entzunezkoak</option>
						<option value="Telefonia" <?php if($category=='Telefonia') echo 'selected'; ?>>
							Telefonia</option>
						<option value="Jokoak" <?php if($category=='Jokoak') echo 'selected'; ?>>
							Jokoak</option>
						<option value="Etxetresnak" <?php if($category=='Etxetresnak') echo 'selected'; ?>>
							Etxetresnak</option>
						<option value="Moda" <?php if($category=='Moda') echo 'selected'; ?>>
							Moda</option>
						<option value="Umeak" <?php if($category=='Umeak') echo 'selected'; ?>>
							Umeak</option>
						<option value="Zaletasunak" <?php if($category=='Zaletasunak') echo 'selected'; ?>>
							Zaletasunak</option>
						<option value="Kirolak" <?php if($category=='Kirolak') echo 'selected'; ?>>
							Kirolak</option>
						<option value="Maskotak" <?php if($category=='Maskotak') echo 'selected'; ?>>
							Maskotak</option>
					</select>
					<br>
					<label for="min_price">Prezio minimoa:</label>
                    <input type="number" id="min_price" name="min_price" min="0"
						value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : '' ?>">
                        &nbsp;&nbsp;&nbsp;
					<label for="max_price">Prezio maximoa:</label><input type="number" id="max_price" name="max_price" min="0"
						value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : '' ?>">
					<br>
					<label for="city">Hiria:</label>
					<input type="text" id="city" name="city"
						value="<?php echo isset($_GET['city']) ? $_GET['city'] : '' ?>">
					<br>
					<label for="text">Testua:</label>
					<input type="text" id="text" name="text" maxlength="100"
						value="<?php echo isset($_GET['text']) ? $_GET['text'] : '' ?>">
                    <br>
                    <br>
                    <label for="order">Ordenatu:</label>
					<select id="order" name="order">
						<option value="Berrienak">Berrienak</option>
						<?php
							isset($_GET['order']) ? $order = $_GET['order'] : $order = "Berrienak";
						?>
						<option value="Zaharrenak" <?php if($order=='Zaharrenak') echo 'selected'; ?>>
							Zaharrenak</option>
						<option value="Merkeenak" <?php if($order=='Merkeenak') echo 'selected'; ?>>
							Merkeenak</option>
						<option value="Garestienak" <?php if($order=='Garestienak') echo 'selected'; ?>>
							Garestienak</option>
					</select>
					<br><br>
                    <input class="btn btn-success" type="submit" id="submit" value="Filtroa gehitu">
					<a class="btn btn-danger" href="Layout.php">Berrezarri</a>
				</fieldset>
			</form>
			<br>
			<?php include '../php/ShowAdvertisementsFilter.php'; ?>
		</div>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>
