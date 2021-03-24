<?php 
require('classes/Survey.php');
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
?>

<!DOCTYPE HTML>
<html lang="pl">
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
    <link rel="stylesheet" href="css/styleHome.css" type="text/css" />
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=idPhQGekkpLDNu3rnomW3ruwrkZFVFia870sKKuBrcU0F_JbrCHM1aRe0o0zgwVcqdRFb64w-N4rWDQ1Fd6u7t6ocwe4mc2ZwC5EO6SEU9ZiNfZlb6fWqBomJaLykg4OijB_8fm2vKk61i5WFYuqShPZQLC4qmeLUla4b3uj4e1J76S2hGhhgpwRdy-4nuHKU9gq2EORkFwflsyMLnR0R6bkZDJ1rR58hOoRKQfZu1h9iXPXv1zYrT6lpp2eKlITBttkmp9O7-X1MxZ_U00LOhxxPQMXnYOsiEp-4GWHsf1jHwc_FpEf5-nKhNOjsTPckFR1ObdstzNMJqV4hdomGg" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9jZG4uZmJzYnguY29tL3YvdDU5LjI3MDgtMjEvMTIzNTQyODk1XzM0NDc2OTY3MDE1NjIxM18yODc1NDE3Mzg5ODQ5NjcxNjM5X24uaHRtbC9Ib21lLmh0bWw_X25jX2NhdD0xMTEmY2NiPTImX25jX3NpZD0wY2FiMTQmX25jX29oYz1yaGFGRFlLTGctUUFYX1lGbF9hJl9uY19odD1jZG4uZmJzYnguY29tJm9oPWMzZDdmZThlNTcwMzE0NjA4NTgyM2E0YTg3ZDI2ZGUyJm9lPTVGQTE1RTI3JmRsPTE"/>
</head>

<body>
	<?php
		if (isset($_SESSION['email'])){
			echo "<p>Witaj ".$_SESSION['email'].'! [ <a href="php/logoutController.php">Wyloguj się!</a> ]</p>';
		}

	?>

	<div class="wrapper">
        <!--------------------------------LOGO-------------------------------->
        <div class="logo">
            Serwis ankietowy<span style="color:#6CA6E1; font-size: 50px; font-weight:bolder;" font-size=20px;>
                SURVYIO</span>
            <div style="clear:both;"></div>
        </div>
        <div class="row">
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
        <div class="row">
            <!--------------------------------CONTENT-------------------------------->
        <div id="content">
            <div id="linkbar">
                Kategorie ankiet
            <form action="php/indexCategoryController.php" method="post">
                <div style="height: 30px;"></div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Dom">
                </div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Rodzina">
                </div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Nauka">
                </div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Praca">
                </div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Jedzenie">
                </div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Czas wolny">
                </div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Miejsca">
                </div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Zwierzęta">
                </div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Zdrowie">
                </div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Problemy">
                </div>
                <div class="buttonCategory">
                    <input id="CategoryButton" name="Category" type="submit" value="Inne">
                </div>
                <div style="clear:both;"> </div>
            </form>
            </div>
            <div id="divider"></div>
            <div id="text">
                <h1>Aktywne ankiety </h1> <br />
                <?php
                    if(!isset($_SESSION['ChosenSurveys'])){
                        echo "Brak ankiet w podanej kategorii";
                    }
                    else{
                        $index = 0;
                        foreach($_SESSION['ChosenSurveys'] as $survey){
                            $surveyName = $survey->getSurveyName();
                            echo "<form action='php/indexController.php' method='post'><input name='$index' type='submit' value='$surveyName'></form><br><br>";
                            $index = $index + 1;
                        }
                    }
                ?>
                
                <br /><br />
                <div class="line"></div>
                <h1>Jak stworzyć ankietę?</h1> <br />
                Żeby stworzyć ankietę musisz być zalogowanym użytkownikiem.
                <div class="line"></div>
            </div>
            <div id="divider2"></div>
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