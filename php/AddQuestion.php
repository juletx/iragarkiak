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
            $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

			$sql = "INSERT INTO questions VALUES (NULL, '$_GET[eposta]', '$_GET[galdera]' , '$_GET[erantzuna]', 
            '$_GET[okerra1]', '$_GET[okerra2]', '$_GET[okerra3]', $_GET[zailtasuna], '$_GET[gaia]')";
            $emaitza = mysqli_query($esteka, $sql);
            
			if (!$emaitza) {
				echo "<p>Galdera ez da ondo gorde</p>";
			} else {
                echo "<p>Galdera ondo gorde da</p>";
            }

            echo "<p><a href='QuestionForm.php?eposta=".$_GET['eposta']."'>Galdera berri bat gehitu</a></p>";
            echo "<p><a href='ShowQuestions.php?eposta=".$_GET['eposta']."'>Galderak ikusi</a></p>";

			mysqli_close($esteka);
			?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>