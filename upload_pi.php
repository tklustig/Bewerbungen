<?php
error_reporting(1);
session_start();
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload</title>
        <script src="js/menus.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <style></style>
    </head>
    <body>
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_0()">Home</a>
                <div class="dropdown-inhalt_0" id="auswahl_0">
                    <a href="index.php">Logout</a>
                </div>
            </li>
            <li><a href="#A1">Registrieren</a></li>
            <li><a href="#A2">Anmelden</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_1()">Bewerbungen suchen</a>
                <div class="dropdown-inhalt_0" id="auswahl_1">
                    <a href="show_all.php">alle Bewerbungen anzeigen</a>
                    <a href="show_open.php">offene Bewerbungen anzeigen </a>
                    <a href="show_done.php">erledigte Bewerbungen anzeigen </a>
                    <a href="show_date.php">Bewerbungen nach Datum suchen</a>
                    <a href="show_place.php">Bewerbungen nach Ort suchen</a>
                    <a href="show_company.php">Bewerbungen nach Firma suchen</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_2()">Adminbereich</a>
                <div class="dropdown-inhalt_0" id="auswahl_2">
                    <a href="einfuegen_extract.php">Bewerbungen eingeben</a>
                    <a href="delete_records.php">Bewerbungen löschen</a>
                    <a href="stelle_suchen.php">Stelle suchen</a>
                    <!--  <a href="#R3">Bewerbungen editieren</a>  -->
                </div>
            </li>
        </ul>
    <center><h2> Uploading your Files, if requested and send 'em as mail!</h2></center>
    <p><i> Innerhalb dieser Unterubrik können Sie vorab jene Datei hochladen, die Sie dann per Mail verschicken möchten. Dazu wählen Sie bitte über den Uploadbutton eine Datei bis max. 1,5 MB
            aus und Betätigen den 'Hochladen' -Button <font color="red">zweimal hintereinander</font><font color="green">(einmal fürs Hochladen, und das zweite Mal zur Bestätigung mittels eines Infobuttons)</font>.
            Aus Gründen der Übersichtlichkeit können Sie nur eine Datei verschicken!Nach Angabe aller Faktoren drücken Sie bitte den 'Bewerben'-Button.
            Abschließend wird nach dem Versand der Bewerbung die Uploadfile gelöscht!</p></i>
<form action=<?= $_SERVER['PHP_SELF']; ?> name="formular" id="formular" method="post" onsubmit="return checkForm()" enctype="multipart/form-data">
    <label>Uploadbutton:</label>
    <input type="file" name="datei_0">
    <label>Infobutton:</label>
    <input class="button6" type=button name="bez" id="bez" value="<?php if (!empty($_SESSION["button_y"])) echo $_SESSION["button_y"]; ?>"><br><br>
    <input class="button4" type="submit" name="push" value="Hochladen">
    <input class="button3" type="submit" name="mail_send" value="Bewerben">
    <input class="absatz" type="checkbox" id="nachricht_id" name="nachricht_id" value="done" checked>
    <label class="label_o">Nachricht an Arbeitgeber, dass Mailabsendeadresse nicht identisch mit der meinigen</label><br>
    <p>Betreffzeile:</p>
    <input class="button1" type=text name="betreff" id="betreff" value="<?php if (!empty($_REQUEST["betreff"])) echo $_REQUEST["betreff"]; ?>"><br>
    <p>Referenznummer:</p>
    <input class="button1" type=text name="referenz" id="ref" value="<?php if (!empty($_REQUEST["referenz"])) echo $_REQUEST["referenz"]; ?>" placeholder="kann leer bleiben"><br><br>
    <br><br>
    <div><label>Die Mailadresse der Firma:</label>
        <?php
        echo'<label><font color="#FF00FF">' . $_SESSION["mail"] . '</label></font><br>';
        ?>
    </div>
    <div><label>Ihre Mailadresse:</label>
        <?php
        echo'<label><font color="#FF00FF">' . $_SESSION["mail_empf"] . '</label></font><br>';
        ?>
    </div>
    <div>
        <label>Die Kontaktperson:</label>
        <?php
        echo'<label><font color="#FF00FF">' . $_SESSION["bl"] . '</label></font><br><br>';
        ?>
    </div>
    <p>Mailinhalt</p>
    <input type="radio" id="anrede_0" name="radio_choice" value="wahl_0" checked>
    <label>
        <?php echo $_SESSION["anrede"] ?><?php echo $_SESSION["bl"] ?>,<br><div style="text-indent:25px;">hiermit bewerbe ich mich auf Ihre ausgeschriebene Stelle als Softwareentwickler.</div>  <?php //echo $_REQUEST["referenz"] ?>
        <div style="text-indent:25px;">Das Anschreiben sowie meine Referenzen sind komplett als Anhang beigefuegt.<br><br><div style="text-indent:25px;">Mit freundlichen Gruessen<br><div style="text-indent:25px;">Thomas Kipp<br><br></div></div></div></label>
    <?php
    $anmerkung = "<label>P.S.:\nDiese Nachricht wurde durch meine Website (https://tklustig.de) erstellt und verschickt. Stellen Sie folglich bitte sicher, dass Ihre Antwort ggf. an die Adresse\n<div style='text-indent:45px;'>"
            . $_SESSION["mail_empf"] . " gerichtet ist!</label></div>";
    echo $anmerkung . '<br>';
    ?>
</div></label>
<input type="radio" id="before" name="radio_choice" value="wahl_1">
<label for="lab_before">eigenen Mailinhalt erstellen</label><br><br>
<textarea name="nachricht" id="nachricht" cols=120 rows=8  placeholder="Hier eigenen Mailinhalt verfassen"></textarea><br><br>		
</form>
<script>
    function checkForm() {
        if (document.formular.nachricht_id.checked == false) {
            alert("ERROR!!\nSie müssen das Häckchen setzen, um so Ihre Inkenntnisnahme zu signalisieren.");
            return false;
        }
    }
