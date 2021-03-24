<?php 
session_start();
if(isset($_SESSION['CurrentSurvey'])) unset($_SESSION['CurrentSurvey']);
if (isset($_SESSION['QuestionIndex'])) unset($_SESSION['QuestionIndex']);
if (isset($_SESSION['SurveyQuestions'])) unset($_SESSION['SurveyQuestions']);
if (isset($_SESSION['NumberOfAnswersToBeGenerated'])) unset($_SESSION['NumberOfAnswersToBeGenerated']);
if(isset($_SESSION['NumberOfAnswersToBeGenerated'])) unset($_SESSION['NumberOfAnswersToBeGenerated']);
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
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> Serwis ankietowy SURVYIO </title>
    <meta name="description" content="Serwis do tworzenia i wypełniania ankiet" />
    <meta name="keywords" content="ankieta, badanie, survey, pytania" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Spartan" type="text/css" />
    <link href="css/fontello.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/style.css" media="all" type="text/css" />
    <link rel="stylesheet" href="css/styleCreator.css" media="all" type="text/css" />
    <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=B-tjS_kuNcBVNMVh64FpD5d8FrF45e_cpKWwz1NMuwOKxQtstjKSBEJX4RM-Ve9mzxVrxU18ahUr__-ZLEWRorY4eWm_VYUp6SnA4K1BG1CP--tJF_64ny5BmJWhqbIzPTeD4uPi5pmE34eaI5_gWJN8366YW4zfX6z800KrV9jzU8m65V6ylc0F4kNrmAynC2VNiR6hvpIoNfSXIrnDOvkOeazE1eoLcGe-sfcNNZZDKFrLb3B1TSC4XYnIPjabdm91TUQ1o29nM134uxfX7eP5cxfcv0Lei5M2GYSr6W4koe5cusdjnw6sIQoJ15gibSYVMslVnbKMDvnYG33VYg" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9jZG4uZmJzYnguY29tL3YvdDU5LjI3MDgtMjEvMTIzMjg5NTI3XzEwMzI0ODc4MjM4OTA1NDBfNjc2MTE4Nzg4OTI0NjkzNDEzMF9uLmh0bWwvQ3JlYXRvci5odG1sP19uY19jYXQ9MTA5JmNjYj0yJl9uY19zaWQ9MGNhYjE0Jl9uY19vaGM9T1cwZS1wcXg4MllBWDllYW0ydyZfbmNfaHQ9Y2RuLmZic2J4LmNvbSZvaD1kMWFlZmY3OWI1YmU1YjA1NWRiNDFhZmEwYTBiOTgzZiZvZT01RkEwNDcxMyZkbD0x"/><script src="CreatorJs.jsx"></script>
</head>

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
        <div class="logo">
            Serwis ankietowy<span style="color:#6CA6E1; font-size: 70px; font-weight:bolder;" font-size=20px;>
                SURVYIO</span>
            <div style="clear:both;"></div>
        </div>

        <div class="nav">
            <ol>
                <li><a href="index.php">Strona główna</a></li>
                <li><a href="registerView.php">Rejestracja</a></li>
                <li><a href="loginView.php">Logowanie</a></li>
                <li><a href="profileView.php">Profil</a></li>
                <li><a href="surveyCreatorView.php">Kreator ankiet</a></li>
                <li><a href="contactView.php">Kontakt</a></li>
            </ol>
        </div>
        <div id=pageTitle>
            Witaj w kreatorze ankiet!
        </div>
        <form action="php/surveyCreatorController.php" method="post">
            <div class="contentC">
                <!---------------------------NAZWA ANKIETY--------------------------->
                    <label for="surveyName">
                        Nazwa ankiety:
                    </label>
                    <input type="text" id="sName" name="sName" maxlength="100"
                    placeholder="Tu wpisz nazwę swojej ankiety" onfocus="this.placeholder=''"
                    onblur="this.placeholder='Tu wpisz nazwę swojej ankiety'">
                    <?php
                        if (isset($_SESSION['eSurveyName'])){
                            echo "<div style='color:red'>".$_SESSION['eSurveyName']."</div>";
                            unset($_SESSION['eSurveyName']);
                        }
                    ?>
                <!---------------------------KATEGORIA--------------------------->
                <label for="category">Kategoria ankiety:</label>
                <select id="category" name="category">
                    <option value="Dom" selected> Dom </option>
                    <option value="Rodzina"> Rodzina </option>
                    <option value="Nauka"> Nauka </option>
                    <option value="Praca"> Praca </option>
                    <option value="Jedzenie"> Jedzenie </option>
                    <option value="Czas wolny"> Czas wolny </option>
                    <option value="Miejsca"> Miejsca </option>
                    <option value="Zwierzęta"> Zwierzęta </option>
                    <option value="Zdrowie"> Zdrowie </option>
                    <option value="Problemy"> Problemy </option>
                    <option value="Inne"> Inne </option>
                </select>
                <br/>
                <!---------------------------DATA ZAKONCZENIA--------------------------->
                <label for="endDay">Data zakończenia ankiety:
                    <input type="date" name="eDay" required>
                </label>

                <!---------------------------KTO MOZE--------------------------->
                    <fieldset>
                        <legend>Kto może wypełniać ankietę?</legend>
                        <div class="opcja"><label><input type="radio" name="privacy" value="priv">
                                Tylko osoby posiadające link</label></div>
                        <div class="opcja"><label><input type="radio" name="privacy" value="publ">
                                Każdy użytkownik serwisu</label></div>
                        <?php
                            if (isset($_SESSION['ePrivacy'])){
                               echo "<div style='color:red'>".$_SESSION['ePrivacy']."</div>";
                               unset($_SESSION['ePrivacy']);
                            }
                        ?>
                    </fieldset>

                <!---------------------------PRZYCISKI--------------------------->
                <input id="addQuestionButton" type="submit" value="Dodaj pytanie"> <br>
                <input id="closeButton" type="button" value="Wyjdź z kreatora ankiet">
            </div>
        </form>
        <!---------------------------STOPKA--------------------------->
        <div class="footer">
            &copy; 2020 - Serwis Ankietowy SURVYIO</br>Weronika Rynkowska Marcin Rogoż
        </div>
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