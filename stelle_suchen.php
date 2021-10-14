<?php
//error_reporting(1); //unterdrückt Warnungen;erst im Produktivbetrieb einsetzen!
session_start();
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Stelle suchen</title>
        <script src="js/menus.js"></script>
        <script src="js/datetime.js"></script>
        <script src="js/jquery-1.7.1.min.js"></script>
        <script src="js/jquery-ui-1.8.17.custom.min.js"></script>
        <link rel="stylesheet" href="css/jquery-ui-1.8.17.custom.css">
        <link rel="stylesheet" href="css/style_0.css" rel="stylesheet">
    </head>
    <body>
        <div class="mainDiv">
            <div id="uhr" class="borderLeft"></div>
        </div>
        <?php
        if (!empty($_REQUEST["search0"])) { //Submittbutton gedrückt=>Request abgefeuert
            if (isset($_REQUEST['chkb1']) && $_REQUEST['chkb1'] != -1)  //Checkbox(Indeed) aktiviert
                $indeedHasBeenChosen = true;
            else if (isset($_REQUEST['chkb1']))  //Checkbox(Indeed) nicht aktiviert
                $indeedHasBeenChosen = false;
            if (isset($_REQUEST['chkb2']) && $_REQUEST['chkb2'] != -1)
                $stepStoneHasBeenChosen = true;
            else if (isset($_REQUEST['chkb2']))
                $stepStoneHasBeenChosen = false;
            if (isset($_REQUEST['chkb3']) && $_REQUEST['chkb3'] != -1)
                $monsterHasBeenChosen = true;
            else if (isset($_REQUEST['chkb3']))
                $monsterHasBeenChosen = false;
            if (isset($_REQUEST['chkb4']) && $_REQUEST['chkb4'] != -1)  //Checkbox(Job Scout 24) aktiviert
                $meineStadtHasBeenChosen = true;
            else if (isset($_REQUEST['chkb4']))  //Checkbox(Job Scout 24) nicht aktiviert
                $meineStadtHasBeenChosen = false;
            if (!$indeedHasBeenChosen && !$stepStoneHasBeenChosen && !$monsterHasBeenChosen && !$meineStadtHasBeenChosen) {
                echo"<p><font color='red'>Bitte mindestens eine der Checkboxen aktivieren.</p></font>";
            }
            /* var_dump($indeedHasBeenChosen);
              var_dump($stepStoneHasBeenChosen);
              var_dump($monsterHasBeenChosen);
              var_dump($jobScoutHasBeenChosen); */
            if (!empty($_REQUEST['anfang0']) && !empty($_REQUEST['anfang1'])) {
                include_once 'inc/verbinden.php'; //mit der Datenbank verbinde
                $job = $_REQUEST['anfang1'];
                $place = $_REQUEST['anfang0'];
                if ($indeedHasBeenChosen) {
                    // $css = 'borderLink';
                    $sql = 'SELECT ergebnis_seite,name FROM l_jobboersen WHERE id=1';
                    $treffer = $dbh->query($sql);
                    foreach ($treffer as $item) {
                        $string2BeReplaced = $item[0];
                        $name = $item[1];
                        break;
                    }
                    $link2BeShown = createLink($name, $string2BeReplaced, $job, $place);
                    echo $link2BeShown;
                }
                if ($stepStoneHasBeenChosen) {
                    $sql = 'SELECT ergebnis_seite,name FROM l_jobboersen WHERE id=2';
                    $treffer = $dbh->query($sql);
                    foreach ($treffer as $item) {
                        $string2BeReplaced = $item[0];
                        $name = $item[1];
                        break;
                    }
                    $link2BeShown = createLink($name, $string2BeReplaced, $job, $place);
                    echo $link2BeShown;
                }
                if ($monsterHasBeenChosen) {
                    $sql = 'SELECT ergebnis_seite,name FROM l_jobboersen WHERE id=4';
                    $treffer = $dbh->query($sql);
                    foreach ($treffer as $item) {
                        $string2BeReplaced = $item[0];
                        $name = $item[1];
                        break;
                    }
                    $link2BeShown = createLink($name, $string2BeReplaced, $job, $place);
                    echo $link2BeShown;
                }
                if ($meineStadtHasBeenChosen) {
                    $sql = 'SELECT ergebnis_seite,name FROM l_jobboersen WHERE id=7';
                    $treffer = $dbh->query($sql);
                    foreach ($treffer as $item) {
                        $string2BeReplaced = $item[0];
                        $name = $item[1];
                        break;
                    }
                    $link2BeShown = createLink($name, $string2BeReplaced, $job, $place);
                    echo $link2BeShown;
                }
            } else {
                echo"<p><font color='red'>Bitte alle Felder ausfüllen.</p></font>";
            }
        }
        ?>
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
                    <a href="delete_records.php">Bewerbungen löschen</a>
                    <a href="stelle_suchen.php">Stelle suchen</a>
                </div>
            </li>
        </ul>
        <script>
            $(document).ready(function () {
                var cities = ['Aachen', 'Augsburg',
                    'Bückeburg', 'Bergisch Gladbach', 'Berlin', 'Bielefeld', 'Bochum', 'Bonn', 'Botrop', 'Braunschweig', 'Bremen', 'Bremerhaven', 'Böblingen',
                    'Chemnitz', 'Cottbus',
                    'Darmstadt', 'Dortmund', 'Dresden', 'Duisburg', 'Düsseldorf',
                    'Erfurt', 'Erlangen', 'Essen',
                    'Frankfurt(Main)', 'Frankfurt(Oder)', 'Freiburg', 'Fürth',
                    'Gelsenkirchen', 'Göttingen',
                    'Hannover', 'Hagen', 'Halle', 'Hamburg', 'Hamm', 'Heidelberg', 'Heibronn', 'Herne', 'Hildesheim', 'Heilbronn',
                    'Ingolstadt',
                    'Jena',
                    'Karlsruhe', 'Kassel', 'Kiel', 'Koblenz', 'Köln', 'Krefeld',
                    'Laatzen', 'Leipzig', 'Lehrte', 'Leverkusen', 'Lübeck', 'Ludwigshafen',
                    'München', 'Magdeburg', 'Mainz', 'Mannheim', 'Moers', 'Mönchen Gladbach', 'Mühlheim', 'Münster',
                    'Neuss', 'Nürnberg', 'Neustadt',
                    'Oberhausen', 'Offenbach', 'Oldenburg', 'Osnarbrück',
                    'Paderborn', 'Potsdam', 'Pforzheim',
                    'Recklinghausen', 'Regensburg', 'Remscheid', 'Reutlingen', 'Rostock',
                    'Sindelfingen', 'Saarbrücken', 'Salzgitter', 'Siegen', 'Solingen', 'Stuttgart',
                    'Tübingen', 'Trier',
                    'Ulm',
                    'Würzburg', 'Wiesbaden', 'Wolfsburg', 'Wuppertal',
                    'Xanten',
                    'Yokohama',
                    'Zuffenhausen'];
                $('#town').autocomplete({
                    source: cities
                });
            });
            $(document).ready(function () {
                var berufe = ['Altenpflegerin', 'Anlagenmechaniker', 'Artist', 'Augenoptiker', 'Automatenfachmann', 'Arztheferin',
                    'Bäcker', 'Bankkaufmann', 'Baustoffprüfer', 'Bauzeichner', 'Bergbautechnologe', 'Busfahrer', 'Bestattungsfachkraft', 'Betonbauer', 'Biologisch-technische Assistentin', 'Bodenleger', 'Bootsbauer', 'Buchbinder', 'Buchhändler',
                    'Chemielaborantin', 'Chemiker', 'Chemisch-technischer Assistent', 'Chirurgiemechaniker',
                    'Dachdecker', 'Designer', 'Destilateur', 'Diätassistentin', 'Dolmetscher', 'Drechsler', 'Drogist',
                    'Elektroanlagenmonteur', 'Elektroniker', 'Elektrotechnischer Assistent', 'Ergotherapeut', 'Erzieherin', 'Estrichleger', 'Elementarphysiker',
                    'Fachangestellter', 'Fachinformatiker Anwendungsentwicklung', 'Fachinformatiker Systemintegration', 'Fachlagerist', 'Fachlehrer', 'Fachmann', 'Fachpraktiker', 'Fachverkäufer', 'Fachunteroffizier', 'Fahrradmonteur', 'Feinoptiker', 'Fertigungsmechaniker', 'Fischwirt', 'Fleischer', 'Florist', 'Fliesenleger', 'Forstwirt', 'Fotograf', 'Fremdsprachenkorrespondentin', 'Friseur', 'Feuerwehrmann',
                    'Gärtner', 'Garten-und Landschaftsbauer', 'Gebäudereiniger', 'Geomatiker', 'Gerüstbauer', 'Gestalter', 'Gesundheitsfachkraft', 'Glaser', 'Gleisbauer', 'Goldschmied', 'Graveur',
                    'Hauswirtschafter', 'Hauswirtschaftslehrer', 'Hebamme', 'Heilpraktiker', 'Hochbaufacharbeiter', 'Holzmechaniker', 'Hotelfachmann', 'Hotelkaufmann',
                    'Immobilienkaufmann', 'Industrieelektirker', 'Industriekaufmann', 'Informatikkaufmann', 'Informationselektroniker', 'IT-System-Elektroniker', 'IT-System-Kaufamnn', 'Ingenieur',
                    'Justizfachangestellter', 'Justizwachtmeister', 'Jockey',
                    'Karosseriebearbeiter', 'Kaufmännischer Assistent', 'Kaufmann', 'Keramiker', 'Kindergärtnerin', 'Klempner', 'Koch', 'Konditor', 'Konstruktionsmechaniker', 'Kosmetikerin', 'Kraftfahrzeugmechatroniker', 'Kürschner',
                    'Landwirt', 'Lachszüchter', 'Landwirtschaftlicher Assistent', 'Lebensmitteltechnischer Assistent', 'Lehrer', 'Logopäde', 'Luftverkehrskaufmann',
                    'Maler -und Lackierer', 'Maschinen-und Anlagenführer', 'Maskenbildner', 'Masseur', 'Mathematisch-technischer Assistent', 'Maurer', 'Mechaniker', 'Mechatroniker', 'Medienassistent', 'Mediengestalter', 'Medienkaufmann', 'Medizinsch-technischer Assistent', 'Metallbauer', 'Musiker', 'Musiklehrer',
                    'Näher', 'Notar', 'Notfallsanitäter', 'Nageldesigner',
                    'Ofenbauer', 'Operationstechnischer Angestellter', 'Orgelbauer', 'Orthopäde', 'Onkologe',
                    'Papiertechnologe', 'Parkettleger', 'Pferdewirtin', 'Pharmakant', 'PHP-Entwickler', 'Pharmazist', 'Physikalisch-technischer Assitent', 'Physiotherapeut', 'Podologe', 'Polizist', 'Polsterer', 'Produktionsfachkraft', 'Produktionsprüfer', 'Programmierer', 'Polier',
                    'Quallenforscher',
                    'Raumaustatter', 'Rechtsanwalt', 'Rechtsanwaltsgehilfe', 'Restaurantfachmann', 'Revierjäger', 'Rettungssanitäter',
                    'Sänger', 'Sattler', 'Schauspieler', 'Schifffahrtskaufmann', 'Schornsteinfeger', 'Schuhmacher', 'Schweißer', 'Sekretär', 'Servicefachkraft', 'Servicekaufmann', 'Schmied', 'Sozialassistentin', 'Sozialpädagoge', 'Spielzeughersteller', 'Sportasssitent', 'Sportlehrer', 'Steinmetz', 'Steuerfachangestellter', 'Straßenbauer', 'Stukkateur', 'Systemelektroniker', 'Schulleiter',
                    'Tankwart', 'Technischer Assitent', 'Telefonistin', 'Textilkaufmann', 'Textilgestalter', 'Textillaborantin', 'Tiefbaufacharbeiter', 'Textilreiniger', 'Tiermedizinischer Fachanagestellter', 'Tierazt', 'Tierpfleger', 'Tierwirt', 'Tischler', 'Tourismuskaufmann', 'Toristikassitent', 'Trockenbauer',
                    'Uhrmacher', 'Umweltschutztechnischer Assistent',
                    'Veranstaltungskaufmann', 'Verfahrensmechaniker', 'Verkehrsmnister', 'Verfahrenstechnolge', 'Vergolder', 'Verkäufer', 'Vermessungstechniker', 'Verkehrsflugzeugführer', 'Verwaltungsfachangestellter', 'Veterinär', 'Vorpolier',
                    'Wasserbauer', 'Weintechnologe', 'Werkgehilfe', 'Werkstoffprüfer', 'Werkzeugmechaniker', 'Winzer', 'Werkzeugmacher',
                    'Yii2','Yii2 Developer',
                    'Zahnarzt', 'Zahntechniker', 'Zahnmedizinischer Fachangestellter', 'Zerspannugsmechaniker', 'Zimmermann', 'Zimmerer', 'Zupfinstrumentenmacher', 'Zweiradmechaniker', 'Zweiradmechatroniker'
                ];
                $('#jobby').autocomplete({
                    source: berufe
                });
            });
        </script>
    <center><h1>Stelle suchen</h1></center><br>
    <p><i>Hier können Sie nach Eingabe der Stadt und Ihres Berufswunsches in diversen Jobportalen nach Jobs suchen.<p></i>
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
        <div id="box1" class="box1">
            <input class="button1" type="submit" name="search_reset" value="Reset">
            <label name="ort">Suche bereinigen</label>
        </div><br><br>
        <center>
            <input class="feld" type=text name="anfang0" id="town" placeholder="hier die Stadt eintragen" value="<?php if (!empty($_REQUEST['anfang0'])) echo $_REQUEST['anfang0']; ?>">
            <input class="feld" type=text name="anfang1" id="jobby" placeholder="hier den Job eintragen" value="<?php if (!empty($_REQUEST['anfang1'])) echo $_REQUEST['anfang1']; ?>">
            <input class="button" type="submit" name="search0" value="Suchen"><br><br>
        </center>
        <div class="box2">
            <input type="hidden" name="chkb1" value="-1"><input type="checkbox" name="chkb1" value="value1">Indeed<br>
            <input type="hidden" name="chkb2" value="-1"><input type="checkbox" name="chkb2" value="value2">Stepstone<br>
            <input type="hidden" name="chkb3" value="-1"><input type="checkbox" name="chkb3" value="value2">Monster.de<br>
            <input type="hidden" name="chkb4" value="-1"><input type="checkbox" name="chkb4" value="value2">MeineStadt.de
        </div>
    </form>
    <?php

    function createLink($name, $jobboerse, $replaceJob, $replaceTown, $css = 'borderLink') {
        $url = WebStringErsetzen($jobboerse, "###", $replaceJob);
        $url = WebStringErsetzen($url, "&&&", $replaceTown);
        $link = "<a class='$css' href='$url' target='_blank' title='Load $name' >$name laden</a>";
        return $link;
    }

    function WebStringErsetzen($str, $suchen, $ersetzen) {
        $string = str_replace($suchen, $ersetzen, $str);
        return $string;
    }
    ?>

</body>
</html>

