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
            
            //errorea: argazkirik ez bada aukeratzen ere baldintza betetzen da
            //datubasean ../images/ gordetzen da kasu horretan
            if (isset ($_FILES['argazkia'])) {
                $direktorioa = '../images/';
                $argazkia = $direktorioa . basename($_FILES['argazkia']['name']);

                if (file_exists($argazkia)) {
                    echo "Sorry, file already exists.";
                    $sql = "INSERT INTO questions VALUES (NULL, '$_POST[eposta]', '$_POST[galdera]' , '$_POST[erantzun_zuzena]', 
                    '$_POST[erantzun_okerra1]', '$_POST[erantzun_okerra2]', '$_POST[erantzun_okerra3]', $_POST[zailtasuna], '$_POST[gaia]', '$argazkia')";
                } else {
                    if (move_uploaded_file($_FILES['argazkia']['tmp_name'], $argazkia)) {
                        echo "File is valid, and was successfully uploaded.\n";
                        $sql = "INSERT INTO questions VALUES (NULL, '$_POST[eposta]', '$_POST[galdera]' , '$_POST[erantzun_zuzena]', 
                        '$_POST[erantzun_okerra1]', '$_POST[erantzun_okerra2]', '$_POST[erantzun_okerra3]', $_POST[zailtasuna], '$_POST[gaia]', '$argazkia')";
                    } else {
                        echo "Possible file upload attack!\n";
                    }

                    echo 'Here is some more debugging info: ';
                    print_r($_FILES);
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
            echo "<p><a href='ShowQuestions.php'>Irudirik gabeko galderak ikusi</a></p>";
            echo "<p><a href='ShowQuestionsWithImage.php'>Irudidun galderak ikusi</a></p>";

			mysqli_close($esteka);
			?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>