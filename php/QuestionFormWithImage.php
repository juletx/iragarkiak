<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ValidateFieldsQuestion.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div id="form">
            <form id="galderenF" name="galderenF" action="AddQuestion.php" onsubmit="return validateFields()">
                <label for="eposta">Ehuko eposta(*):</label>
                <input type="text" id="eposta" name="eposta">
                <br><br>
                <label for="galdera">Galdera(*):</label>
                <input type="text" id="galdera" name="galdera">
                <br><br>
                <label for="erantzun-zuzena">Erantzun zuzena(*):</label>
                <input type="text" id="erantzun_zuzena" name="erantzun_zuzena">
                <br><br>
                <label for="erantzun-okerra1">Erantzun okerra 1(*):</label>
                <input type="text" id="erantzun_okerra1" name="erantzun_okerra1">
                <br><br>
                <label for="erantzun-okerra2">Erantzun okerra 2(*):</label>
                <input type="text" id="erantzun_okerra2" name="erantzun_okerra2">
                <br><br>
                <label for="erantzun-okerra3">Erantzun okerra 3(*):</label>
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
                <label for="argazki">Argazkia:</label>
                <img id="argazki" alt="Aukeratu zure argazkia" height="100" src="#" />
                <br><br>
                <input type="file" id="argazkia" name="argazkia" accept="image/*" onchange="showImage(this)">
                <br><br>
                <input type="submit" value="Galdera gehitu">
                <input type="reset" value="Berrezarri" onclick="hideImage()">
            </form>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>