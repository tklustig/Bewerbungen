<?php

function Ausgabe($message, $law) {
    echo"   <p>Datum:<font color='blue'>$_REQUEST[datum]</p></font>
            <p>Firma:<font color='blue'>$_REQUEST[firma]</p></font>
            <p>Rechtsform:<font color='blue'>$law</p></font>
            <p>Plz:<font color='blue'>$_REQUEST[plz]</p></font>
            <p>Stadt:<font color='blue'>$_REQUEST[stadt]</p></font>
            <p>Strasse:<font color='blue'>$_REQUEST[strasse]</p></font>
            <p>Ansprechperson:<font color='blue'>$_REQUEST[bl]</p></font>
            <p>Firmenmail::<font color='blue'>$_REQUEST[mail]</p></font>
            <p>Feedback::<font color='blue'>$message</p></font>
            <p>Bemerkung:<font color='blue'>$_REQUEST[bem]</p></font>
        ";
}

session_start();
include_once 'inc/verbinden.php';
$sql = "UPDATE bewerbungen SET datum = '" . $_REQUEST['datum'] . "' ,firma = '" . $_REQUEST['firma'] . "' ,rechtsart = '" . $_REQUEST['recht'] . "',plz = '" . $_REQUEST['plz']
        . "' , stadt = '" . $_REQUEST['stadt'] . "', strasse_nr = '" . $_REQUEST['strasse'] . "', feedback = '" . $_REQUEST['feed'] . "', bemerkung = '" . $_REQUEST['bem'] . "', ansprech_person = '" . $_REQUEST['bl'] . "', email = '" . $_REQUEST['mail'] . "'"
        . "WHERE bew_id='" . $_SESSION["PrimaryKey"] . "'";
try {
    $treffer = $dbh->exec($sql);
} catch (PDOException $e) {
    echo'<p>Error:' . $e->getMessage() . '</p>';
}
switch ($_REQUEST["feed"]) {
    case 1:
        $feedback = 'Ja';
        break;
    case 2:
        $feedback = 'Nein';
        break;
    case 3:
        $feedback = 'Steht noch aus';
        break;
}
switch ($_REQUEST["recht"]) {
    case 1:
        $rechtform = "Einzelunternehmen";
        break;
    case 2:
        $rechtform = "GbR";
        break;
    case 3:
        $rechtform = "GmbH & Co.KG";
        break;
    case 4:
        $rechtform = "KG";
        break;
    case 5:
        $rechtform = "OHG";
        break;
    case 6:
        $rechtform = "AG";
        break;
    case 7:
        $rechtform = "GmbH";
        break;
    case 8:
        $rechtform = "eG";
        break;
    case 9:
        $rechtform = "KGaA";
        break;
    case 10:
        $rechtform = "Stiftung";
        break;
}
if ($treffer) {
    echo "<p><font size='5'>Der folgende Datensatz wurde wie folgt erfolgreich in der Datenbank verändert:</font>";
    Ausgabe($feedback, $rechtform);
} else {
    echo "<p><font size = '5'>Da die Änderungen nicht ausgeführt wurden, bleibt folgender Datensatz mit folgenden Attributen bestehen:</font>";
    Ausgabe($feedback, $rechtform);
}
$GoBack = $_SESSION["GoBack"];
echo "<a data-toggle='tooltip' title='Render Back to $GoBack' href='$GoBack'>zurück</a>";
?>

