<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="loggedOut"><a href="SignUp.php">Erregistratu</a></span>
        <span class="loggedOut"><a href="LogIn.php">Login</a></span>
        <span class="loggedIn"><a href="<?php echo (isset($_GET['eposta'])) ? 'LogOut.php?eposta='.$_GET['eposta'] : 'LogOut.php'?>">Logout</a></span>
    </header>
    <nav class='main' id='n1' role='navigation'>
        <span><a href="<?php echo (isset($_GET['eposta'])) ? 'Layout.php?eposta='.$_GET['eposta'] : 'Layout.php'?>">Hasiera</a></span>
        <span class="loggedIn"><a href="<?php echo (isset($_GET['eposta'])) ? 'QuestionFormWithImage.php?eposta='.$_GET['eposta'] : 'QuestionFormWithImage.php'?>">Galdera gehitu</a></span>
        <span class="loggedIn"><a href="<?php echo (isset($_GET['eposta'])) ? 'ShowQuestions.php?eposta='.$_GET['eposta'] : 'ShowQuestions.php'?>">Argazkirik gabeko galderak ikusi</a></span>
        <span class="loggedIn"><a href="<?php echo (isset($_GET['eposta'])) ? 'ShowQuestionsWithImage.php?eposta='.$_GET['eposta'] : 'ShowQuestionsWithImage.php'?>">Argazkidun galderak ikusi</a></span>
        <span><a href="<?php echo (isset($_GET['eposta'])) ? 'Credits.php?eposta='.$_GET['eposta'] : 'Credits.php'?>">Kredituak</a></span>
    </nav>

    <?php
        if (isset($_GET["eposta"])) {
            echo "<script>$('.loggedOut').hide()</script>";

            include '../php/DbConfig.php';
            $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
            if (!$esteka) {
                exit;
            }

            $eposta = $_GET['eposta'];
                
            $sql = "SELECT argazkia FROM users WHERE eposta='$eposta'";
            $emaitza = mysqli_query($esteka, $sql);

        } else {
            echo "<script>$('.loggedIn').hide()</script>";
        }
    ?>