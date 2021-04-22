<?php
session_start();
include_once 'inc/verbinden.php';
include_once 'inc/formular.php';
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Datensatz verändern</title>
        <link rel="stylesheet" href="css/style.css" rel="stylesheet">
        <style>
            a{
                font-size:25px;
            }
        </style>
    </head>
    <?php
    $PrimaryKey = $_GET['url'];
    $sql1 = "SELECT datum,firma,rechtsart,stadt,plz,strasse_nr,ansprech_person,email ,feedback,bemerkung FROM bewerbungen WHERE bew_id=$PrimaryKey";
    $treffer1 = $dbh->query($sql1); // obejektorientierte Abfrage definieren
    foreach ($treffer1 as $daten) {
        $date = $daten['datum'];
        $company = $daten['firma'];
        $law = $daten['rechtsart'];
        $town = $daten['stadt'];
        $plz = $daten['plz'];
        $street = $daten['strasse_nr'];
        $person = $daten['ansprech_person'];
        $Email = $daten['email'];
        $feedback = $daten['feedback'];
        $hint = $daten['bemerkung'];
    }
    //Das <form>-Tag ist im Formular enthalten. Die Verarbeitung der Daten geschieht dort.
    FormularAnzeigen(false, $date, $company, $law, $town, $plz, $street, $person, $Email, $feedback, $hint);
    $sql2 = "SELECT * FROM rechtsform WHERE 1";
    $sql3 = "SELECT * FROM nachricht WHERE 1";
    ?>
    <div id="box1">
        <br><br><table border="3"><tr><td width="60" bgcolor=#A9F5A9>ID</td><td width="157" bgcolor=#F5F6CE>Rechtsart</td></tr></table>
        <?php
        $treffer2 = $dbh->query($sql2); // obejektorientierte Abfrage definieren
        $treffer3 = $dbh->query($sql3);
        foreach ($treffer2 as $daten) { //Datensätze in Tabellenform auslesen
            echo"<table border='1'>";
            echo "<tr><td width='60' bgcolor=#A9F5A9>" . $daten['id_recht'] . "</td><td width='160' bgcolor=#F5F6CE>" . $daten['art'] . "</td></tr></table>";
        }
        echo"<table border='3'>";
        echo"<br><tr><td width='60' bgcolor=#A9F5A9>ID</td><td width='157' bgcolor=#F5F6CE>feedback</td></tr></table>";
        foreach ($treffer3 as $daten) {   //Datensätze in Tabellenform auslesen
            echo"<table border='1'>";
            echo "<tr><td width='60' bgcolor=#A9F5A9>" . $daten['id_message'] . "</td><td width='160' bgcolor=#F5F6CE>" . $daten['notiz'] . "</td></tr></table>";
        }
        ?>
    </div>
    <br><br>
    <?php
    $_SESSION["PrimaryKey"] = $PrimaryKey;
    $GoBack = $_SESSION["GoBack"];
    echo "<a data-toggle='tooltip' title='Render Back to $GoBack' href='show_all.php'>zurück</a>";
    ?>
</html>
