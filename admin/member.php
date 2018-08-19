
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Boulderbloggen - Min sida</title>
</head>
<body>
<div id="container">
        <header>
            <?php include 'includes/header.php' ?> 
        </header>
            <main>
                    <article> <?php include 'includes/content.php' ?> </article>
                    <nav> <?php include 'includes/menu.php' ?>  </nav>
                    <aside> <?php include 'includes/info.php' ?> </aside>
            </main>
        <footer>
            <?php include '../includes/footer.php'; ?>
        </footer>
    <!-- Länk till jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Länk till externt javascript -->
    <script src="../js/script.js"></script>
</div>
</body>
</html>


