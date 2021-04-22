<?php
//error_reporting(1);
session_start();
error_reporting(1); // aktivieren,sobald das Skript ohne Fehler ist!
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Datensatz einfügen</title>
        <script src="js/menus.js"></script>
        <script src="js/datetime.js"></script>
        <script src="js/jquery-1.7.1.min.js"></script>
        <script src="js/jquery-ui-1.8.17.custom.min.js"></script>
        <link rel="stylesheet" href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="css/jquery-ui-1.8.17.custom.css">
    </head>
    <body>
        <div class="mainDiv">
            <div id="uhr" class="borderLeft"></div>
        </div>
        <ul>
            <li><a href="index.php">Logout</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_0()">Bewerbungen suchen</a>
                <div class="dropdown-inhalt_0" id="auswahl_0">
                    <a href="show_all.php">alle Bewerbungen anzeigen</a>
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
                    <a href="#">Bewerbungen eingeben</a>
                    <a href="delete_records.php">Bewerbungen löschen</a>
                    <a href="stelle_suchen.php">Stelle suchen</a>
                </div>
            </li>
        </ul>
        <script>
            $(document).ready(function () {
                $('#date').datepicker({
                    showOn: 'both',
                    buttonText: '',
                    buttonImage: 'calendar.png',
                    buttonImageOnly: true,
                    numberOfMonths: 1,
                    maxDate: '30d',
                    minDate: '-3m',
                    showButtonPanel: true,
                    dateFormat: 'yy-mm-dd'
                });
            });
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
        <?php
        include_once 'inc/verbinden.php';
        include_once 'inc/formular.php';
        FormularAnzeigen(true);
        if (empty($_REQUEST['datum']) || empty($_REQUEST['firma']) || empty($_REQUEST['recht']) || empty($_REQUEST['stadt']) || empty($_REQUEST['plz']) || empty($_REQUEST['mail']))
            $unausgefuellt = true;
        else
            $unausgefuellt = false;
        ?>
        <?php
        $sql1 = "SELECT * FROM rechtsform WHERE 1";
        $sql2 = "SELECT * FROM nachricht WHERE 1";
        ?>
        <div id="box1">
            <br><br><table border="3"><tr><td width="60" bgcolor=#A9F5A9>ID</td><td width="157" bgcolor=#F5F6CE>Rechtsart</td></tr></table>
            <?php
            $treffer1 = $dbh->query($sql1); // obejektorientierte Abfrage definieren
            $treffer2 = $dbh->query($sql2);
            foreach ($treffer1 as $daten) { //Datensätze in Tabellenform auslesen
                echo"<table border='1'>";
                echo "<tr><td width='60' bgcolor=#A9F5A9>" . $daten['id_recht'] . "</td><td width='160' bgcolor=#F5F6CE>" . $daten['art'] . "</td></tr></table>";
            }
            echo"<table border='3'>";
            echo"<br><tr><td width='60' bgcolor=#A9F5A9>ID</td><td width='157' bgcolor=#F5F6CE>feedback</td></tr></table>";
            foreach ($treffer2 as $daten) {   //Datensätze in Tabellenform auslesen
                echo"<table border='1'>";
                echo "<tr><td width='60' bgcolor=#A9F5A9>" . $daten['id_message'] . "</td><td width='160' bgcolor=#F5F6CE>" . $daten['notiz'] . "</td></tr></table>";
            }
            ?>
        </div>
        <?php
        $sql3 = "INSERT INTO `bewerbungen` (`datum`,`firma`, `rechtsart`,`stadt`,`plz`,`strasse_nr`, `ansprech_person`,`email`,`feedback`,`bemerkung`)
