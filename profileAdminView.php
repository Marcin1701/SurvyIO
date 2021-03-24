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
    <link rel="stylesheet" href="css/styleAdminProfile.css" type="text/css" />
</head>

<body>
    <?php   
    require('D:\OneDrive\Programowanie\PHP\XAMPP\htdocs\Serwis Ankietowy\classes\RegisteredUser.php');        
    session_start();
    if (isset($_SESSION['OptionsArrayOfArrays'])){ unset($_SESSION['OptionsArrayOfArrays']); }
    if (isset($_SESSION['ResultSurveys'])){ unset($_SESSION['ResultSurveys']); }
    if (isset($_SESSION['ResultsSurvey'])){ unset($_SESSION['ResultsSurvey']); }
    if (isset($_SESSION['CountResults'])){ unset($_SESSION['CountResults']); }
    if (isset($_SESSION['MultipleAnswers'])) { unset($_SESSION['MultipleAnswers']); }
    if (isset($_SESSION['noAnswers'])) { unset($_SESSION['noAnswers']); }
        if (isset($_SESSION['email'])){
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
            <o>
            </ol>
        </div>
    </div>
    <!--------------------------------CONTENT-------------------------------->
    <form action="php/profileAdminController.php" method="post">
    <div id="content">
        <div class="rectangle">
            <!--------------------------------USUWANIE UŻYTKOWNIKA-------------------------------->
            <div class="tileP">
                <i class="icon-user-times"></i> </br>
                Usuń użytkownika <br />
                <div style="clear:both">
                <input type="number" name="idUser" value="idUser">
                <input type="submit" name="deleteUser" id="userDelete" value="Usuń według Id" >
                </div>
                            <?php
                    if (isset($_SESSION['userDeleted'])){
                        echo $_SESSION['userDeleted'];
                        unset($_SESSION['userDeleted']);
                    }
            ?>
            </div>

            <!--------------------------------UKRYWANIE ANKIETY-------------------------------->
            <div class="tileP">
                <i class="icon-low-vision"></i> </br>
                Ukryj ankietę <br />
                <div style="clear:both">
                <input type="number" name="idSurvey" value="idSurvey"> 
                <input type="submit" name="hideSurvey" id="hideSurvey" value="Ukryj według Id" >
                </div> 
                            <?php
                    if (isset($_SESSION['surveyHidden'])){
                        echo $_SESSION['surveyHidden'];
                        unset($_SESSION['surveyHidden']);
                    }
            ?>
            </div>

            <!--------------------------------UTWORZONE ANKIETY-------------------------------->
            <div class="tileB">
                <a href="" class="tilelink">
                    <i class="icon-list-numbered"></i> </br>
                    Utworzone ankiety
                </a>
            </div>
            <!--------------------------------WYNIKI ANKIET-------------------------------->
            <div class="tileB">
                <a href="" class="tilelink">
                    <i class="icon-chart-bar"></i> </br>
                    Wyniki ankiet
                </a>
            </div>
        </div>
        <div style="clear:both"></div>
    </form>
        <!--------------------------------MAIL UŻYTKOWNIKA-------------------------------->
        <div id="mail">
                <i class="icon-mail-alt"></i>
                Twój adres mailowy:
                <?php
                    if (isset($_SESSION['CurrentUser']))
                        echo " ".$_SESSION['CurrentUser']->getUserEmail();
                ?>
        </div>

        <!--------------------------------WYLOGOWANIE-------------------------------->
        <div id="logout">
            <a href="php/logoutController.php" class="logoutlink">
                <i class="icon-logout"></i>
                Wyloguj mnie
            </a>
        </div>
    </div>

    <!--------------------------------STOPKA-------------------------------->
    <div class="footer">
        &copy; 2020 - Serwis Ankietowy SURVYIO</br> Weronika Rynkowska Marcin Rogoż
    </div>

    <!--------------------------------SKRYPT - STICKY NAVBAR-------------------------------->
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