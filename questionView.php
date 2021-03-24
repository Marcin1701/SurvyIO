<?php 
session_start() ;
if(isset($_SESSION['concatenatedStringMultipleChoices'])) unset($_SESSION['concatenatedStringMultipleChoices']);
if (isset($_SESSION['NumberOfAnswersToBeGenerated'])) unset($_SESSION['NumberOfAnswersToBeGenerated']);
if(isset($_SESSION['NumberOfAnswersToBeGenerated'])) unset($_SESSION['NumberOfAnswersToBeGenerated']);
if(isset($_SESSION['eSurveyName'])) unset($_SESSION['eSurveyName']);
if(isset($_SESSION['ePrivacy'])) unset($_SESSION['ePrivacy']);
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
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/styleQuestion.css" type="text/css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=3tuAl1G7gB5VgWPiG1-VgqRW8dxkgZTfs8_cUHEpqXnI5lTGPWx63bSfDqcpZnShErtUd8UmRaDFcKJegbDMKx_SNWGz8B53iw7j8aNTBZnqMfyMhbpS15cuEmQV_fyKD5aU4KTny738MMV94f6RJJCIYg0p6eDuDleOTJ3yH9hAyt818cN5snpcTnFhqI7dtG80ZTn68FBK-fpvv04ME33tnWFNQYOZgd18G-mqYnoC2yQZ0uEoobW-X_oPRE__f6lE1EeWQsfyLZ1Kk5cBSFrsBwEyvxSG5ZNd8RRaIbproiXftkHaJGKRQu1YBF6Z5bwD3KGY9o3du2jxyCIBrg" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9jZG4uZmJzYnguY29tL3YvdDU5LjI3MDgtMjEvMTIyNTA1NzU0XzY2MTQwNDEwMTIzMjk4OV8zMTYzOTkxMTQ1ODkwNzE3Mjg0X24uaHRtbC9RdWVzdGlvbi5odG1sP19uY19jYXQ9MTA5JmNjYj0yJl9uY19zaWQ9MGNhYjE0Jl9uY19vaGM9RzhZNmM4VUhEd2NBWDhRa0l6cSZfbmNfaHQ9Y2RuLmZic2J4LmNvbSZvaD05Y2IzYzVjNzdmN2UwNGYyZWQ5ZDQ3YjY1NDM3MGU4MyZvZT01RkExRjYzMyZkbD0x"/><script src="CreatorJs.jsx"></script>
    <script>
        function load(){
                document.getElementById("multipleChoiceQ").style.display = "none";
                document.getElementById("singleChoiceQ").style.display = "none";
                document.getElementById("textQ").style.display = "none";
                document.getElementById("rangeQ").style.display = "none";
        }

    </script>
</head>

