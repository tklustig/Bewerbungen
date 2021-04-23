<?php

if (!empty($_REQUEST['username']) && !empty($_REQUEST[('passwort')])) {
    $passwordPlain = $_REQUEST["passwort"]; //hier befindet sich das Userpasswort, allerdings unverschlüsselt
    $user = umwandeln($_REQUEST["username"]); //hier befindet sich der Benutzername
    $passwordEncrypted = password_hash($passwordPlain, PASSWORD_DEFAULT); //hier wird das Userpasswort verschlüsselt
    $PasswordTxt = $user . "_passwort.txt";
    $UserTxt = $user . "_user.txt";
    $pfad = "./pfad/";
    if (!file_exists($pfad . $PasswordTxt) && !file_exists($pfad . $UserTxt)) {
        $WritePasswordFile = fopen($pfad . $PasswordTxt, "w"); //hier wird eine Datei geöfnet....
        $WriteUserFile = fopen($pfad . $UserTxt, "w"); // und hier noch eine....
        /*
          Sollte es zu unerklärlichen Fehlern unter LINUX kommen, muss mittels Entkommentieren der Funktion CheckFiles()
          überprüft werden, ob Berechtigungen korrekt gesetzt sind
         */
        //CheckFiles($pfad,$PasswordTxt);
        fputs($WritePasswordFile, $passwordEncrypted); // ..um das verschlüsselte Passwort sodann in die Datei zu schreiben
        fputs($WriteUserFile, $user); //..um den User in eine seperate Datei zu schreiben
        fclose($WritePasswordFile); //
        fclose($WriteUserFile); //...und letztlich die Dateien wieder zu schließen!
        $ReadPassword = file_get_contents($pfad . $PasswordTxt); //Hier wird es wieder ausgelesen

        if (password_verify($passwordPlain, $ReadPassword)) { //sofern das Passwort verifiziert wird
            echo"Ihr Benutzername lautete:$user <br><br>";
            echo"Ihr Passwort lautete unverschlüsselt:$passwordPlain<br>";
            echo "Ihr Passwort wurde wie folgt verschlüsselt:$ReadPassword<br><br>...und hat somit die Verifizierung bestanden!<br><br>";
        } else {
            print_r("<p>Das Passwort konnte nicht verifiziert werden</p>");
            print_r("Script corrupted");
            die();
        }
        $heute = date("Y-m-d H:i:s") . '  ';
        $subject = 'Eine Neuregistration für Bewerbungen';
        $nachricht = 'Soeben hat sich der User ' . $user . ' auf der Webapplikation Bewerbungen neu registriert!';
        $ausgabe = "$subject\r\n$nachricht\r\n";
        $datei = fopen("nachricht.txt", "a+");
        fputs($datei, $heute);
        fputs($datei, $ausgabe); // schreibt die Nachricht i.d.Datei
        fclose($datei);
        echo "<p><a href='anmelden.php' title='Registrierung'>weiter zur Anmeldung</a></p>";
    } else {
        echo"<p><font size='5'><p>Benutzernamen existiert bereits. Bitte einen anderen eingeben!</font></p>";
        echo "<p><a href='registrieren.php' title='Crash'>Zurück zum Registrierungsformular</a></p>";
    }
}
/* Da bereits über jQuery veranlasst wurde, dass alle REQUESTValues vorhanden sind, wurde dieser Code auskommentiert
  else {
  echo"<font size='5'><p>Bitte sowohl den Benutzernamen als auch das Passwort vollständig eingeben!</p></font>";
  echo "<br><a href='registrieren.php' title='Crash'>Zurück zum Registrierungsformular</a>";
  }
 */

function CheckFiles($pfad, $filename) {
    $file = $pfad . $filename;
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    echo 'phpversion: ', phpversion(), "\n";
    echo 'uname: ', php_uname("s r"), "\n"; //release of the operating system
    echo $file, file_exists($file) ? ' exists' : ' does not exist', "\n";
    echo $file, is_readable($file) ? ' is readable' : ' is NOT readable', "\n";
    echo $file, is_writable($file) ? ' is writable' : ' is NOT writable', "\n";
    $fp = fopen($file, 'a+');
    if (!$fp) {
        print_r('last error: ');
        var_dump(error_get_last());
        die();
    } else {
        print_r("OK!");
        die();
    }
}

function umwandeln($string) {
    $umlaute = array("ä", "ö", "ü", "Ä", "Ö", "Ü", "ß");
    $ersetzen = array("ae", "oe", "ue", "Ae", "Oe", "Ue", "ss");
    return str_replace($umlaute, $ersetzen, $string);
}
?>

