<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<script src="../js/ShowImageInForm.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div id="form">
			<form id="galderenF" name="galderenF" action="#" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>
						<h2>Erregistratu</h2>
					</legend>
					<label for="eposta">Ehuko eposta(*):</label>
					<input type="email" id="eposta" name="eposta"
						pattern="([a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s)|([a-z]+\.?[a-z]{2,}@ehu.eu?s)" required>
					<br><br>
					<label>Erabiltzaile mota(*):
						<input type="radio" id="irakaslea" name="mota" value="irakaslea">
						<label for="irakaslea">Irakaslea</label>
						<input type="radio" id="ikaslea" name="mota" value="ikaslea" checked>
						<label for="ikaslea">Ikaslea</label>
					</label>
					<br><br>
					<label for="deiturak">Izena eta abizenak(*):</label>
					<input type="text" id="deiturak" name="deiturak" pattern="[A-Za-z]{2,}( [A-Za-z]{2,})+" required>
					<br><br>
					<label for="pasahitza">Pasahitza(*):</label>
					<input type="password" id="pasahitza" name="pasahitza" required>
					<br><br>
					<label for="pasahitza2">Pasahitza errepikatu(*):</label>
					<input type="password" id="pasahitza2" name="pasahitza2" required>
					<br><br>
					<label for="argazki">Argazkia:</label>
					<img id="argazki" alt="Aukeratu argazkia" class="argazkia" src="#" />
					<br><br>
					<input type="file" id="argazkiaa" name="argazkia" accept="image/*">
					<br><br>
					<input type="submit" value="Erregistratu">
					<input type="reset" value="Berrezarri">
				</fieldset>
			</form>

			<?php
                if (isset($_POST["eposta"])) {
					$pasahitza = trim($_POST["pasahitza"]);
					$pasahitza2 = trim($_POST["pasahitza2"]);
                    if (strlen($pasahitza) >= 6 && $pasahitza == $pasahitza2) {
                        addUser();
                    } else {
                        echo "<script>alert('Pasahitzek ez dute 6ko luzera edo ez dira berdinak'); history.go(-1);</script>";
                    }
                }

                function addUser() {
                    include '../php/DbConfig.php';
                    $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
					
					$direktorioa = '../images/';
                    $argazkia = $direktorioa.'Anonimoa.png';
                
                    if ($_FILES['argazkia']['size'] != 0) {
                        $argazkia = $direktorioa.basename($_FILES['argazkia']['name']);
						
                        if (!file_exists($argazkia)) {
							move_uploaded_file($_FILES['argazkia']['tmp_name'], $argazkia);
                        }
                    }

					$sql = "INSERT INTO users VALUES ('$_POST[eposta]', '$_POST[mota]', '$_POST[deiturak]', 
                        '$pasahitza', '$argazkia')";

					$emaitza = mysqli_query($esteka, $sql);
			
					mysqli_close($esteka);
                
                    if (!$emaitza) {
                        echo "<script>alert('Erabiltzailea ez da ondo gorde datu-basean'); history.go(-1);</script>";
                    } else {
                        echo "<script>alert('Erabiltzailea ondo gorde da datu-basean'); window.location.href = '../php/Layout.php'</script>".PHP_EOL;
                    }
                }
            ?>
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>