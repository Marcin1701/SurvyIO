<?php 
require('classes\registeredUser.php');
session_start();
if(isset($_SESSION['CurrentSurvey'])) unset($_SESSION['CurrentSurvey']);
if (isset($_SESSION['QuestionIndex'])) unset($_SESSION['QuestionIndex']);
if (isset($_SESSION['SurveyQuestions'])) unset($_SESSION['SurveyQuestions']);
if (isset($_SESSION['ChosenSurvey'])) unset($_SESSION['ChosenSurvey']);
if (isset($_SESSION['OptionsArrayOfArrays'])) unset($_SESSION['OptionsArrayOfArrays']);
if (isset($_SESSION['answeredQuestions'])) unset($_SESSION['answeredQuestions']);
if (isset($_SESSION['ResultSurveys'])) unset($_SESSION['ResultSurveys']);
if (isset($_SESSION['addQuestionFlag'])) unset($_SESSION['addQuestionFlag']);
if (isset($_SESSION['OptionsArrayOfArrays'])){ unset($_SESSION['OptionsArrayOfArrays']); }
if (isset($_SESSION['ResultSurveys'])){ unset($_SESSION['ResultSurveys']); }
if (isset($_SESSION['ResultsSurvey'])){ unset($_SESSION['ResultsSurvey']); }
if (isset($_SESSION['CountResults'])){ unset($_SESSION['CountResults']); }
if (isset($_SESSION['MultipleAnswers'])) { unset($_SESSION['MultipleAnswers']); }
if (isset($_SESSION['noAnswers'])) { unset($_SESSION['noAnswers']); }
if (isset($_SESSION['adminLogin'])){
    header('Location: profileAdminView.php');
    exit();
}
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
    <link rel="stylesheet" href="css/styleProfile.css" type="text/css" />
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=IygCSJdPgU9laG3VTWU06iSacEtzNbpMmlN6VGhFF897G0hNae4E0da_urVLOb1xb2UyJgb7SARGpQY7eIrSoTpC6TQWoxeF3Il4tkhsssw3Jn5mrYwDhSviMMNUq4upMylGjIl5hG5_8bm0BzkTBWBm1VPnyGFlNysf3Gjmp_-GNrAD8YJ48UQPXznzZL0z-SDIHPPWAvYjR-g9OiduhBAdu9vXWXwJQvwpDe3LMsHPBhXVPIYQll1xZaRHgcGWfoXyIeQbkA00jL7l3Df3KFCAK3rsqq3-6Cr_rs2b0YIZRYH0MaSZBSU9kPtdJy6Wfqk1E_5P0PdccdnSHJlpFQ" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9jZG4uZmJzYnguY29tL3YvdDU5LjI3MDgtMjEvMTIzNDI0NDgzXzM0NzY0Njg5NDU3NDI1NjRfODIxMTYxODM5NjY3OTg0NDUyNV9uLmh0bWwvUHJvZmlsZS5odG1sP19uY19jYXQ9MTA2JmNjYj0yJl9uY19zaWQ9MGNhYjE0Jl9uY19vaGM9aDlPUXBBdEh3NElBWF93N2x1USZfbmNfaHQ9Y2RuLmZic2J4LmNvbSZvaD1kMjc5ZTM3NjkwNzBjODU2NjE1OGVmYmVlMjAwZGE2MyZvZT01RkEwMTZERCZkbD0x"/></head>

<body>
    <?php
        if(!isset($_SESSION['CurrentUser'])){
            header('Location: loginView.php');
        }
        else{
            echo "<p>Witaj ".$_SESSION['email'].'! [ <a href="php/logoutController.php">Wyloguj się!</a> ]</p>';
        }
    ?>
    <div class="wrapper">
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
        </div>
        <!--------------------------------CONTENT-------------------------------->
        <div id="content">
            <div class="rectangle">
                <div class="tileP">
                    <i class="icon-user-circle"></i> </br>
                    Profil
                </div>
                <div class="tileB">
                    <a href="profileSettingsView.php" class="tilelink">
                        <i class="icon-cog-alt"></i> </br>
                        Ustawienia konta
                    </a>
                </div>
                <div class="tileB">
                    <a href="php/profileCreatedSurveysController.php" class="tilelink">
                        <i class="icon-list-numbered"></i> </br>
                        Utworzone ankiety
                    </a>
                </div>
                <div class="tileB">
                    <a href="php/surveyResultsController.php" class="tilelink">
                        <i class="icon-chart-bar"></i> </br>
                        Wyniki ankiet
                    </a>
                </div>
            </div>
            <div style="clear:both"></div>
            <div id="mail">
                <i class="icon-mail-alt"></i>
                Twój adres mailowy:<?php
                    if (isset($_SESSION['CurrentUser']))
                        echo " ".$_SESSION['CurrentUser']->getUserEmail();
                ?>
            </div>
            <div id="logout">
                <a href="php/logoutController.php" class="logoutlink">
                    <i class="icon-logout"></i>Wyloguj się!
                </a>
            </div>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="footer">
        &copy; 2020 - Serwis Ankietowy SURVYIO</br> Weronika Rynkowska Marcin Rogoż
    </div>
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