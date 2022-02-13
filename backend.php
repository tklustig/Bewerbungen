<?php
session_start();

function mailen($user) {
    $to = 'thomas_kipp@tklustig.de';
    $subject = 'Eine Neuregistration für Bewerbungen';
    $nachricht = "Soeben hat sich der User $user auf der Webapplikation Bewerbungen neu registriert!";
    $fromName = 'Thomas Kipp';
    $fromEmail = 'kipp_thomas@tklustig.de';
    $header = 'MIME-Version: 1.0' . "\r\n";
    $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $header .= 'From:  ' . $fromName . ' <' . $fromEmail . '>' . " \r\n" .
            'Reply-To: ' . $fromEmail . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    if (mail($to, $subject, $nachricht, $header))
        return true;
    else
        return false;
}

$folder = 'pfad' . DIRECTORY_SEPARATOR;
$providerPrefix = 'k158364_';
if (isset($_REQUEST['push']) && $_REQUEST['push'] == "Anmelden") {
    if (!empty($_REQUEST['username']) && !empty($_REQUEST['passwort'])) {
        try {
            $datenNamen_0 = $_REQUEST['username'] . "_passwort.txt";
            $datenNamen_1 = $_REQUEST['username'] . "_user.txt";
            $password_show = file_get_contents($folder . $datenNamen_0);
            $user_show = file_get_contents($folder . $datenNamen_1);
        } catch (Exception $er) {
            var_dump($er);
            echo"<p><a href='registrieren.php' title='weiter'>Weiter zum Registrierungsformular</a></p>";
        }
        if ($_POST['username'] == $user_show && password_verify($_REQUEST['passwort'], $password_show))
            $_SESSION['username'] = $_POST['username'];
        else
            unset($_SESSION['username']);
    } else
        echo"<font size='5'> Bitte alle Zugangsdaten ausfüllen!</font>";
}
if (!isset($_SESSION['username']))
// Kontrolle, ob eine session existiert, andernfalls austeigen
    exit('<font size="7"><p>Kein Zugriff -- Access DENIED !!<br><br></font><a href="anmelden.php" title="back">Zurück zum Anmeldeformular</a></p>');
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Backend</title>
        <script src="js/menus.js"></script>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <ul>
            <li><a href="index.php">Logout</a></li>
            <!--   <li><a href="#A1">Registrieren</a></li>
                     <li><a href="#A2">Anmelden</a></li> -->
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
                    <a href="delete_records.php">Bewerbungen löschen</a>
                    <a href="stelle_suchen.php">Stelle suchen</a>
                </div>
            </li>
        </ul>
    <center><h1> U succesfully entered a protected domain</h1></center>
    <h2> Dieser Bereich wurde erst nach erfolgreicher Verifizierung Ihrer Logindaten zugänglich...</h2>
    <?php
    echo "<p>Ihr Benutzername lautet: " . $_SESSION['username'] . "<br>";
    ?>
    <p> Nach Betätigen des 'Generieren'-Buttons wird Ihre persönliche Basisdatenbank mit Entitäten,Attributen und drei Beispieltupeln angefordert.
        <font color="red">Hatten Sie bereits eine Datenbank erzeugt,so brauchen Sie den Button nicht zu betätigen.</font> Zudem sind alle weiteren Menupunkte aktiviert.Viel Spaß und v.a. Erfolg bei Ihren Bewerbungen!</p>
    <form id="backend" name="backend" action=<?= $_SERVER['PHP_SELF']; ?> method="post">    
        <input class="button2" type="submit" name='push' value="Generieren"><br><br>
    </form>
    <?php
    if (isset($_REQUEST['push']) && $_REQUEST['push'] == "Generieren") {
        //Generatecheck anhand einer Datei
        $file = $folder . 'generate' . '_' . $_SESSION['username'] . '.txt';
        if (!file_exists($file)) {
            fopen($file, 'wb');
            fclose($file);
            $boolGenerate = true;
        } else
            $boolGenerate = false;
        $databasetyp = "mysql";
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $user = 'root'; // DB-Parameter definieren...
            $pw = '';
            $hostname = "localhost";
        } else {
            $user = 'k158364_kipp'; // DB-Parameter definieren...
            $pw = '1918Rott$';
            $hostname = "mysql2efb.netcup.net";
        }
        try {
            $dbh = new PDO("$databasetyp:host=$hostname;charset=utf8", $user, $pw, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY)); // DB-Aufbau objektorientiert
            echo"<p class='center_1'>Eine MySQL-Datenbank wurde soeben ohne spezifischen Namen initialisiert...</p>";
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . " at line " . $e->getLine() . "<br>";
            die();
        }
        $sql_1 = 'SHOW DATABASES;';
        $treffer1 = $dbh->query($sql_1);
        foreach ($treffer1 as $array_) {
            $providerPrefix = 'k158364_';
            $name = strtolower($_SESSION['username']);
            $findMe = $providerPrefix . $name;
            if (in_array($findMe, $array_)) {
                $IstEnthalten = true;
                break;
            } else
                $IstEnthalten = false;
        }
        if (!$IstEnthalten) {
            //da der Hoster per Code keine Datenbankerstellung zulässt, wird die Sache via Mail gecancelt
            if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
                if ($boolGenerate) {
                    echo "<font color='red'><p>ABBRUCH !</font><p><p>Tabellen und Records der Datenbank: " . $providerPrefix . $_SESSION['username'] . " werden innerhalb 24 Stunden vom Entwickler dieser Anwendung ertellt. Loggen Sie sich morgen nochmals ein!</p>";
                    if (mailen($_SESSION['username'])) {
                        echo"<p>Obige Nachricht wurde an den Entwickler gemailt.</p>";
                    } else
                        echo'<p>Obige nachricht konnte nicht verschickt werden!';
                    die();
                }else {
                    echo "<font color='red'><p>ABBRUCH !</font><p><p>Tabellen und Bewerbungen der Datenbank: " . $providerPrefix . $_SESSION['username'] . " wurden bereits erstellt und können über obiges Menu abgerufen werden!</p>";
                    die();
                }
            }
            //Linux ENDE
            $providerPrefix = 'k158364_';
            $databaseName = $providerPrefix . $_SESSION['username'];
            $sql_2 = "CREATE DATABASE IF NOT EXISTS " . $databaseName . "";
            if ($boolGenerate) {
                $treffer2 = $dbh->query($sql_2);
                $dbh = NULL; // Datenbank schliessen
                try {
                    $dbh = new PDO("$databasetyp:host=$hostname;dbname=$databaseName;charset=utf8", $user, $pw, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY)); // DB-Aufbau objektorientiert
                    echo"<p class='center_1'>Ihre MySQL-Datenbank mit der Bezeichnung: " . $providerPrefix . $_SESSION['username'] . " wurde soeben initialisiert...</p>";
                } catch (PDOException $e) {
                    print_r("Error!:" . $e->getMessage());
                    exit();
                }
                $sql_3 = "  CREATE TABLE IF NOT EXISTS rechtsform(id_recht INT AUTO_INCREMENT,art VARCHAR (20) NOT NULL,PRIMARY KEY(id_recht));
                        CREATE TABLE IF NOT EXISTS nachricht(id_message INT AUTO_INCREMENT,notiz VARCHAR(25) NOT NULL,PRIMARY KEY(id_message));
			CREATE TABLE IF NOT EXISTS bewerbungen(bew_id INT AUTO_INCREMENT,datum DATE NOT NULL,firma VARCHAR(100) NOT NULL,rechtsart INT,stadt VARCHAR(100) NOT NULL,plz INT NOT NULL,strasse_nr VARCHAR(100),ansprech_person VARCHAR(100),email VARCHAR(50) NOT NULL,feedback INT,bemerkung VARCHAR(150),PRIMARY KEY (bew_id),FOREIGN KEY (feedback) REFERENCES nachricht(id_message),FOREIGN KEY (rechtsart) REFERENCES rechtsform(id_recht));
					
			INSERT INTO rechtsform (art) VALUES('Einzelunternehmen'),('GbR'),('GmbH & Co.KG'),('KG'),('OHG'),('AG'),('GmbH'),('eG'),('KGaA'),('Stiftung');
			INSERT INTO nachricht(notiz) VALUES('Ja'),('Nein'),('steht noch aus');
			INSERT INTO bewerbungen (datum,firma,rechtsart,stadt,plz,strasse_nr,ansprech_person,email,feedback,bemerkung) VALUES
			('2010-11-26', 'Microsoft', 1, 'Dallas', 31067, 'Musterweg 7', 'Herr Dr. Klaus Barenthin', 'microsoft@spezial.com', 3, 'wird wohl eine Absage'),
			('2014-05-04', 'Apple', 7, 'Silicon Valley', 81929, 'Osterplatz 13', 'Herr Daniel Klenke', 'apple@univativ.de', 1, 'zu weit weg'),
			('2017-02-01', 'Google', 6, 'Berlin', 64293, 'Lilienweg 28', 'Herr Sarapata', 'goolge@google.com', 2, 'Vorstellungsgespräch');
					
			ALTER TABLE rechtsform ADD UNIQUE(art);
			ALTER TABLE nachricht ADD UNIQUE(notiz);

                        CREATE TABLE IF NOT EXISTS `l_jobboersen` (id INT AUTO_INCREMENT,name VARCHAR(255) DEFAULT NULL,homepage VARCHAR(255) DEFAULT NULL,ergebnis_seite TEXT,fachrichtung VARCHAR(255) DEFAULT NULL,PRIMARY KEY(id));
            
                        INSERT INTO l_jobboersen (id, name, homepage, ergebnis_seite, fachrichtung) VALUES
                        (1, 'Indeed', 'http://de.indeed.com', 'http://de.indeed.com/Jobs?q=###&l=&&&', 'Assistenz'),
                        (2, 'Stepstone', 'https://www.stepstone.de', 'https://www.stepstone.de/5/ergebnisliste.html?stf=freeText&ns=1&qs=[{%22type%22%3A%22jd%22%2C%22description%22%3A%22###%22%2C%22id%22%3A-3184}%2C{%22type%22%3A%22geocity%22%2C%22description%22%3A%22&&&%22%2C%22id%22%3A-84462}]&selectString=&widgetID=0&cityID=0&longitude=0&latitude=0&basicRadius=0&selectStringWhat=&sourceOfTheSearchField=front&whereRadius=0&ke=###&ws=&&&', 'Alle Fachrichtungen'),
                        (3, 'Xing Jobbörse', 'http://https://www.jobbörse.com', 'https://www.jobbörse.com/?action=stellenangebote-jobs&j=###&s=&&&&country=', 'IT, Vertrieb, Rechnungswesen, Ingenierwesen'),
                        (4, 'Monster.de', 'http://jobsuche.monster.de', 'http://jobsuche.monster.de/Jobs/?q=###&where=&&&&intcid=HP_HeroSearch', 'Alle Fachrichtungen'),
                        (5, 'Job Scout 24', 'http://www.jobs.de', 'http://www.jobs.de/jobs_ergebnisliste.html?exCrit=st%3da%3buse%3dALL%3brawWords%3d###%3bTID%3d0%3bCTY%3d&&&%3bCID%3dDE%3bLOCCID%3dDE%3bENR%3dNO%3bDTP%3dDRNS%3bYDI%3dYES%3bIND%3dALL%3bPDQ%3dAll%3bPDQ%3dAll%3bPAYL%3d0%3bPAYH%3dgt120%3bPOY%3dNO%3bETD%3dALL%3bRE%3dALL%3bMGT%3dDC%3bSUP%3dDC%3bFRE%3d30%3bCHL%3dIL%3bQS%3dsid_unknown%3bSS%3dNO%3bTITL%3d0%3bRAD%3d25%3bJQT%3dRAD%3bJDV%3dFalse%3bSITEENT%3dJSJ%3bMaxLowExp%3d-1%3bRecsPerPage%3d25&sc_cmp1=JS_JS_QSB_GEN&IPath=QH', 'Alle Fachrichtungen'),
                        (6, 'Stellenanzeigen.de', 'http://www.stellenanzeigen.de', 'http://www.stellenanzeigen.de/suche/?voll=###&plz=&&&', 'Alle Fachrichtungen'),
                        (7, 'Meinestadt.de', 'http://jobs.meinestadt.de', 'http://jobs.meinestadt.de/&&&/suche?words=###', 'Alle Fachrichtungen'),
                        (8, 'Careerjet', 'http://www.careerjet.de', 'http://www.careerjet.de/suchen/stellenangebote?s=###&l=&&&', 'Alle Fachrichtungen'),
                        (9, 'Jobrobot', 'http://www.jobrobot.de', 'http://www.jobrobot.de/content_0400_jobsuche.htm?cmd=res&keywords=###&umkreissuche_ort=&&&&umkreissuche_entfernung=40&useindex=0&keine_praktika=ja&zeitraum=all', 'Alle Fachrichtungen'),
                        (10, 'Jobrapido', 'http://de.jobrapido.com', 'http://de.jobrapido.com/?w=###&l=&&&&r=auto', 'Alle Fachrichtungen'),
                        (11, 'IT-Treff', 'https://www.it-treff.de/', 'https://www.it-treff.de/search/it-jobs-stellenangebote/?se=###&v=1,10,0,&&&,3', 'IT'),
                        (12, 'Absolventa', 'http://www.absolventa.de', 'http://www.absolventa.de/jobs/channel/it?utf8=%E2%9C%93&query[text]=###&query[city]=&&&&query[radius]=100&query[dep][]=10409&query[dep][]=10410&query[dep][]=10411&query[dep][]=10412&query[dep][]=10413&query[dep][]=10414&query[dep][]=10415&query[dep][]=10416&query[dep][]=10417&query[dep][]=3&query[dep][]=10418&query[dep][]=10430', 'IT (f?r Studenten, Absolventen) '),           
                        (13, 'ebay kleinanzeigen', 'http://www.ebay-kleinanzeigen.de', 'http://www.ebay-kleinanzeigen.de/s-jobs/&&&/###/k0c102l3155r30', 'Alle Fachrichtungen')";
                //Viele Wege führen nach Rom. Diesemal ohne die Methode query()
                $treffer3 = $dbh->prepare($sql_3);
                $treffer3->execute();
                if ($treffer1 != FALSE && $treffer2 != FALSE && $treffer3 != FALSE) {
                    echo "<p>Tabellen und Bewerbungen wurden in der Datenbank: " . $providerPrefix . $_SESSION['username'] . " erstellt und können ab jetzt über obiges Menu abgerufen werden!</p>";
                    $dbh = NULL;
                } else
                    echo "<font color='red'>Tabellen konnten nicht erstellt werden. Bitte kontaktieren Sie den Programmierer über die MessageBox!</font>";
            } else
                echo "<font color='red'><p>ABBRUCH !</font><p><p>Tabellen und Bewerbungen der Datenbank: " . $providerPrefix . $_SESSION['username'] . " wurden bereits erstellt und können über obiges Menu abgerufen werden!</p>";
        } else
            echo "<font color='red'><p>ABBRUCH !</font><p><p>Tabellen und Bewerbungen der Datenbank: " . $providerPrefix . $_SESSION['username'] . " wurden bereits erstellt und können über obiges Menu abgerufen werden!</p>";
    }
    ?>
</body>
</html>