<?php

function FormularAnzeigen($DesignForNewRecord, $Datum = NULL, $Firma = NULL, $Rechtsart = NULL, $Stadt = NULL, $Plz = NULL, $Strasse = NULL, $KontaktPerson = NULL, $Mail = NULL, $Feedback = NULL, $Bemerkung = NULL) {
    if ($DesignForNewRecord) {
        $begriff = 'hinzufügen';
        $zusatz = 'Füllen Sie die Pflichtfelder aus:';
    } else {
        $begriff = 'ändern';
        $zusatz = 'Ändern Sie Felder Ihrer Wahl:';
    }
    ?>
    <h3>Datensatz <?= $begriff ?> </h3>
    <?php
    if ($DesignForNewRecord) {
        ?>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <?php } else {
            ?>
            <form action="WriteUpdateIntoDatabase.php" method="post">
                <?php
            }
            ?>
            <label><?= $zusatz ?></label><br><br>
            <label>:Datum * </label>
            <input class="button1" type=text name="datum" id="date" value="<?php
            echo $Datum;
            ?>">
            <br><br>
            <label>:Firmenname *</label>
            <input class="button1" type=text name="firma" id="firma" value="<?php
            echo $Firma;
            ?>">
            <br><br>
            <label>:Rechtsart * </label>
            <input class="button1" type=number name="recht" id="recht" min=1 max=10 placeholder="Bitte die Tabellen-ID eingeben"  value="<?php
            echo $Rechtsart;
            ?>">
            <br><br>
            <label>:Stadt *</label>
            <input class="button1" type=text name="stadt" id="location" value="<?php
            echo $Stadt
            ?>">
            <br><br>
            <label>:Postleizahl *</label>
            <input class="button1" type=number name="plz" id="plz" min=01067 max=99998  value="<?php
            echo $Plz;
            ?>">
            <br><br>
            <label>:Strasse</label>
            <input class="button1" type=text name="strasse" id="strasse"  value="<?php
            echo $Strasse;
            ?>">
            <br><br>
            <label>:Ansprechperson</label>
            <input class="button1" name="bl" id="bl" value="<?php
            echo $KontaktPerson;
            ?>">
            <br><br>
            <label>:Email/Firma *</label>
            <input class="button1" type=email name="mail" id="mail"  value="<?php
            echo $Mail;
            ?>">
            <br><br>          
            <label>:feedback * </label>
            <input class="button1" type=number name="feed" id="feed" min=1 max=3 placeholder="Bitte die Tabellen-ID eingeben"  value="<?php
            echo $Feedback;
            ?>">
            <br><br>
            <label>:Bemerkungen</label>
            <input class="button1" name="bem" id="bem" value="<?php          
                echo $Bemerkung;
            ?>">
            <br><br>
            <p class='duty'> Die mit * markierten Felder sind Pfilchtfelder</p>
            <?php
            if ($DesignForNewRecord) {
                ?>
                <input class="button2" type="submit" name="push" id="push_1" value="Record nur speichern">
                <input class="button5" type="submit" name="push" id="push_2" value="Datensatz als Mail verschicken & speichern">
                <?php
            } else {
                ?>
                <input class="button2" type="submit" name="push" id="push_1" value="Record ändern">
                <?php
            }
            ?>          
        </form>
        <?php
    }
    ?>