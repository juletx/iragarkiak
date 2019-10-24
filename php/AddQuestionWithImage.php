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
            if (isset($_POST['eposta'], $_POST['galdera'], $_POST['erantzun_zuzena'], $_POST['erantzun_okerra1'], $_POST['erantzun_okerra2'], $_POST['erantzun_okerra3'], 
            $_POST['zailtasuna'], $_POST['gaia']) && $_POST['eposta'] != "" && $_POST['galdera'] != "" && $_POST['erantzun_zuzena'] != "" && $_POST['erantzun_okerra1'] != "" &&
            $_POST['erantzun_okerra2'] != "" && $_POST['erantzun_okerra3'] != "" && $_POST['zailtasuna'] != "" && $_POST['gaia'] != "") {
                if (preg_match('/[a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s/', $_POST['eposta']) || preg_match('/[a-z]+\.?[a-z]{2,}@ehu.eu?s/', $_POST['eposta'])) {
                    $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
                    if (!$esteka) {
                        exit;
                    }

                    $sql = "INSERT INTO questions VALUES (NULL, '$_POST[eposta]', '$_POST[galdera]' , '$_POST[erantzun_zuzena]', 
                    '$_POST[erantzun_okerra1]', '$_POST[erantzun_okerra2]', '$_POST[erantzun_okerra3]', $_POST[zailtasuna], '$_POST[gaia]', NULL)";
                    
                    if ($_FILES['argazkia']['size'] != 0) {
                        $direktorioa = '../images/';
                        $argazkia = $direktorioa.basename($_FILES['argazkia']['name']);

                        if (file_exists($argazkia) || move_uploaded_file($_FILES['argazkia']['tmp_name'], $argazkia)) {
                            $sql = "INSERT INTO questions VALUES (NULL, '$_POST[eposta]', '$_POST[galdera]' , '$_POST[erantzun_zuzena]', 
                            '$_POST[erantzun_okerra1]', '$_POST[erantzun_okerra2]', '$_POST[erantzun_okerra3]', $_POST[zailtasuna], '$_POST[gaia]', '$argazkia')";
                        }
                    }else{
                        $direktorioa = '../images/';
                        $argazkia = $direktorioa.basename('Galdera.png');
                        if (file_exists($argazkia)) {
                            $sql = "INSERT INTO questions VALUES (NULL, '$_POST[eposta]', '$_POST[galdera]' , '$_POST[erantzun_zuzena]', 
                            '$_POST[erantzun_okerra1]', '$_POST[erantzun_okerra2]', '$_POST[erantzun_okerra3]', $_POST[zailtasuna], '$_POST[gaia]', '$argazkia')";
                        }
                    }
                    
                    $emaitza = mysqli_query($esteka, $sql);
                    
                    if (!$emaitza) {
                        echo "<p>Galdera ez da ondo gorde: ".mysqli_error($esteka).PHP_EOL."</p>";
                    } else {
                        echo "<p>Galdera ondo gorde da</p>";
                    }

                    echo "<p><a href='QuestionFormWithImage.php?eposta=".$_GET['eposta']."'>Galdera berri bat gehitu</a></p>";
                    echo "<p><a href='ShowQuestionsWithImage.php?eposta=".$_GET['eposta']."'>Galderak ikusi</a></p>";

                    mysqli_close($esteka);    
                }
            }
			?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>