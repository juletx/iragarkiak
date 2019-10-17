<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
    <script src="../js/ShowImageInForm.js"></script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div id="form">
            <form id="galderenF" name="galderenF" action="AddQuestionWithImage.php" method="post" enctype="multipart/form-data">
                <label for="eposta">Ehuko eposta(*):</label>
                <input type="email" id="eposta" name="eposta"
                    pattern="([a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s)|([a-z]+\.?[a-z]{2,}@ehu.eu?s)" required>
                <br><br>
                <label>Erabiltzaile mota(*):
                    <input type="radio" id="irakaslea" name="erabiltzaile_mota" value="1">
                    <label for="irakaslea">Irakaslea</label>
                    <input type="radio" id="ikaslea" name="zailtasuna" value="2" checked>
                    <label for="ikaslea">Ikaslea</label>
                <br><br>
                <label for="deitura">Izena eta abizenak(*):</label>
                <input type="text" id="deitura" name="deitura" pattern="[A-Z|a-z]+( [A-Z|a-z]+)+" required>
                <br><br>
                <label for="pasahitza">Pasahitza(*):</label>
                <input type="password" id="pasahitza" name="pasahitza" required>
                <br><br>
                <label for="pasahitza2">Pasahitza errepikatu(*):</label>
                <input type="password" id="pasahitza2" name="pasahitza2" required>
                <br><br>
                <label for="argazki">Argazkia:</label>
                <img id="argazki" alt="Aukeratu galderarekin zerikusia duen argazkia" height="100" src="#" />
                <br><br>
                <input type="file" id="argazkia" name="argazkia" accept="image/*" onchange="showImage(this)">
                <br><br>
                <input type="submit" value="Erregistratu">
                <input type="reset" value="Berrezarri" onclick="hideImage()">
            </form>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>