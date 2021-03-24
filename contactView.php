<?php
// Czyszczenie zmiennych sesyjnych
session_start();
if(isset($_SESSION['CurrentSurvey'])) unset($_SESSION['CurrentSurvey']);
if(isset($_SESSION['QuestionIndex'])) unset($_SESSION['QuestionIndex']);
if (isset($_SESSION['SurveyQuestions'])) unset($_SESSION['SurveyQuestions']);
if (isset($_SESSION['ChosenSurvey'])) unset($_SESSION['ChosenSurvey']);
if (isset($_SESSION['OptionsArrayOfArrays'])) unset($_SESSION['OptionsArrayOfArrays']);
if (isset($_SESSION['answeredQuestions'])) unset($_SESSION['answeredQuestions']);
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
    <link rel="stylesheet" href="css/styleContact.css" type="text/css" />
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
            <li><a href="loginView.php">Logowanie</a></li>
            <li><a href="profileView.php">Profil</a></li>
            <li><a href="surveyCreatorView.php">Kreator ankiet</a></li>
            <li><a href="contactView.php">Kontakt</a></li>
            </o>
        </ol>
    </div>
    <!--------------------------------CONTENT-------------------------------->
    <div id="content">
        <div id="members">
            <div class="mails">
                Marcin Rogoż: marcin.rogoz1@outlook.com
            </div>
        </div>
    </div>
    <div class="socialMedia">
        <div class="socials">
            <div class="fb">
                <a href="https://www.facebook.com/" target="_blank" class="smlink"><i class="icon-facebook"></i>
                </a>
            </div>
            <div class="insta">
                <a href="https://www.instagram.com/" target="_blank" class="smlink"><i class="icon-instagram"></i>
                </a>
            </div>
            <div class="yt">
                <a href="https://www.youtube.com" target="_blank" class="smlink"><i class="icon-youtube-play"></i>
                </a>
            </div>
            <div class="snap">
                <a href="https://www.snapchat.com/" target="_blank" class="smlink"><i class="icon-snapchat-ghost"></i>
                </a>
            </div>

        </div>
    </div>
    <div style="clear:both"></div>
    <!--------------------------------FOOTER-------------------------------->
    <div class="footer">
        &copy; 2020 - Serwis Ankietowy SURVYIO</br> Weronika Rynkowska Marcin Rogoż
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