<body onload = load()>
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
            Kreator ankiet - dodaj pytanie
        </div>
        <form action="php/questionController.php" method="post">
        <div class="contentQ">
            <!---------------------------TREŚĆ PYTANIA--------------------------->
            <div id="pytania">
                <label for="questionText">
                    Treść pytania:
                </label>
                <input type="text" id="questionText" name="qText" maxlength="100" placeholder="Tu wpisz treść pytania"
                    onfocus="this.placeholder=''" onblur="this.placeholder='Tu wpisz treść pytania'">
                <?php
                    if (isset($_SESSION['eQuestionText'])){
                        echo "<div style='color:red'>".$_SESSION['eQuestionText']."</div>";
                        unset($_SESSION['eQuestionText']);
                    }
                ?>
                    <!---------------------------RODZAJ PYTANIA--------------------------->
                
                <fieldset>
                    <div id="optionS">
                    <legend>Jaki to rodzaj pytania?</legend>
                    <div class="optionS"><label><input  type="radio" id="R1" name="questionType" value="R1" class="optionS">
                            Wielokrotnego wyboru</label></div>
                    <div class="optionS"><label><input id="R2" type="radio" name="questionType" value="R2" class="optionS">
                            Jednokrotnego wyboru</label></div>
                    <div class="optionS"><label><input id="R3" type="radio" name="questionType" value="R3" class="optionS">
                            Z odpowiedzią tekstową</label></div>
                    <div class="optionS"><label><input id="R4" type="radio" name="questionType" value="R4" class="optionS">
                            Z odpowiedzią typu zakres</label></div>
                    </div>
                    <?php
                        if (isset($_SESSION['eQuestionType'])){
                            echo "<div style='color:red'>".$_SESSION['eQuestionType']."</div>";
                            unset($_SESSION['eQuestionType']);
                        }
                    ?>
                </fieldset>

                <!---------------------------WIELOKROTNY WYBOR--------------------------->
                <div id="multipleChoiceQ">
                        <fieldset style = "margin-top: 10px">
                            Ile opcji odpowiedzi chcesz utworzyć? <input type="number" name="numberOfAnswersMultiple">
                    </fieldset>
                </div>
                <div id="singleChoiceQ">
                        <fieldset style = "margin-top: 10px">
                            Ile opcji odpowiedzi chcesz utworzyć? <input type="number" name="numberOfAnswersSingle">
                        </fieldset>
                </div>
                <div id="textQ">
                <!--
                        <fieldset style = "margin-top: 10px">
                            <input type="text" id="answerText3" name="aText" maxlength="100" placeholder="Tu użytkownik uzupełniający poda swoją odpowiedź"
                                onfocus="this.placeholder=''" onblur="this.placeholder='Tu użytkownik uzupełniający poda swoją odpowiedź'"></label>
                        </fieldset>
                -->
                </div>
                <div id="rangeQ">
                        <fieldset style = "margin-top: 10px">
                            <div>Podaj dolną wartość zakresu: <input type="number" name="rangeLow"> </div>
                            <div>Podaj górną wartość zakresu: <input type="number" name="rangeHigh"></div> 
                        </fieldset>
                </div>
            </div>
        
            <!---------------------------PRZYCISKI--------------------------->
            <div>
            <div>
            <input id="addQuestionButton" type="submit" value="Dodaj warianty lub pytanie">
            </div>
            <?php
                if (isset($_SESSION['QuestionIndex'])){
                    echo "<input id='finishButton' name='endSurveyCreation' type='submit' value='Zakończ i udostępnij '>";
                }
            ?>
            <input id="leaveCreator" name="leaveSurveyCreator" type="submit" value="Wyjdź z kreatora ankiet">
            </div>
        </form>
        </div>
        <!---------------------------STOPKA--------------------------->
        <div class="footer">
            &copy; 2020 - Serwis Ankietowy SURVYIO</br> Weronika Rynkowska Marcin Rogoż
        </div>
    </div>
    <style> .hidden { display: none; } </style>
    <script>
        var inputs = document.getElementsByClassName('optionS'),optionS;

        for (var i = 0; i < inputs.length; i++){
            var el = inputs[i];
            el.addEventListener('change', function() {
                defineSetting(this.value);
            })
        }

        function defineSetting(optionS){
            if (optionS == 'R1'){
                document.getElementById("multipleChoiceQ").style.display = "block";
                document.getElementById("singleChoiceQ").style.display = "none";
                document.getElementById("textQ").style.display = "none";
                document.getElementById("rangeQ").style.display = "none";
            }
            else if (optionS == 'R2'){
                document.getElementById("multipleChoiceQ").style.display = "none";
                document.getElementById("singleChoiceQ").style.display = "block";
                document.getElementById("textQ").style.display = "none";
                document.getElementById("rangeQ").style.display = "none";
            }
            else if (optionS == 'R3'){
                document.getElementById("multipleChoiceQ").style.display = "none";
                document.getElementById("singleChoiceQ").style.display = "none";
                document.getElementById("textQ").style.display = "block";
                document.getElementById("rangeQ").style.display = "none";
            }
            else if (optionS == 'R4'){
                document.getElementById("multipleChoiceQ").style.display = "none";
                document.getElementById("singleChoiceQ").style.display = "none";
                document.getElementById("textQ").style.display = "none";
                document.getElementById("rangeQ").style.display = "block";
            }
        }
    </script>
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