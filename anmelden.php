<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <script src="js/menus.js"></script>
        <script src="js/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <ul>
            <li><a href="index.php">Logout</a></li>
            <li><a href="registrieren.php">Registrieren</a></li>
            <li><a href="#A3">Anmelden</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_0()">Records suchen</a>
                <div class="dropdown-inhalt_0" id="auswahl_0">
                    <a href="fallout.php">alle Bewerbungen anzeigen</a>
                    <a href="fallout.php">offene Bewerbungen anzeigen </a>
                    <a href="fallout.php">erledigte Bewerbungen anzeigen </a>
                    <a href="fallout.php">Bewerbungen nach Datum suchen</a>
                    <a href="fallout.php">Bewerbungen nach Ort suchen</a>
                    <a href="fallout.php">Bewerbungen nach Firma suchen</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_1()">Adminbereich</a>
                <div class="dropdown-inhalt_0" id="auswahl_1">
                    <a href="fallout.php">Records eingeben</a>
                    <a href="fallout.php">Records löschen</a>
                    <!--  <a href="#R3">Records editieren</a>  -->
                </div>
            </li>
        </ul>
    <center><h1>Anmeldeformular</h1></center>
    <script>
        $(document).ready(function () {
            $('#signup form').validate({
                rules: {
                    username: {
                        required: true
                    },

                    passwort: {
                        required: true
                    },
                },
                success: function (label) {
                    label.text('OK!').addClass('valid');
                }
            });
        });
    </script>
    <div id="signup">
        <form action="backend.php" method="post">
            <p> Sollten Sie Ihre Zugangsdaten vergessen haben, schicken Sie mir bitte <a href='index.php' title='Crash'>hier</a> eine Nachricht!</p>
            <p><font color ="red">Bitte geben Sie die Zugangsdaten ein:</p></font>
            <div><label for="username">Benutzer:</label></div>
            <input type="text" name="username" id="username" value="<?php if (!empty($_SESSION['username'])) echo $_SESSION['username']; ?>"></p>
            <div><label for="passwort">Passwort: </label></div>
            <input type="password" name="passwort" id="passwort">
            <input class="button2" type="submit" name="push" value="Anmelden">
        </form></div>
</body>
</html>