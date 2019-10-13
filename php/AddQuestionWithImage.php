<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
</head>

<body>
    <?php include '../php/Menus.php'?>
    <section class="main" id="s1">
        <div>
            <?php include '../php/DbConfig.php'?>
            <?php
            $esteka = mysqli_connect ($zerbitzaria, $erabiltzailea, $gakoa, $db);
			if (!$esteka) {
				exit;
            }
            
            if ($_FILES['argazkia']['size'] != 0) {
                $direktorioa = '../images/';
                $argazkia = $direktorioa.basename($_FILES['argazkia']['name']);

                if (file_exists($argazkia)) {
                    $sql = "INSERT INTO questions VALUES (NULL, '$_POST[eposta]', '$_POST[galdera]' , '$_POST[erantzun_zuzena]', 
                    '$_POST[erantzun_okerra1]', '$_POST[erantzun_okerra2]', '$_POST[erantzun_okerra3]', $_POST[zailtasuna], '$_POST[gaia]', '$argazkia')";
                } else if (move_uploaded_file($_FILES['argazkia']['tmp_name'], $argazkia)) {
                    $sql = "INSERT INTO questions VALUES (NULL, '$_POST[eposta]', '$_POST[galdera]' , '$_POST[erantzun_zuzena]', 
                    '$_POST[erantzun_okerra1]', '$_POST[erantzun_okerra2]', '$_POST[erantzun_okerra3]', $_POST[zailtasuna], '$_POST[gaia]', '$argazkia')";
                } else {
                    echo "Arazoren bat egon da argazkiarekin";
                }
            } else {
                $sql = "INSERT INTO questions VALUES (NULL, '$_POST[eposta]', '$_POST[galdera]' , '$_POST[erantzun_zuzena]', 
                '$_POST[erantzun_okerra1]', '$_POST[erantzun_okerra2]', '$_POST[erantzun_okerra3]', $_POST[zailtasuna], '$_POST[gaia]', NULL)";
            }
			
            $emaitza = mysqli_query($esteka, $sql);
            
			if (!$emaitza) {
				echo "<p>Galdera ez da ondo gorde: ".mysqli_error($esteka).PHP_EOL."</p>";
			} else {
                echo "<p>Galdera ondo gorde da</p>";
            }

            echo "<p><a href='QuestionFormWithImage.php'>Galdera berri bat gehitu</a></p>";
            echo "<p><a href='ShowQuestions.php'>Argazkirik gabeko galderak ikusi</a></p>";
            echo "<p><a href='ShowQuestionsWithImage.php'>Argazkidun galderak ikusi</a></p>";

			mysqli_close($esteka);
			?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>