<?php
session_start();
error_reporting(1); //unterdrückt Warnungen;erst im Produktivbetrieb einsetzen!
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bewerbungen löschen</title>
        <script src="js/menus.js"></script>
        <script src="js/datetime.js"></script>
        <link href="css/style_0.css" rel="stylesheet">
    </head>
    <body>
        <div class="mainDiv">
            <div id="uhr" class="borderLeft"></div>
        </div>
        <form id="formular" name="formular" action=<?= $_SERVER['PHP_SELF']; ?> method="post">
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
                        <a href="einfuegen_extract.php">Bewerbungen eingeben</a>
                        <a href="#R2">Bewerbungen löschen</a>
                        <!--<a href="#R3">Bewerbungen editieren</a>  -->
                    </div>
                </li>
            </ul>
            <center><h1>Delete specific records</h1></center>
            <p>Anbei werden die Datensätze nach ID und bestimmter Atrribute aufgelistet. Zum Löschen wählen Sie bitte die ID in der entsprechende DropDown-Liste und betätigen den<br> 'Record löschen'-Button.
                Danach verhindert nur noch JavaScript ein vorschnelles Löschen.Nach erneuter Bestätigung gilt dann:<br><font color='red'>Gelöscht ist Gelöscht!!</font>Scrollen Sie bitte nach dem Löschen, sofern nötig,
                nach unten, um die Bewerbungen neu zu laden.</p>
            <input type="submit" name="Button" id="position_1" name="position_1" value="Record löschen">
            <?php
            include_once 'inc/verbinden.php';
            $sql = "SELECT bew_ID AS ID,datum,firma,stadt FROM bewerbungen";
            $sql1 = "SELECT COUNT(bew_id) AS anzahl FROM bewerbungen";
            $sqlIndex = "SELECT MIN(bew_id) AS minimum FROM bewerbungen";
            $eruate = $dbh->query($sqlIndex);
            foreach ($eruate as $daten) {
                $minimum = $daten[0];
                break;
            }
            $treffer = $dbh->query($sql); // obejektorientierte Abfrage definieren
            $treffer1 = $dbh->query($sql1);
            foreach ($treffer1 as $daten) {
                echo"<p>" . auswahl_ID($daten['anzahl'], $minimum) . "</p></center>";
                $cut = $_REQUEST['anzahl_x'];
            }
            ?>
            <table border='3'>
                <tr><td width='70' bgcolor=red><b>Lösch-ID</td></b><td width='80' bgcolor=#F2F5A9>Datum</td><td width='140' bgcolor=#A9BCF5>Firma</td><td width='100' bgcolor=#F5A9F2>Stadt</td>
                    <?php
                    if ($treffer) {
                        foreach ($treffer as $daten) {   //spezifisierte Datensätze in Tabellenform auslesen
                            echo"<table border='1'>";
                            echo "<tr><td width='70' bgcolor=red><b>" . $daten['ID'] . "</b></td><td width='80' bgcolor=#F2F5A9>" . $daten['datum'] . "</td><td width='140' bgcolor=#A9BCF5>" . $daten['firma'] . "</td>
                        <td width='100' bgcolor=#F5A9F2>" . $daten['stadt'] . "</td></td></tr></table>";
                        }
                    } else
                        echo "<p>Keine Datensätze vorhanden</p>";
                    ?>
                <a href='index.php'>zurück</a>
                <script>
                    document.getElementById('formular').onsubmit = function () {
                        var answer = confirm("Record wirklich löschen??");
                        if (answer)
                            return true;
                        else
                            return false;
                    }
                </script>
                <?php
                $anzahl = $cut;
                if (!empty($_REQUEST["Button"]) && $_REQUEST["Button"] == "Record löschen") { //Hauptkonditionsanfang
                    $sql1 = "DELETE FROM bewerbungen WHERE bew_id=$cut";
                    $sql4 = 'SELECT MAX(bew_id) FROM bewerbungen';
                    $sql2 = "UPDATE bewerbungen SET bew_id=$anzahl WHERE bew_id>$cut";
                    $sql3 = "ALTER TABLE bewerbungen AUTO_INCREMENT = $anzahl";
                    $treffer1 = '';
                    $treffer2 = '';
                    $treffer3 = '';
                    try {
                        $treffer1 = $dbh->exec($sql1);
                        $treffer2 = $dbh->exec($sql2);
                        $treffer3 = $dbh->query($sql3);
                    } catch (PDOException $e) {
                        echo"<p>Sie müssen eine gültige ID angeben</p>";
                        print_r( "Error!: " . $e->getMessage() . "<br>");
                    }
                    if ($treffer3) {
                        echo "Auto-Increment-Index wurde soeben erfolgreich zurückgesetzt!";
                    }
                    if ($treffer1) {
                        echo "<br><br><p><font size='5'><font color='blue'>Der Datensatz mit der ID:$cut wurde erfolgreich aus der Datenbank entfernt</p></font>";
                        echo"<font color='#0B0719'><a href='delete_records.php'>Bewerbungen neu laden</a></font>";
                    } else
                        echo"<p><font size='6'>Der Datensatz konnte nicht gelöscht werden!Probieren Sie es erneut!</font>";
                }//Hauptkonditionsende
                ?>
                <?php

                function auswahl_ID($anzahl, $minimum) {
                    $maximum = $anzahl + $minimum - 1;
                    $result = '';
                    for ($i = $minimum; $i <= $maximum; $i++) {
                        $result .= '<option style="font-size:15px" value="' . $i . '">Lösch-ID:' . $i . '</option>';
                    }
                    $result = '<select name="anzahl_x" id="anzahl_x">' . $result . '</select>';
                    return $result;
                }
                ?>
        </form>
    </body>
</html>