<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div id="form">
            <form id="galderenF" name="galderenF" action="#" method="post">
                <fieldset>
                    <legend><h2>Login</h2></legend>
                    <label for="eposta">Ehuko eposta(*):</label>
                    <input type="email" id="eposta" name="eposta"
                        pattern="([a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s)|([a-z]+\.?[a-z]{2,}@ehu.eu?s)" required>
                    <br><br>
                    <label for="pasahitza">Pasahitza(*):</label>
                    <input type="password" id="pasahitza" name="pasahitza" required>
                    <br><br>
                    <input type="submit" value="Saioa hasi">
                    <input type="reset" value="Berrezarri">
                </fieldset>
            </form>

            <?php
                if (isset($_POST["eposta"])) {
                    include '../php/DbConfig.php';
                    $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
                    if (!$esteka) {
                        exit;
                    }

                    $eposta = $_POST['eposta'];
                    $pasahitza = $_POST['pasahitza'];
                
                    $sql = "SELECT eposta FROM users WHERE eposta='$eposta' AND pasahitza='$pasahitza'";
                    $emaitza = mysqli_query($esteka, $sql);

                    if (!$emaitza) {
                        echo "Errorea datu basearen kontsultan".PHP_EOL;
                    } else {
                        $lerroKopurua = mysqli_num_rows($emaitza);
                        if ($lerroKopurua == 0) {
                            echo "<script>alert('Erabiltzaile edo pasahitz okerra')</script>".PHP_EOL;
                        } else {
                            echo "<script>alert('Ongi etorri ".$eposta."'); window.location.href = '../php/Layout.php?eposta=".$eposta."'</script>".PHP_EOL;
                        }
                    }

                    mysqli_free_result($emaitza);
                    mysqli_close($esteka);
                }
            ?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>