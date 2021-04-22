<?php
session_start();
error_reporting(1);
?>
<!Doctype html> <!-- Definition des doctype-Modus -->
<html> <!-- Definition des Stammverzeichnises -->
    <head> <!-- Definition des Kopfbereiches -->
        <meta charset="utf-8"> <!-- charset[utf-8:]  definiert den deutschen Zeichensatz -->
        <title>Bewerbungen_Stadt anzeigen</title> <!-- weist dem HTML-Dokument in der Registerkarte einen Namen zu -->
        <script src="js/menus.js"></script>
        <script src="js/jquery-1.7.1.min.js"></script>
        <script src="js/jquery-ui-1.8.17.custom.min.js"></script>
        <link rel="stylesheet" href="css/style_0.css" rel="stylesheet">
        <link rel="stylesheet" href="css/jquery-ui-1.8.17.custom.css">
    </head>
    <body> <!-- Definition des Bodybereiches -->
        <ul>
            <li><a href="index.php">Logout</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_0()">Bewerbungen suchen</a>
                <div class="dropdown-inhalt_0" id="auswahl_0">
                    <a href="show_all.php">alle Bewerbungen anzeigen</a>
                    <a href="show_open.php">offene Bewerbungen anzeigen </a>
                    <a href="show_done.php">erledigte Bewerbungen anzeigen </a>
                    <a href="show_date.php">Bewerbungen nach Datum suchen</a>
                    <a href="#b5">Bewerbungen nach Ort suchen</a>
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
        <script>
            $(document).ready(function () {
                var cities = ['Aachen', 'Augsburg',
                    'Bückeburg', 'Bergisch Gladbach', 'Berlin', 'Bielefeld', 'Bochum', 'Bonn', 'Botrop', 'Braunschweig', 'Bremen', 'Bremerhaven', 'Böblingen',
                    'Chemnitz', 'Cottbus',
                    'Darmstadt', 'Dortmund', 'Dresden', 'Duisburg', 'Düsseldorf',
                    'Erfurt', 'Erlangen', 'Essen',
                    'Frankfurt(Main)', 'Frankfurt(Oder)', 'Freiburg', 'Fürth',
                    'Gelsenkirchen', 'Göttingen',
                    'Hannover', 'Hagen', 'Halle', 'Hamburg', 'Hamm', 'Heidelberg', 'Heibronn', 'Herne', 'Hildesheim', 'Heibronn',
                    'Ingolstadt',
                    'Jena',
                    'Karlsruhe', 'Kassel', 'Kiel', 'Koblenz', 'Köln', 'Krefeld',
                    'Laatzen', 'Leipzig', 'Lehrte', 'Leverkusen', 'Lübeck', 'Ludwigshafen',
                    'München', 'Magdeburg', 'Mainz', 'Mannheim', 'Moers', 'Mönchen Gladbach', 'Mühlheim', 'Münster',
                    'Neuss', 'Nürnberg', 'Neustadt',
                    'Oberhausen', 'Offenbach', 'Oldenburg', 'Osnarbrück',
                    'Paderborn', 'Potsdam', 'Pforzheim',
                    'Recklinghausen', 'Regensburg', 'Remscheid', 'Reutlingen', 'Rostock',
                    'Sindelfingen', 'Saarbrücken', 'Salzgitter', 'Siegen', 'Solingen', 'Stuttgart',
                    'Tübingen', 'Trier',
                    'Ulm',
                    'Würzburg', 'Wiesbaden', 'Wolfsburg', 'Wuppertal',
                    'Xanten',
                    'Yokohama',
                    'Zuffenhausen'];
                $('#location').autocomplete({
                    source: cities
                });
            });
        </script>
    <center><h1>Show records specified by place</h1></center><br>
    <p><i>Hier können Sie sich durch das Betätigen des Buttons alle Bewerbungen bzgl. spezifisierter Städte anzeigen lassen. Dafür genügt der Anfangsbuchstabe/die Anfangsbuchstaben der Stadt<p></i>
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
        <div id="box1" class="box1">
            <input class="button1" type="submit" name="search_reset" value="Reset">
            <label name="ort">Suche bereinigen</label></div><br><br>
        <center>
            <input class="feld" type=text name="anfang0" id="location" placeholder="hier die Stadt eintragen">
            <input class="button" type="submit" name="search0" value="Suchen"><br><br>
        </center>
    </form>
    <?php
    $sql = "    SELECT bew_id,datum,firma,art,stadt,plz,strasse_nr,ansprech_person,email,notiz AS feedback,bemerkung FROM bewerbungen 
                LEFT JOIN rechtsform ON bewerbungen.rechtsart=rechtsform.id_recht
                LEFT JOIN nachricht ON bewerbungen.feedback=nachricht.id_message where stadt like '" . $_POST["anfang0"] . "%' 
                ORDER BY datum DESC";
    $sql1 = "SELECT COUNT(bew_id) as anzahl FROM bewerbungen where stadt like '" . $_POST["anfang0"] . "%'";
    if (empty($_REQUEST['anfang0']))
        echo"<p>Bitte einen Ort auswählen!</p>";
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