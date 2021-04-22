<?php
session_start();
?>
<!Doctype html> <!-- Definition des doctype-Modus -->
<html> <!-- Definition des Stammverzeichnises -->
    <head> <!-- Definition des Kopfbereiches -->
        <meta charset="utf-8"> <!-- charset[utf-8:]  definiert den deutschen Zeichensatz -->
        <title>erledigte Bewerbungen anzeigen</title> <!-- weist dem HTML-Dokument in der Registerkarte einen Namen zu -->
        <script src="js/menus.js"></script>  <!-- hier ggf. JS als Datei einfügen direkt einfügen -->
        <link href="css/style_0.css" rel="stylesheet">

        <style></style>
    </head>
    <body> <!-- Definition des Bodybereiches -->
        <ul>
            <li><a href="index.php">Logout</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_0()">Bewerbungen suchen</a>
                <div class="dropdown-inhalt_0" id="auswahl_0">
                    <a href="show_all.php">alle Bewerbungen anzeigen</a>
                    <a href="show_open.php">offene Bewerbungen anzeigen </a>
                    <a href="#b3">erledigte Bewerbungen anzeigen </a>
                    <a href="show_date.php">Bewerbungen nach Datum suchen</a>
                    <a href="show_place.php">Bewerbungen nach Ort suchen</a>
                    <a href="show_company.php">Bewerbungen nach Firma suchen</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_1()">Adminbereich</a>
                <div class="dropdown-inhalt_0" id="auswahl_1">
                    <a href="einfuegen_extract.php">Bewerbungen eingeben</a>
                    <a href="delete_records.php">Bewerbungen löschen</a>
                    <a href="stelle_suchen.php">Stelle suchen</a>
                    <!--  <a href="#R3">Bewerbungen editieren</a>  -->
                </div>
            </li>
        </ul>
    <center><h1>Show records discharged </h1></center><br>
    <p><i>Hier können Sie sich durch das Betätigen des Buttons alle erledigten Bewerbungen,d.h. also jene, die bereits einer Absage unterzogen wurden, oder aber die in ein Vorstellungsgespräch mündeten,anzeigen lassen!<p></i>
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
        <center><input class="button" type="submit" name="search0" value="Suchen"></center>
    </form>
    <?php
    $sql = "SELECT bew_id,datum,firma,art,stadt,plz,strasse_nr,ansprech_person,email,notiz AS feedback,bemerkung FROM bewerbungen JOIN rechtsform ON bewerbungen.rechtsart=rechtsform.id_recht\n"
            . " JOIN nachricht ON bewerbungen.feedback=nachricht.id_message where feedback=1 order by datum DESC";
    $sql1 = "SELECT COUNT(bew_id) as anzahl FROM bewerbungen where feedback=1";
    include_once 'inc/anzeigen.php';

    $arrayForLink = explode("\\", __FILE__);
    //unter LINUX ist das Array leer
    if (!count($arrayForLink) > 0)
        $arrayForLink = explode("/", __FILE__);
    $_SESSION["GoBack"] = __FILE__;
    $_SESSION["GoBack"] = $arrayForLink[count($arrayForLink) - 1];
    ?>
</body>
</html>