
<?php
//Hämtar funktioner för databasförfrågningar
require_once 'admin/sql_query.php';
?>
<!doctype html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Bloggen</title>
</head>
<body>
<div id="container">
            <!-- Inkluderar de separata sidorna header, article, nav, aside, footer (php) -->
             <header>
                  <?php include 'includes/header.php' ?> 
             </header>
              <main>
                    <article><?php include 'includes/content.php' ?> </article>
                    <nav><?php include 'includes/menu.php' ?>  </nav>
                    <aside><?php include 'includes/info.php' ?> </aside>
              </main>
              <footer><?php include 'includes/footer.php' ?></footer>
</div>
</body>
</html>


