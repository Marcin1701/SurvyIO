<?php
if (isset($_SESSION['ResultSurveys'])) unset($_SESSION['ResultSurveys']);
if (isset($_SESSION['addQuestionFlag'])) unset($_SESSION['addQuestionFlag']);
if (isset($_SESSION['OptionsArrayOfArrays'])){ unset($_SESSION['OptionsArrayOfArrays']); }
if (isset($_SESSION['ResultSurveys'])){ unset($_SESSION['ResultSurveys']); }
if (isset($_SESSION['ResultsSurvey'])){ unset($_SESSION['ResultsSurvey']); }
if (isset($_SESSION['CountResults'])){ unset($_SESSION['CountResults']); }
if (isset($_SESSION['MultipleAnswers'])) { unset($_SESSION['MultipleAnswers']); }
if (isset($_SESSION['noAnswers'])) { unset($_SESSION['noAnswers']); }
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> Serwis ankietowy SURVYIO </title>
    <meta name="description" content="Serwis do tworzenia i wypełniania ankiet" />
    <meta name="keywords" content="ankieta, badanie, survey, pytania" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Spartan" type="text/css" />
    <link href="css/fontello.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/styleSettings.css" type="text/css" />
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=4e5gt-IDkghZ2839FQtNCxk0e55sxlTin8GO4KLXOAdTs1MrEg8nudGoXp-TBPdtpkBzYOuiUWBhPboF6TUgZwH5UuR9YeJbokUeQMSJ2hvCnUQG4e7lmPIGj89H_mqDwu4ycXhmuSzZNpI6obWsV6xiwpWn6qgvnU6ViS3o2WwOrXkVIxwzJoRcYOKGXcjjvRM5Lrc6i5aDgI1g0PkoyC5ucOiTxe_Mehwuw7ME4MBVCXjGMVFTyXo2Ir-Tq42S_Ksho9v5eipw_g-cD8m7gV4FFKI40WcXsx-Vkn330IM4Q27A0FbHM6Ar7bbQTe0scaNQwuYrmywkeRTYT9LCkg" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9jZG4uZmJzYnguY29tL3YvdDU5LjI3MDgtMjEvMTIyNTg5Mzc2XzY0NzMzMDY2MjYyNzA2M18xOTA5NjA3MDM4NjM5NzU2NjVfbi5odG1sL1NldHRpbmdzLmh0bWw_X25jX2NhdD0xMDUmY2NiPTImX25jX3NpZD0wY2FiMTQmX25jX29oYz12SENiRnVPVEhaa0FYX0pqSHRDJl9uY19odD1jZG4uZmJzYnguY29tJm9oPTA3MTRiYzRjODQxNWYxZmE3ZDZlZGY2OWQ2N2FkZmQ1Jm9lPTVGQTMyOTIzJmRsPTE"/></head>

<body>
	<?php
		if (isset($_SESSION['email'])){
			echo "<p>Witaj ".$_SESSION['email'].'! [ <a href="php/logoutController.php">Wyloguj się!</a> ]</p>';
		}

	?>
    <!--------------------------------LOGO-------------------------------->
    <div class="logo">
        Serwis ankietowy<span style="color:#6CA6E1; font-size: 70px; font-weight:bolder;">
            SURVYIO</span>
        <div style="clear:both;"></div>
    </div>

    <!--------------------------------NAVI-------------------------------->
    <div class="nav">
        <ol>
            <li><a href="index.php">Strona główna</a></li>
                    <li><a href="registerView.php">Rejestracja</a></li>
                    <li><a href="loginView.php">Logowanie</a>
					</li>
                    <li><a href="profileView.php">Profil</a></li>
                    <li><a href="surveyCreatorView.php">Kreator ankiet</a></li>
                    <li><a href="contactView.php">Kontakt</a></li>
            </o>
        </ol>
    </div>
    <div id="pageTitle">Ustawienia konta</div>
    <!--------------------------------CONTENT-------------------------------->
    <div class="content">
    <form action="php/profileSettingsController.php" method="post">
        <div class="set">
            <div class="settingTitle">Zmień hasło</div>
            <div>Nowe hasło:</div>
            <div><input type="password" id="changePassword" name="newPassword" maxlength="100"></div>
            <div>Powtórz nowe hasło:</div>
            <div><input type="password" id="changePassword2" name="newPassword2" maxlength="100"></div> <!-- musza byc takie same xd-->
            <div><input id="deleteAccount" type="submit" value="Potwierdź zmianę hasła"></div>
        </div>
        <div class="set">
            <div class="settingTitle">Zmień swój adres e-mail</div>
            <div>Nowy adres e-mail:</div>
            <div><input type="email" id="changeMail" name="newMail" maxlength="100"></div>
            <div>Powtórz nowy adres e-mail:</div>
            <div><input type="email" id="changeMail" name="newMail" maxlength="100"></div>
            <input id="changeMail" type="submit" value="Potwierdź zmianę e-mail">
        </div>
        </form>
        <form action="php/profileSettingsController.php" method="post">
        <div class="set">
            <div class="settingTitle">Usuń konto</div>
            <input id="deleteAccount" type="submit" value="Usuń swoje konto">
        </div>
        </form>
    </div>

    <!--------------------------------FOOTER-------------------------------->
    <div class="footer">
        &copy; 2020 - Serwis Ankietowy SURVYIO</br>Weronika Rynkowska Marcin Rogoż
    </div>

    <!--------------------------------SCRIPT-------------------------------->
    <script src="jquery-3.5.1.min.js"></script>
    <script>

        $(document).ready(function () {
            var NavY = $('.nav').offset().top;

            var stickyNav = function () {
                var ScrollY = $(window).scrollTop();

                if (ScrollY > NavY) {
                    $('.nav').addClass('sticky');
                } else {
                    $('.nav').removeClass('sticky');
                }
            };

            stickyNav();

            $(window).scroll(function () {
                stickyNav();
            });
        });

    </script>
</body>

</html>