<?php
session_start();
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>alle Bewerbungen anzeigen</title>
        <script src="js/menus.js"></script>
        <link href="css/style_0.css" rel="stylesheet">
    </head>
    <body>
        <ul>
            <li><a href="index.php">Logout</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_0()">Bewerbungen suchen</a>
                <div class="dropdown-inhalt_0" id="auswahl_0">
                    <a href="#b1">alle Bewerbungen anzeigen</a>
                    <a href="show_open.php">offene Bewerbungen anzeigen </a>
                    <a href="show_done.php">erledigte Bewerbungen anzeigen </a>
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
                    <!--<a href="#R3">Bewerbungen editieren</a>  -->
                </div>
            </li>
        </ul>
    <center><h1>Show all records</h1></center><br>
    <p><i>Hier können Sie sich durch das Betätigen des Buttons alle Eintragungen in Ihrer Datenbank anzeigen lassen.<br>Eine gezieltere Suche kann über das Menu aufgerufen werden...</p></i><br><br>  
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
        <center><input class="button" type="submit" name="search0" value="Suchen"></center>
    </form>
    <?php
    $sql = "SELECT bew_id,datum,firma,art,stadt,plz,strasse_nr,ansprech_person,email,notiz AS feedback,bemerkung FROM bewerbungen JOIN rechtsform ON bewerbungen.rechtsart=rechtsform.id_recht
		JOIN nachricht ON bewerbungen.feedback=nachricht.id_message ORDER BY datum DESC";
    $sql1 = "SELECT COUNT(bew_id) AS anzahl FROM bewerbungen";
    include_once 'inc/anzeigen.php';
    $file = __FILE__;
    $arrayForLink = explode("\\", $file);
    //unter LINUX hat das Array nur einen Eintrag
    if (count($arrayForLink) == 1)
        $arrayForLink = explode("/", $file);
    $_SESSION["GoBack"] = $arrayForLink[count($arrayForLink) - 1];
    ?>
</body>
</html>