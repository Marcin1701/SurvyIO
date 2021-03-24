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
    <link rel="stylesheet" href="css/styleMySurveys.css" type="text/css" />
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=mBP4R4AHa3i67UKoMxk-GSq-2Gf3LcmCVBJ9rIJ3VjlNJUWc-7qgR2Yi7_RndzY_yNmog1WLZt-vwq-vODyKoJaZbyA7gXAGamOYLtnT95Nes8bf7-mJVNRZ1tU9UZHWBKDtu6p7FuxhWconp4aQAxv5j3TgxA4a3LarBdkmDSON5AB9Hzov7sOnJGV3Bwy3CGRnYmSvd3kBR54TmBPZkQ4zVd0YHV4MHvC_6sYwweoiNXD-iIGTrpqSPSg8dt5YLzYXKEBg09ZvNz0lss_kdRLNKNb2jbKkeJWQyt_PajYm74TWbyO3lMMe3dwbCKHTtuM62SFH16P5Lk13lPltQg" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9jZG4uZmJzYnguY29tL3YvdDU5LjI3MDgtMjEvMTIzNzM4MDkxXzQzODYyODM3Mzc5MzUxOF8xNTg5NzUxOTU3MTYyNTMxMTUwX24uaHRtbC9teVN1cnZleXMuaHRtbD9fbmNfY2F0PTEwNCZjY2I9MiZfbmNfc2lkPTBjYWIxNCZfbmNfb2hjPUhfbVlaaDJibnJ3QVg5bE1ralUmX25jX2h0PWNkbi5mYnNieC5jb20mb2g9Zjk0MTYwZWUxOTU4MzgzNTZiOGE3MTMzODc4NDM3YWQmb2U9NUZBMkVERTImZGw9MQ"/></head>

<body>
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
    <div id="pageTitle">Wyniki Ankiet</div>
    
    <!--------------------------------CONTENT-------------------------------->
    <div class="content">
        <?php
            require('D:\OneDrive\Programowanie\PHP\XAMPP\htdocs\Serwis Ankietowy\classes\Database.php');
            session_start();
            if ($_SESSION['ResultSurveys'] == 0){
                echo "<div>Brak stworzonych ankiet!</div>";
            }
            else{
            $_SESSION['surveyIndex'] = 0;
            $index = 0;
            foreach($_SESSION['ResultSurveys'] as $survey){
                echo "<div class='resultsButton'><form action='php/surveyResultsShowController.php' method='post'><input name='$index' type='submit' value='".$survey->getSurveyName()."'></form></div>";
                $index++;
                $_SESSION['surveyIndex'] = $_SESSION['surveyIndex'] + 1;
            }
            }
        ?>
    </div>
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