<?php 
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
    <link rel="stylesheet" href="css/styleRegister.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />

	<style>
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
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
		<div id=pageTitle>
            Rejestracja
        </div>
		<div id="content">
			<form action="php/registerController.php" method="post">
				<div>
					<label>
					<input type="email" placeholder="Adres E-mail" maxlength="30" onfocus="this.placeholder=''" onblur="this.placeholder='Adres E-mail'" value="<?php
						if (isset($_SESSION['fr_email']))
						{
							echo $_SESSION['fr_email'];
							unset($_SESSION['fr_email']);
						}
					?>" name="email"/>
					</label>
				</div>
				<?php
					if (isset($_SESSION['e_email']))
					{
						echo '<div class="error">'.$_SESSION['e_email'].'</div>';
						unset($_SESSION['e_email']);
					}
				?>
				<div>
					<label>
					<input type="password"  placeholder="Podaj hasło" maxlength="30" onfocus="this.placeholder=''" onblur="this.placeholder='Podaj hasło'" value="<?php
						if (isset($_SESSION['fr_haslo1']))
						{
							echo $_SESSION['fr_haslo1'];
							unset($_SESSION['fr_haslo1']);
						}
					?>" name="haslo1" required/>
					</label>
				</div>
				<?php
					if (isset($_SESSION['e_haslo']))
					{
						echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
						unset($_SESSION['e_haslo']);
					}
				?>
				<div>		
					<label>
					<input type="password" placeholder="Powtórz hasło" maxlength="30" onfocus="this.placeholder=''" onblur="this.placeholder='Powtórz hasło'" value="<?php
						if (isset($_SESSION['fr_haslo2']))
						{
							echo $_SESSION['fr_haslo2'];
							unset($_SESSION['fr_haslo2']);
						}
					?>" name="haslo2" required/>
					</label>
				</div>
				<div>
					<label>
					<input type="checkbox" required id="checkB" name="regulamin" <?php
					if (isset($_SESSION['fr_regulamin']))
					{
						echo "checked";
						unset($_SESSION['fr_regulamin']);
					}
						?> required/> Akceptuję regulamin serwisu
				</div>
				</label>
				<br>
				<input type="submit" value="Zarejestruj się" />
				
			</form>
		</div>
		
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