</script>
<?php
if (isset($_REQUEST['betreff']) && !isset($_REQUEST['push']) && empty($_REQUEST['betreff'])) {
    ?>
    <script>
        alert('Bitte den Betreff angeben');
    </script>
    <?php
    die();
}

$ordner = './upload/';
$ordner_copy = './upload_copy/';
$filename_0 = pathinfo($_FILES['datei_0']['name'], PATHINFO_FILENAME);
$erweiterung_0 = strtolower(pathinfo($_FILES['datei_0']['name'], PATHINFO_EXTENSION));
$max_size = 3000 * 1000;
if (($_FILES['datei_0']['size']) > $max_size) {
    echo '<script>';
    echo 'alert("Uploadfile ist zu groß")';
    echo '</script>';
    die();
}
$pfad_neu_0 = $ordner . $filename_0 . '.' . $erweiterung_0;
move_uploaded_file($_FILES['datei_0']['tmp_name'], $pfad_neu_0);
$_SESSION["button_y"] = $filename_0 . "." . $erweiterung_0;
$umlaute = array("ä", "ö", "ü", "Ä", "Ö", "Ü", "ß");
$ersetzen = array("ae", "oe", "ue", "Ae", "Oe", "Ue", "ss");
$_SESSION["bl"] = str_replace($umlaute, $ersetzen, $_SESSION["bl"]);
if (!empty($_REQUEST["mail_send"]) && $_REQUEST["mail_send"] == "Bewerben") {
    $referenz = '';
    if (!empty($_REQUEST['referenz']))
        $referenz = $_REQUEST['referenz'];
    if ($_REQUEST["radio_choice"] == "wahl_0") {
        $show_mail = $_SESSION["anrede"] . " " . $_SESSION["bl"] . ",\n\nhiermit bewerbe ich mich auf Ihre ausgeschriebene Stelle";
        if (!empty($_REQUEST['referenz']))
            $show_mail = $show_mail . "(ID:$referenz) als Softwareentwickler.\nDas Anschreiben sowie meine Referenzen sind komplett als Anhang beigefuegt.\n\nMit freundlichen Gruessen,\nThomas Kipp";
        else
            $show_mail = $show_mail . "als Softwareentwickler.\nDas Anschreiben sowie meine Referenzen sind komplett als Anhang beigefuegt.\n\nMit freundlichen Gruessen,\nThomas Kipp";
        $anmerkung = "\n\nP.S.:\nDiese Nachricht wurde durch meine Website (https://tklustig.de) erstellt und verschickt. Stellen Sie folglich bitte sicher, dass Ihre Antwort ggf. an die Adresse\n"
                . $_SESSION["mail_empf"] . " gerichtet ist!";
        $show_mail = $show_mail . $anmerkung;
    } else {
        $show_mail = $_REQUEST["nachricht"];
        $anmerkung = "\n\nP.S.:\nDiese Nachricht wurde durch meine Website erstellt und verschickt. Stellen Sie folglich bitte sicher, dass Ihre Antwort ggf. an die Adresse\n"
                . $_SESSION["mail_empf"] . " gerichtet ist!";
        $message = $show_mail . $anmerkung;
        $umlaute = array("ä", "ö", "ü", "Ä", "Ö", "Ü", "ß");
        $ersetzen = array("ae", "oe", "ue", "Ae", "Oe", "Ue", "ss");
        $show_mail = str_replace($umlaute, $ersetzen, $message);
    }
    $dateien_x = scandir($ordner);
    foreach ($dateien_x as $datei) {
        $_SESSION["anhang_x"] = $datei;
    }
    echo "<label><font color='blue'>Folgende Bewerbung mitsamt dem Anhang/" . $_SESSION["anhang_x"] . " wurde an die Mailadresse:" . $_SESSION["mail"] . " verschickt:<br><br></label></font>";
    echo "<label>Betreff: " . $_REQUEST["betreff"] . "<br><br>";
    echo nl2br($show_mail) . '</label>';
    require('class.phpmailer.php');
    //Instanz von PHPMailer bilden
    $mail = new PHPMailer();
    //Name des Abenders setzen
    $mail->FromName = "Thomas Kipp";
    //Empfängeradresse setzen
    $mail->AddAddress($_SESSION["mail"]);
    //Eine Kopie der Mail an mich schicken. Dient zur (visuellen) Kontrolle
    $mail->AddBCC('kipp.thomas@tklustig.de');
    //Betreff der Email setzen
    $mail->Subject = $_REQUEST["betreff"];
    //Text der EMail setzen
    $mail->Body = $show_mail;
    //Eine Datei vom Server als Anhang beifügen
    $mail->AddAttachment('upload/' . $_SESSION["anhang_x"]);
    //EMail senden und überprüfen ob sie versandt wurde
    if (!$mail->Send()) {
        echo "<br>Die Email konnte nicht gesendet werden";
        echo "<br>Fehler: " . $mail->ErrorInfo;
    }
    //Upload in anderen Ordner kopieren
    $upload_copy = opendir($ordner);
    while ($file = readdir($upload_copy)) {
        if ($file != "." && $file != "..")
            copy($ordner . $file, $ordner_copy . $file);
    }
    closedir($upload_copy);
    //Upload vernichten
    $upload_delete = opendir($ordner);
    while ($file = readdir($upload_delete)) {
        if ($file != "." && $file != "..")
            unlink($ordner . $file);
    }
    closedir($upload_delete);
}
?>
</body>
</html>