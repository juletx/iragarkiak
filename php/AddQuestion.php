<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div>
            <?php include '../php/DbConfig.php'?>
            <?php
            $esteka = mysqli_connect ($zerbitzaria, $erabiltzailea, $gakoa, $db);
			if (!$esteka) {
				exit;
			}

			$sql = "INSERT INTO questions VALUES (NULL, '$_GET[eposta]', '$_GET[galdera]' , '$_GET[erantzun_zuzena]', 
            '$_GET[erantzun_okerra1]', '$_GET[erantzun_okerra2]', '$_GET[erantzun_okerra3]', $_GET[zailtasuna], '$_GET[gaia]')";
            $emaitza = mysqli_query($esteka, $sql);
            
			if (!$emaitza) {
				echo "<p>Galdera ez da ondo gorde: ".mysqli_error($esteka).PHP_EOL."</p>";
			} else {
                echo "<p>Galdera ondo gorde da</p>";
            }

            echo "<p><a href='QuestionForm.php'>Galdera berri bat gehitu</a></p>";
            echo "<p><a href='ShowQuestions.php'>Irudirik gabeko galderak ikusi</a></p>";

			mysqli_close($esteka);
			?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>