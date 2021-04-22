<?php
session_start();
error_reporting(1);
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bewerbungen/Firma</title>
        <script src="js/menus.js"></script>
        <link href="css/style_0.css" rel="stylesheet">
    </head>
    <body>
        <ul>
            <li><a href="index.php">Logout</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_0()">Bewerbungen suchen</a>
                <div class="dropdown-inhalt_0" id="auswahl_0">
                    <a href="show_all.php">alle Bewerbungen anzeigen</a>
                    <a href="show_all">offene Bewerbungen anzeigen </a>
                    <a href="show_done.php">erledigte Bewerbungen anzeigen </a>
                    <a href="show_date.php">Bewerbungen nach Datum suchen</a>
                    <a href="show_place.php">Bewerbungen nach Ort suchen</a>
                    <a href="#b6">Bewerbungen nach Firma suchen</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_1()">Adminbereich</a>
                <div class="dropdown-inhalt_0" id="auswahl_1">
                    <a href="einfuegen_extract.php">Bewerbungen eingeben</a>
                    <a href="delete_records.php">Bewerbungen löschen</a>
                    <a href="stelle_suchen.php">Stelle suchen</a>
                    <!--<a href="#R3">Bewerbungen editieren</a>  -->
                </div>
            </li>
        </ul>
    <center><h1>Show records specified by company</h1></center><br>
    <p><i>Hier können Sie sich durch das Betätigen des Buttons alle Bewerbungen bzgl. spezifisierter Firmen anzeigen lassen. Dafür genügt der Anfangsbuchstabe/die Anfangsbuchstaben der Firma<p></i>
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
        <div id="box1" class="box1">
            <input class="button1" type="submit" name="search_reset" value="Reset">
            <label name="ort">Suche bereinigen</label></div><br><br>
        <center>
            <input class="feld" type=text name="anfang0" id="anfang0" placeholder="hier die Firma eintragen">
            <input class="button" type="submit" name="search0" value="Suchen"><br><br>
        </center>
    </form>
    <?php
    $sql = "SELECT bew_id,datum,firma,art,stadt,plz,strasse_nr,ansprech_person,email,notiz AS feedback,bemerkung FROM bewerbungen JOIN rechtsform ON bewerbungen.rechtsart=rechtsform.id_recht
		JOIN nachricht ON bewerbungen.feedback=nachricht.id_message WHERE firma LIKE '" . $_POST["anfang0"] . "%' ORDER BY datum DESC";
    $sql1 = "SELECT COUNT(bew_id) AS anzahl FROM bewerbungen WHERE firma LIKE '" . $_POST["anfang0"] . "%'";
    if (empty($_REQUEST['anfang0']))
        echo"<p>Bitte eine Firma auswählen!</p>";
    else
        include_once'inc/anzeigen.php';

    $arrayForLink = explode("\\", __FILE__);
    //unter LINUX ist das Array leer
    if (!count($arrayForLink) > 0)
        $arrayForLink = explode("/", __FILE__);
    $_SESSION["GoBack"] = __FILE__;
    $_SESSION["GoBack"] = $arrayForLink[count($arrayForLink) - 1];
    ?>
</body>
</html>