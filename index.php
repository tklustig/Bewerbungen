<?php
session_start();
session_destroy();
//echo nl2br(print_r($_SESSION, true));
?>
<script>
// Set the number of snowflakes (more than 30 - 40 not recommended)
    var snowmax = 35
// Set the colors for the snow.
    var snowcolor = new Array("#FE2EC8", "#2E2EFE", "#2EFEF7", "#40FF00", "#FFFF00")
// Set the fonts, that create the snowflakes.
    var snowtype = new Array("Arial Black", "Arial Narrow", "Times", "Comic Sans MS")
// Set the letter that creates your snowflake
    var snowletter = "*";
// Set the speed of sinking (recommended values range from 0.3 to 2)
    var sinkspeed = 0.6;
// Set the maximal-size of  snowflaxes
    var snowmaxsize = 50;
// Set the minimal-size of  snowflaxes
    var snowminsize = 15;
// Set the snowing-zone
// Set 1 for all-over-snowing, set 2 for left-side-snowing
// Set 3 for center-snowing, set 4 for right-side-snowing
    var snowingzone = 1;

///////////////////////////////////////////////////////////////////////////
// CONFIGURATION ENDS HERE
///////////////////////////////////////////////////////////////////////////

    var snow = new Array();
    var marginbottom;
    var marginright;
    var timer;
    var i_snow = 0;
    var x_mv = new Array();
    var crds = new Array();
    var lftrght = new Array();
    var browserinfos = navigator.userAgent
    var ie5 = document.all && document.getElementById && !browserinfos.match(/Opera/);
    var ns6 = document.getElementById && !document.all;
    var opera = browserinfos.match(/Opera/);
    var browserok = ie5 || ns6 || opera;

    function randommaker(range) {
        rand = Math.floor(range * Math.random());
        return rand;
    }

    function initsnow() {
        if (ie5 || opera) {
            marginbottom = document.body.clientHeight;
            marginright = document.body.clientWidth;
        } else if (ns6) {
            marginbottom = window.innerHeight;
            marginright = window.innerWidth;
        }
        var snowsizerange = snowmaxsize - snowminsize;
        for (i = 0; i <= snowmax; i++) {
            crds[i] = 0;
            lftrght[i] = Math.random() * 15;
            x_mv[i] = 0.03 + Math.random() / 10;
            snow[i] = document.getElementById("s" + i)
            snow[i].style.fontFamily = snowtype[randommaker(snowtype.length)];
            snow[i].size = randommaker(snowsizerange) + snowminsize;
            snow[i].style.fontSize = snow[i].size;
            snow[i].style.color = snowcolor[randommaker(snowcolor.length)];
            snow[i].sink = sinkspeed * snow[i].size / 5;
            if (snowingzone == 1)
                snow[i].posx = randommaker(marginright - snow[i].size)

            if (snowingzone == 2)
                snow[i].posx = randommaker(marginright / 2 - snow[i].size)

            if (snowingzone == 3)
                snow[i].posx = randommaker(marginright / 2 - snow[i].size) + marginright / 4;

            if (snowingzone == 4)
                snow[i].posx = randommaker(marginright / 2 - snow[i].size) + marginright / 2;

            snow[i].posy = randommaker(2 * marginbottom - marginbottom - 2 * snow[i].size);
            snow[i].style.left = snow[i].posx;
            snow[i].style.top = snow[i].posy;
        }
        movesnow();
    }

    function movesnow() {
        for (i = 0; i <= snowmax; i++) {
            crds[i] += x_mv[i];
            snow[i].posy += snow[i].sink
            snow[i].style.left = snow[i].posx + lftrght[i] * Math.sin(crds[i]);
            snow[i].style.top = snow[i].posy;

            if (snow[i].posy >= marginbottom - 2 * snow[i].size || parseInt(snow[i].style.left) > (marginright - 3 * lftrght[i])) {
                if (snowingzone == 1)
                    snow[i].posx = randommaker(marginright - snow[i].size);

                if (snowingzone == 2)
                    snow[i].posx = randommaker(marginright / 2 - snow[i].size);

                if (snowingzone == 3)
                    snow[i].posx = randommaker(marginright / 2 - snow[i].size) + marginright / 4;
                if (snowingzone == 4)
                    snow[i].posx = randommaker(marginright / 2 - snow[i].size) + marginright / 2;
                snow[i].posy = 0
            }
        }
        var timer = setTimeout("movesnow()", 50);
    }
    for (i = 0; i <= snowmax; i++) {
        document.write("<span id='s" + i + "' style='position:absolute;top:-" + snowmaxsize + "'>" + snowletter + "</span>");
    }
    window.onload = initsnow(); //lädt die JS-Dateien während des Browseraufrufes
