<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
    <script src="../js/ValidateFieldsQuestion.js"></script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div id="form">
            <form id="galderenF" name="galderenF" action="<?php echo 'AddQuestion.php?eposta='.$_GET['eposta']?>"
                onsubmit="return validateFields()">
                <label for="eposta">Ehuko eposta(*):</label>
                <input type="text" id="eposta" name="eposta" value="<?php echo $_GET['eposta']?>" readonly>
                <br><br>
                <label for="galdera">Galdera(*):</label>
                <input type="text" id="galdera" name="galdera">
                <br><br>
                <label for="erantzun_zuzena">Erantzun zuzena(*):</label>
                <input type="text" id="erantzun_zuzena" name="erantzun_zuzena">
                <br><br>
                <label for="erantzun_okerra1">Erantzun okerra 1(*):</label>
                <input type="text" id="erantzun_okerra1" name="erantzun_okerra1">
                <br><br>
                <label for="erantzun_okerra2">Erantzun okerra 2(*):</label>
                <input type="text" id="erantzun_okerra2" name="erantzun_okerra2">
                <br><br>
                <label for="erantzun_okerra3">Erantzun okerra 3(*):</label>
                <input type="text" id="erantzun_okerra3" name="erantzun_okerra3">
                <br><br>
                <label>Zailtasuna(*):
                    <input type="radio" id="txikia" name="zailtasuna" value="1">
                    <label for="txikia">Txikia</label>
                    <input type="radio" id="ertaina" name="zailtasuna" value="2" checked>
                    <label for="ertaina">Ertaina</label>
                    <input type="radio" id="handia" name="zailtasuna" value="3">
                    <label for="handia">Handia</label></label>
                <br><br>
                <label for="gaia">Gaia(*):</label>
                <input type="text" id="gaia" name="gaia">
                <br><br>
                <input type="submit" value="Galdera gehitu">
                <input type="reset" value="Berrezarri">
            </form>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>