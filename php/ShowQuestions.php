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
            
            $sql = "SELECT * FROM questions";
            $emaitza = mysqli_query($esteka, $sql);

            echo '<table border=1> <tr> <th> ID </th> <th> EPOSTA </th> 
            <th> GALDERA </th> <th> ZUZENA </th> 
            <th colspan="3"> OKERRAK </th> <th> ZAILTASUNA </th> 
            <th> GAIA </th> </tr>';

            while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
                echo '<tr> <td>'.$row['id'].'</td> <td>'.$row['eposta'].
                '</td> <td>'.$row['galdera'].'</td> <td>'.$row['erantzun_zuzena'].
                '</td> <td>'.$row['erantzun_okerra1'].'</td> <td>'.$row['erantzun_okerra2'].
                '</td> <td>'.$row['erantzun_okerra3'].'</td> <td>'.zailtasuna($row['zailtasuna']).
                '</td> <td>'.$row['gaia'].'</td> </tr>';
            }

            echo '</table>';

            function zailtasuna($zailtasuna) {
                switch($zailtasuna) {
                case 1:
                    return "Txikia";
                case 2:
                    return "Ertaina";
                case 3:
                    return "Handia";
                }
            }

            mysqli_free_result($emaitza);
            mysqli_close($esteka);
            ?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>