VALUES ('" . ($_REQUEST['datum']) . "',
		'" . ($_REQUEST['firma']) . "',
        '" . ($_REQUEST['recht']) . "',
        '" . ($_REQUEST['stadt']) . "',
		'" . ($_REQUEST['plz']) . "',
		'" . ($_REQUEST['strasse']) . "',
        '" . ($_REQUEST['bl']) . "',
		'" . ($_REQUEST['mail']) . "',
        '" . ($_REQUEST['feed']) . "',
		'" . ($_REQUEST['bem']) . "')";
        $_SESSION["datum"] = $_REQUEST["datum"];
        $_SESSION["firma"] = $_REQUEST["firma"];
        $_SESSION["recht"] = $_REQUEST["recht"];
        $_SESSION["stadt"] = $_REQUEST["stadt"];
        $_SESSION["plz"] = $_REQUEST["plz"];
        $_SESSION["bl"] = $_REQUEST["bl"];
        $_SESSION["feed"] = $_REQUEST["feed"];
        $_SESSION["bem"] = $_REQUEST["bem"];
        $_SESSION['str'] = $_REQUEST["strasse"];
        $_SESSION["mail"] = $_REQUEST["mail"];
        $_SESSION["mail_empf"] = $_REQUEST["mail_empf"];
        $_SESSION["feed"] = $_REQUEST["feed"];
        if (!empty($_REQUEST["push"]) && $unausgefuellt) {
            echo"<font color='red'><p>Sie müssen alle Pflichtfelder ausfüllen!<br></font><font color='blue'>Um Ihre bisherigen Eingaben wieder zu erlangen, drücken Sie den Button nochmals.</font></p>";
            die();
        }
        if (!empty($_REQUEST["push"]) && $_REQUEST["push"] == "Datensatz als Mail verschicken & speichern") {
//Anredebegriff prgoramiertechnisch definieren
            $begriff = $_REQUEST["bl"];
            $findme_0 = "Frau";
            $findme_1 = "Herr";
            $pos_0 = stripos($begriff, $findme_0);
            $pos_1 = stripos($begriff, $findme_1);
            if (($pos_0 === false) && ($pos_1 === false)) {
                exit("Sie müssen sowohl die Ansprechperson mit 'Herr' oder 'Frau' klassifizieren, als auch alle Pflichtfelder ausfüllen!");
            }
            $mailanrede = stripos($begriff, $findme_0);
            if ($mailanrede !== false) {
                $anrede = "Sehr geehrte";
            } else {
                $anrede = "Sehr geehrter";
            }
            $_SESSION["anrede"] = $anrede;
//Anredeumsetzung beendet
            $treffer3 = '';
            try {
                $treffer3 = $dbh->exec($sql3);
            } catch (PDOException $e) {
                echo'<p>! DatabaseERROR!<br>' . $e->getMessage() . '</p>';
            }
//print "Error!: " . $e -> getMessage() . "<br>";}
            if ($treffer3) {
                echo "<br><br><p><font size='5'><font color='blue'>Der folgende Datensatz wurde erfolgreich in die Datenbank eingefügt:<br>
	$_REQUEST[datum],$_REQUEST[firma],$_REQUEST[plz],$_REQUEST[strasse],$_REQUEST[stadt],$_REQUEST[bl],$_REQUEST[mail]</p></font>";
                echo"<font size='6'><a style='color:red' href='info_bew.php'>weiter zur Mailbearbeitung</a></font>";
            }
        }
        if (!empty($_REQUEST["push"]) && ($_REQUEST["push"] == "Record nur speichern") || $_REQUEST["push"] == "Record speichern") {
            $treffer3 = '';
            try {
                $treffer3 = $dbh->exec($sql3);
            } catch (PDOException $e) {
                echo"<p>Sie müssen alle Pflichtfelder ausfüllen!</p>";
            }
            if ($treffer3) {
                echo "<br><br><p><font size='5'><font color='blue'>Der folgende Datensatz wurde erfolgreich in die Datenbank eingefügt:<br>
	$_REQUEST[datum],$_REQUEST[firma],$_REQUEST[plz],$_REQUEST[strasse],$_REQUEST[stadt],$_REQUEST[bl],$_REQUEST[mail]</p></font>";
            }
        }
        ?>
    </body>
</html>
