<?php
session_start();
error_reporting(1);
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bewerbungen/Datum anzeigen</title>
        <script src="js/menus.js"></script>
        <script src="js/jquery-1.7.1.min.js"></script>
        <script src="js/jquery-ui-1.8.17.custom.min.js"></script>
        <link rel="stylesheet" href="css/style_0.css" rel="stylesheet">
        <link rel="stylesheet" href="css/jquery-ui-1.8.17.custom.css">
    </head>
    <body>
        <ul>
            <li><a href="index.php">Logout</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_0()">Bewerbungen suchen</a>
                <div class="dropdown-inhalt_0" id="auswahl_0">
                    <a href="show_all.php">alle Bewerbungen anzeigen</a>
                    <a href="show_open.php">offene Bewerbungen anzeigen </a>
                    <a href="show_done.php">erledigte Bewerbungen anzeigen </a>
                    <a href="#b4">Bewerbungen nach Datum suchen</a>
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
    <center><h1>Show records specified by date</h1></center><br>
    <p><i>Hier werden durch das Betätigen des Buttons alle Bewerbungen eines bestimmten Datums oder eines Zeitraumes angezeigt! Vor Betätigen des Suchbuttons können Sie noch mittels zweier Radiobuttons
            festlegen, ob Bewerbungen vor oder nach dem Datum angezeigt werden sollen. Danach entspricht der Voreinstellung. Eine erneute Suche betätigen sie bitte <b>nach</b> Pushen des Resetbuttons. Danach nämlich
            wird das bisher eingegebene Datum übernommen;<br>Sie können es dann mittels der kleinen Pfeilsymbole beliebig manipulieren und erneut suchen....<p></i>
        <script>
            $(document).ready(function () {
                $('#date').datepicker({
                    showOn: 'both',
                    buttonText: '',
                    buttonImage: 'calendar.png',
                    buttonImageOnly: true,
                    numberOfMonths: 1,
                    maxDate: '30d',
                    minDate: '-24m',
                    showButtonPanel: true,
                    dateFormat: 'yy-mm-dd'
                });
            });
        </script>
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
        <div id="box1" class="box1">
            <input class="button1" type="submit" name="search_reset" value="Reset">
            <label name="ort">Suche bereinigen</label></div><br><br>
        <center>
            <input class="feld" type=text name="anfang0" id="date" placeholder="hier das Datum eintragen" value="<?php
            if (!empty($_SESSION['anfang0'])) {
                echo $_SESSION['anfang0'];
            }
            ?>">
            <input class="button" type="submit" name="search0" value="Suchen"><br><br>
            <label class="pos" for="lab_before">davor</label>
            <input class="pos" type="radio" id="before" name="radio_choice" value="davor">
            <label class="pos" for="lab_after">danach</label>
            <input class="pos" type="radio" id="after" name="radio_choice" value="danach" checked>
        </center>
    </form>
    <?php
    if (!empty($_REQUEST["anfang0"]) && $_REQUEST["search0"] == "Suchen") { //Mainkonditionsanfang
        $_SESSION["anfang0"] = $_REQUEST["anfang0"];
        include_once 'inc/verbinden.php';

        if ($_REQUEST["radio_choice"] == "davor") {
            $sql = "SELECT bew_id,datum,firma,art,stadt,plz,strasse_nr,ansprech_person,email,notiz AS feedback,bemerkung FROM bewerbungen JOIN rechtsform ON bewerbungen.rechtsart=rechtsform.id_recht
			JOIN nachricht ON bewerbungen.feedback=nachricht.id_message where datum < '" . $_REQUEST["anfang0"] . "' ORDER BY datum ASC";
            $sql1 = "SELECT COUNT(bew_id) as anzahl FROM bewerbungen WHERE datum < '" . $_REQUEST["anfang0"] . "' ORDER BY datum ASC";
        } else {
            $sql = "SELECT datum,firma,art,stadt,plz,ansprech_person,email,notiz AS feedback,bemerkung FROM bewerbungen JOIN rechtsform ON bewerbungen.rechtsart=rechtsform.id_recht
	JOIN nachricht ON bewerbungen.feedback=nachricht.id_message where datum > '" . $_REQUEST["anfang0"] . "' ORDER BY datum ASC";
            $sql1 = "SELECT COUNT(bew_id) as anzahl FROM bewerbungen WHERE datum > '" . $_REQUEST["anfang0"] . "' ORDER BY datum ASC";
        }
        $treffer = $dbh->query($sql);
        $treffer1 = $dbh->query($sql1);
        foreach ($treffer1 as $daten) {
            print "<br><b><font size='5'><font color='#FA5858'>Es wurden " . $daten['anzahl'] . " Datensätze gefunden</b></font size></font><br><br>";
        }
        ?>
        <table border="3">
            <tr>
                <td width="80" bgcolor=#F2F5A9>Datum</td><td width="140" bgcolor=#A9BCF5>Firma</td><td width="130" bgcolor=#A9F5BC>Rechtform</td><td width="100" bgcolor=#F5A9F2>Stadt</td>
                <td width="40" bgcolor=#A9F5BC>Plz</td><td width="160" bgcolor=#BE81F7>Ansprechperson</td><td width="200" bgcolor=yellow>E-Mail</td><td width="100" bgcolor=#FAAC58>Feedback</td>
                <td width="150" bgcolor=#01DF01>Bemerkung</td>
            </tr>
            <?php
            if ($treffer) {
                foreach ($treffer as $daten) {
                    echo"<table border='1'>";
                    echo"<tr><td width='80' bgcolor=#F2F5A9>" . $daten['datum'] . "</td><td width='140' bgcolor=#A9BCF5>" . $daten['firma'] . "</td><td width='130' bgcolor=#A9F5BC>" . $daten['art'] . "</td><td width='100' bgcolor=#F5A9F2>" . $daten['stadt'] . "</td>
		<td width='40' bgcolor=#A9F5BC>" . $daten['plz'] . "</td><td width='160' bgcolor=#BE81F7>" . $daten['ansprech_person'] . "</td><td width='200' bgcolor=yellow>" . $daten['email'] . "</td>
		<td width='100' bgcolor=#FAAC58>" . $daten['feedback'] . "</td><td width='150' bgcolor=#01DF01>" . $daten['bemerkung'] . "</td></tr></table>";
                }
            } else
                echo "<p>Keine Datensätze vorhanden</p>";
        } //Mainkonditionsende
        else if (empty($_REQUEST["search_reset"]))
            echo"<p>Bitte ein gültiges Datum eingeben<p>";

        $arrayForLink = explode("\\", __FILE__);
        //unter LINUX ist das Array leer
        if (!count($arrayForLink) > 0)
            $arrayForLink = explode("/", __FILE__);
        $_SESSION["GoBack"] = __FILE__;
        $_SESSION["GoBack"] = $arrayForLink[count($arrayForLink) - 1];
        ?>
    </body>
</html>