<?php 
      session_start();//Initiererar session
  

    //Meddelande vid utloggning
    $feedback = "";

    //Avslutar pågående session
    if(!session_destroy())
    {
        //Meddelande om sessionen inte kunde avslutas
        $feedback = "Problem med att logga ut";
    }
    else
    {
        //Meddelande om att sessionen kunde avslutas
        $feedback = "Du är nu utloggad från Boulderbloggen. ";
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
    <title>Välkommen åter</title>
</head>
<body>
    <div id="container">
<header>
        <h1>Boulderbloggen</h1>
        <a href='login.php'>Logga in</a>
</header>
<main>
 
 <p class="logout"> <?php echo $feedback;?> <a href="login.php">Klicka här för att logga in igen</a> </p>

</main>
<footer><?php include 'includes/footer.php'; ?></footer>
</div>
</body>
</html>


