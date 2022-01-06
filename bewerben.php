<?php
session_start();
if (empty($_SESSION['id']))
    $_SESSION['id'] = $_GET['url'];
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
    <center><h1>Bewerbungsvorbereitung</h1></center><br>
    <p>Pushen Sie auf den Button, um die Bewerbungsdaten abzurufen und weiterzuleiten</p></i><br><br>  
<form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
    <input  type="text" name="mailadress" placeholder="Ihre Mailadresse:" value='<?php if (!empty($_REQUEST['mailadress'])) echo $_REQUEST['mailadress']; ?>'>
    <center><input class="button" type="submit" name="search0" value="Details holen"></center>
</form>
<?php
if (!empty($_REQUEST["search0"])) {
    if (empty($_REQUEST['mailadress'])) {
        ?><p style="color: red;font-size: 20px;">Bitte Ihre Mailadresse eingeben</p>"<?php
    } else {
        if (!filter_var($_REQUEST['mailadress'], FILTER_VALIDATE_EMAIL)) {
            ?><p style="color: red;font-size: 20px;">Bitte eine valide  Mailadresse eingeben</p>"<?php
        } else {
            include_once 'inc/verbinden.php';
            $sql = 'SELECT ansprech_person,email FROM bewerbungen WHERE bew_id=' . $_SESSION['id'];
            $treffer = $dbh->query($sql); // obejektorientierte Abfrage definieren
            foreach ($treffer as $daten) {
                $kontaktPerson = $daten['ansprech_person'];
                $mailAdresse = $daten['email'];
                break;
            }
            $_SESSION["mail"] = $mailAdresse;
            $_SESSION["mail_empf"] = $_REQUEST['mailadress'];
            $_SESSION["bl"] = $kontaktPerson;
            unset($_SESSION['id']);
            header("Location:upload_pi.php");
        }
    }
}
?>
</body>
</html>