</script>
<!Doctype html> <!-- Definition des doctype-Modus -->
<html> <!-- Definition des Stammverzeichnises -->
    <head> <!-- Definition des Kopfbereiches -->
        <meta charset="utf-8"><!-- charset[utf-8:]  definiert den deutschen Zeichensatz -->
        <meta name="msvalidate.01" content="8B12875037645A4090EE64488042FDA9" /><!--validiert die Website für Bing und Yahoo-->
        <meta name="date" content="2017-02-3T08:49:37+02:00">		<!-- Angaben, wann die Seite publiziert wurde-->
        <meta name="keywords" content="Praktikum, Arbeitsplatz, Suche">	<!-- versorgt die Spider der Suchmaschinen mit Informationen zwecks Suchbegriffen -->
        <meta name="description" content="Die komfortable Praktikums -und Arbeitsplatzsuche im Web">	<!-- Beschreibung, die in den Suchmaschinen erscheinen soll. -->
        <meta name="robots" content="index,follow">			<!-- Links sollen mitindiziert werden //NOINDEX:Seite soll nicht aufgenommen werden//NOFOLLOW Links werden nicht verfolgt-->
        <meta name="audience" content="alle">				<!-- definiert die Zielgruppe der Website  -->
        <meta name="page-topic" content="Dienstleistung">		<!-- Zuordnungsdefinition für die Suchmaschine -->
        <meta name="revisit-after" CONTENT="7 days">			<!-- definiert den erneuten Besuch des Spiders//hier:nach sieben Tagen  -->
        <title lang="de">Praktikumsbewerbungen und Arbeitsplatzsuche</title> 	<!-- weist dem HTML-Dokument in der Registerkarte einen Namen zu -->
        <script src="https://code.jquery.com/jquery-latest.js"></script>
        <script src="js/menus.js"></script>
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body> <!-- Definition des Bodybereiches -->
        <img src="counter.php" title="Pic1" alt="Picture1">
        <audio id="sound" controls src="https://wiki.selfhtml.org/local/Europahymne.mp3" type="audio/mp3"></audio>    
        <img class="img1" src="img/praktikum.jpg" title="Pic1" alt="Picture1">
        <img class="img1" src="img/praktikum_1.jpg"  title="Pic3" alt="Picture3">
        <img class="img1" src="img/praktikum_2.jpg" title="Pic4" alt="Picture4">
        <div id="photos"><!-- Die CSS Anweisungen werden in der JS Funktion rotiere_pic() über den css Selektor implementiert -->
            <img alt="moi_1" src="img/moi_coloured.jpg">
            <img alt="moi_2" src="img/moi_coloured_large.jpg">
            <img alt="moi_3" src="img/moi_large_sw.jpg">
            <img alt="moi_4" src="img/moi_sw.jpg">
        </div>
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_0()">Home</a>
                <div class="dropdown-inhalt_0" id="auswahl_0">
                    <a href="info.php">PHP-Info</a>
                </div>
            </li>
            <li><a href="registrieren.php">Registrieren</a></li>
            <li><a href="anmelden.php">Anmelden</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_1()">Bewerbungen suchen</a>
                <div class="dropdown-inhalt_0" id="auswahl_1">
                    <a href="fallout.php">alle Bewerbungen anzeigen</a>
                    <a href="fallout.php">offene Bewerbungen anzeigen </a>
                    <a href="fallout.php">erledigte Bewerbungen anzeigen </a>
                    <a href="fallout.php">Bewerbungen nach Datum suchen</a>
                    <a href="fallout.php">Bewerbungen nach Ort suchen</a>
                    <a href="fallout.php">Bewerbungen nach Firma suchen</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="treffer_0" onclick="myFunction_2()">Adminbereich</a>
                <div class="dropdown-inhalt_0" id="auswahl_2">
                    <a href="fallout.php">Bewerbungen eingeben</a>
                    <a href="fallout.php">Bewerbungen löschen</a>
                    <a href="fallout.php">Stelle suchen</a>
                    <!--  <a href="#R3">Bewerbungen editieren</a>  -->
                </div>
            </li>
        </ul>
        <script>
            window.onload = function () {
                document.getElementById("impressum").onclick = impressum;
            };

            $(document).ready(function () {
                rotiere_pic(0);
            });

            function rotiere_pic(photo_aktuell) {
                var anzahl = $('#photos img').length;
                photo_aktuell = photo_aktuell % anzahl;

                $('#photos img').eq(photo_aktuell).fadeOut(function () {
                    $('#photos img').each(function (i) {
                        $(this).css(
                                'zIndex', ((anzahl - i) + photo_aktuell) % anzahl,
                                );
                    });
                    $(this).show();
                    setTimeout(function () {
                        rotiere_pic(++photo_aktuell);
                    }, 750);
                });
                $("#photos img").css({top: '70px', height: '120px', width: '120px'});
            }
            function impressum() {
                alert("Programmierer &  V.i.S.d.P: Thomas Kipp\nAnschrift:\nKlein - Buchholzer - Kirchweg 25\n30659 Hannover\n Mobil:0152/37389041");
            }
        </script>
        <h1> Projekt Praktikums /-Arbeitsplatzsuche </h1>
        <p> Auf dieser Webseite<font color="green">(optimiert für den Chrome-Browser)</font>, gehostet auf einem eigenen Webserver,können Sie Ihre
            Bewerbungen verwalten und per Mail an einen potentiellen Arbeitgeber verschicken.
            Die Webseite, und damit auch die Datenbank, wird komplett über das obige Menu bedient.<font color="red">Das Navigieren über die Browserpfeile sollte folglich vermieden werden!
            </font><br><br> Viel Erfolg wünscht Ihnen der Programmierer dieser Anwendung(s.Impressum)
            <button class="button4" type="button" name="impressum" id="impressum">Impressum anzeigen</button></p>
        <p> Über ein Feedback,Anregungen oder Kritik in der Messagebox wäre ich sehr erfreut!</p>
    <center><p><font color="black">Ihre Nachricht für die Messagebox</p>
        <form action= "senden.php" method="post">
            <textarea name="nachricht" cols=80 rows=5  placeholder="Hier bitte ggf. das feedback eintragen,welches als Mail an mich verschickt wird. Hierfür habe ich auf meinem Raspberry postfix konfiguriert!"></textarea><br><br>
            <center><input type="submit" class="button3" name="Button" value="Abschicken"></center>
        </form>
    </body>
</html>