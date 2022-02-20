<?php

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $user = 'root'; // DB-Parameter definieren...
    $pw = '';
    $hostname = "localhost";
} else {
    $user = 'k158364_kipp'; // DB-Parameter definieren...
    $pw = 'strengGeheim';
    $hostname = "mysql2efb.netcup.net";
}
$providerPrefix = 'k158364_';
$databasetyp = "mysql";
$databasename = $providerPrefix . $_SESSION["username"];
try {
    $dbh = new PDO("$databasetyp:host=$hostname;dbname=$databasename;charset=utf8", $user, $pw, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // DB-Aufbau objektorientiert
//echo"<p class='center'>MySQL-Datenbank wurde soeben initialisiert...</p>";
} catch (PDOException $e) {
    print 'Error!: ' . $e->getMessage() . ' at line ' . $e->getLine() . ' in file' . $e->getFile() . '<br>';
    echo"<p><font size='5'>ERROR! Sie müssen zuerst eine Datenbank anlegen !!</p></font>";
    echo"<p><font size='4'>Mitunter sind die Zugangsparameter im Code inkorrekt. Bitte informieren Sie mich über die Messagebox!</p></font>";
    echo "<a href='anmelden.php'>zurück zur Anmeldung</a>";
    die();
}
?>