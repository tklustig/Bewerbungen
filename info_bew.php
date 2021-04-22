<?php
session_start();
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mailinf</title>
        <link href="css/style_info.css" rel="stylesheet">
        <script src="js/menus.js"></script>
    </head>
    <body id="go">
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
                    <!--<a href="#R3">Bewerbungen editieren</a>  -->
                </div>
            </li>
        </ul>
    <center><h1>Bitte sorgfältig durchlesen.....</h1></center>
    <main>
        <output id="zeit"></output><br>
        <output id="schritte"></output>
    </main>
    <p> Sie werden nach Push des entsprechenden Buttons, zu einer Seite weitergeleitet, die es Ihnen ermöglicht,den soeben erstellten Record als Mail an die
        eingegebene Adresse zu verschicken. Dabei benötigen Sie folgende Hintergrundinformationen</p>
    <table border="1">
        <caption></caption>
        <thead>
            <tr>
                <th class="tabelle">Index</th>
                <th>Information</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="3"><font color="blue">Alle Angaben ohne Gewähr</td></font>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>1.</td>
                <td>Sie können max. eine Datei beliebigen Typus bis zu einer Größe von max. 1MB hochladen.
                    Sollte Ihre Bewerbung aus mehreren Anhängen bestehen, so wird empfohlen, diese durch eine
                    <a style='color:#04B404' href='https://de.pdf24.org/pdf-creator-download.html'>externe Quelle</a> zu einer einzigen zusammenzuführen.</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Bitte beachten Sie, dass Umlaute(ä,ö,ü,ß) ersetzt werden durch(ae,oe,ue,ss)<br>Der individuelle Mailinhalt wird so verschickt,wie Sie ihn eingegeben haben bzw. wie er
                    nach Versand ausgegeben wird.<br>
                    Der Standardmailinhalt wird so verschickt, wie er nach Versand ausgegeben wird.</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Da es keinen Sinn macht, unter einer dynamischen IP einen Mailserver aufzusetzen, bin ich leider nicht in der Lage,die Absenderadresse
                    zu manipulieren, d.h., eine automatisch generierte Antwortmail würde an meine Mailadresse gehen. Deshalb wird vor Versand ein Häckchen gesetzt
                    ,so dass der Mailempfänger auf diesen Umstand aufmerksam gemacht wird,um entsprechende Vorkehrungen treffen zu können.
                </td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Sollte ich dennoch eine Mail von einem Arbeitgeber bekommen, den ich nicht angeschrieben hatte, werde ich ihm die Lage erläutern. Ihnen entstehen
                    somit kaum Schwierigkeiten.</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Sollten Sie länger als 10 Minuten für den Versand der Mail benötigen, werden Sie aus der Datenbank ausgeloggt.Sie müssen sich dann wieder neu anmelden</td>
            </tr>
        </tbody>
    </table><br>
    <form id="formular" name="formular" action="upload_pi.php" onsubmit="return checkForm()" method="post">
        <input type="checkbox" id="haken" name="haken" value="is_done">
        <input class="button1" type="submit" name="Button"  value="weiter zum Mailen">
        <label>Hiermit bestätige ich, in Kenntniss gesetzt worden zu sein,dass die Absenderadresse nicht manipulierbar ist (s.o.). </label><br>
        <label class="absatz">Dieser Umstand wird dem Mailaddressat automatisch mitgeteilt !</label>
    </form>
    <script>
        function checkForm() {
            if (document.formular.haken.checked == false) {
                alert("ERROR!!\nSie müssen das Häckchen setzen, um so Ihre Inkenntnisnahme zu signalisieren.");
                return false;
            }
        }
    </script>
</html>