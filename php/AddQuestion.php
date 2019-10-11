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
				echo "Hutsegitea DBra konetatzerakoan: (".
				mysqli_connect_errno() . ") " .
				mysqli_connect_error() .PHP_EOL;
				exit;
			}

			echo "Konexioa egin da:" . mysqli_get_host_info();

			$sql = "INSERT INTO Questions VALUES ('$_GET[eposta]' , '$_GET[galdera]' ,'$_GET[erantzun-zuzena]' ,'$_GET[erantzun-okerra1]' ,'$_GET[erantzun-okerra2]' ,'$_GET[erantzun-okerra3]' ,'$_GET[zailtasuna]' ,'$_GET[gaia]')"
			$emaitza = mysqli_query($esteka, $sql);
			if (!$emaitza) {
				die('Galdera ez da ondo gorde: '.mysqli_error($esteka));
				echo "<p> <a href='QuestionForm.php'> Saiatu berriz galdera gehitzen";
			}

			echo "Galdera ondo gorde da";
			echo "<p> <a href='QuestionForm.php'> Galdera berri bat gehitu";
			echo "<p> <a href='ShowQuestions.php'> Irudirik gabeko galderak ikusi</a>";

			mysqli_close($esteka);
			?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>