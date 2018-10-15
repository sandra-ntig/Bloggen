<?php
session_start(); //Initerar sessionen

//Hämtar funktioner för databasförfrågningar
require_once 'admin/sql_query.php';

//Meddelande under loginformuläret
$feedback_login = "";
//Meddelande under registreringsformuläret
$feedback_register = "";


    //"Logga in" efterfrågas - authentisering
    if (isset($_POST['login'])) {
    
        //Hämtar användarnam och lösenord från formuläret
        $username = $_POST['username'];
        $password = $_POST['password'];

        //Om authentisering lyckas - se funktion authenticate (sql_query.php)
        //Om authentiseringen misslyckas - ej angett användarnamn/lösenord eller felaktigt
        //meddelande visas för användaren
        if(!authenticate($username, $password)) {

        
            if(empty($_POST['username']) or empty($_POST['password'])) {


                $feedback_login = "Ej angett användarnamn eller lösenord";

                } 
            else {

                $feedback_login = "Felaktigt användarnamn eller lösenord";

                }

            }

    }

    //Registering efterfrågas - Skapa ny användare
    if (isset($_POST['new_user'])) {

        //Kollar att fälten är ifyllda
        if(isset($_POST['username']) and isset($_POST['password']) and isset($_POST['password_retype']) and isset($_POST['checked'])) {

        //Hämtar variabler från formuläret
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_retype = $_POST['password_retype'];
                                

        //Validering mot serversidan
        if(strlen($username)>=6 and strcmp($password,$password_retype)==0 )  { 
                 
        //Skapar ny användare i databsen med funktionen createUser(sql_query.php)    
        if(createUser($username, $password)) {
            //Om förfrågan lyckas - visa loginformuläret      
            echo "<script>";
            echo "$('#login').addClass('hide');
            $('#login').removeClass('show');
            $('#register').addClass('show');
            $('#register').removeClass('hide');
            $('.content').addClass('high');";
            echo "</script>";
            //Meddelande til användaren att användaren har skapats
            $feedback_register = "Du är nu medlem i Boulderbloggin. Logga in för att fortsätta";
        }
        else {
            //Meddelande till användaren att användarnamnet inte är unikt
            $feedback_login = "Användaren finns redan";

            } 
                                   
        }
                               
        } 
     }
                    
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Boulderbloggen</title>
  
</head>
<body>
    <div id="container">
        <header>
        <h1>Boulderbloggen</h1>
        </header>
    <main>

   <div class="container">
                <div id="register" class="box hide">
                    <form class="login" action="login.php" method="POST" onSubmit="return validate()">
                        <div class="field">
                            <div class="register">Registera dig<br></div>
                        </div>
                        <div class="field">
                        <input id="new_username" type="text" name="username" placeholder="användarnamn"/>
                        <input id="new_password" type="password" name="password" placeholder="lösenord"/>
                        <input id="password_retype" type="password" name="password_retype" placeholder="Repetera lösenord"/>
                        </div>
                        <div class="field">                        
                        <input id="checkbox" name="checked" type="checkbox">
                        <label>Jag godkänner användarvillkoren</label>
                        </div>
                        <div class="field">
                        <input name="new_user" type="submit" value="Skapa ny användare"/>
                        </div>
                         <!-- Meddelande til användaren om registrering lyckats -->
                        <?php if(isset($feedback_register)) { ?>
                            <div class="feedback">
                             <?php echo $feedback_register; ?>
                            </div>
                        <?php } ?>  
                        <div class="field">
                        <a href="#" id="back">Tillbaka till login</a>
                        </div>
                    </form>
                </div>
             

                 <div id="login" class="box show">
                    <form class="login" method="POST">
                        <div class="field">
                            <div class="sign-in">Logga in<br></div>
                        </div>
                        <div class="field">
                            <input id="username" type="text" name="username" placeholder="användarnamn"/>
                            <input id="password" type="password" name="password" placeholder="löseoord"/>
                        </div>
                        <div class="field">
                            <a href="#" id="account" class="trouble">Är du inte registrerad på Boulderbloggen?</a>
                        </div>
                         <input name="login" type="submit" value="Logga in"/>
                            <!-- Meddelande til användaren om inloggning lyckats -->
                            <?php if(isset($feedback_login)) { ?>
                                <div class="feedback">
                                <?php echo $feedback_login; ?>
                                </div>
                            <?php } ?>  
                        
                    </form>
                </div>
        
            </div>

            <!-- Modal - meddelande om validering på klientsidan till användaren-->
         <div class="popup" id="popup">
                <div class="popup_content">
                    <span class="close"> <smalL> &times; </small></span> 
                    <p id="msg_fail"></p>
                    <p id="msg_true"></p>
                </div>
        </div>

</main>
    <footer>
        <?php include 'includes/footer.php'; ?>
    </footer>
    </div>
      <!-- jQuery CDN --> 
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>      
      <!-- Länk till externt Javascript för validering + animationer på sidan-->
      <script src="js/script.js"></script> 
  
    </body>
</html>

