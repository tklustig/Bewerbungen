<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registrieren</title>
        <script src="js/jquery-1.7.1.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="css/base.css" type="text/css" media="screen" charset="utf-8"/>
        <link rel="stylesheet" href="css/form.css" type="text/css" media="screen" charset="utf-8"/>
    </head>
    <body id="go">
        <main>
            <output id="zeit"></output><br><br>
            <output id="schritte"></output>
        </main>
    <center><h2>Registrierung</h2></center>
    <p> Geben Sie bitte Ihre Registrierungsdaten ein</p>
    <script>
        $(document).ready(function () {
            $('#signup form').validate({
                rules: {
                    username: {
                        required: true
                    },
                    passwort: {
                        minlength: 8,
                        required: true
                    },
                    passconf: {
                        equalTo: "#password",
                        required: true
                    }
                },
                success: function (label) {
                    label.text('OK!').addClass('valid');
                }
            });
        });
    </script>
    <div id="signup">
        <form action="write_password.php" method="post">
            <div id="container">
                <div id="content">
                    <h2>Sign up</h2>
                    <div>
                        <label for="name">Name:</label>
                        <input name="username" id="name" type="text"/>
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input name="passwort" id="password" type="password" />
                    </div>
                    <div>
                        <label for="passconf">Confirm Password:</label>
                        <input name="passconf" id="passconf" type="password" />
                    </div>
                    <div>
                        <input class="button2" type="submit" name="push" value="Registrieren">
                    </div>
                </div>  
                <p> Bitte vergessen Sie den Benutzernamen bzw. dass Passwort nicht<br> Eine Wiederherstellung ist (noch) nicht implementiert</p>
                <a href="index.php">zurück</a>
            </div>
        </form>
    </div>
</body>
</html>
