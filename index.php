<?php
//Hämtar funktioner för databasförfrågningar
require_once 'admin/sql_query.php';

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
    <title>Välkommen till Boulderbloggen</title>
</head>
<body>
    <div id="container">
     <header>
        <h1>Boulderbloggen</h1>
        <a href='login.php'>Logga in</a>
    </header>
<div class="gallery">
    <img src="images/image1.jpg" width="250px">
    <img src="images/image2.jpg" width="250px">
    <img src="images/image3.jpg" width="250px">

</div>
<hr>
<main>
<article> 
    <section class="welcome">
<h1> Välkommen till Booulderbloggen!</h1>
<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus convallis enim, at tincidunt enim rhoncus non. Nam cursus ut metus non sagittis. Nam finibus diam et ligula tempus, vel volutpat arcu malesuada. Cras vitae pretium leo. Suspendisse potenti. Cras ut urna a massa finibus finibus. Nunc vestibulum risus et cursus lobortis. Pellentesque ultricies diam ac neque pulvinar, non sagittis odio dictum. Mauris ullamcorper eget elit vel hendrerit. Vivamus eleifend turpis et ex malesuada, sit amet commodo erat tempor. Curabitur quis aliquet leo, ut tempus justo. Nulla nec efficitur tortor. Integer imperdiet eros ut libero efficitur bibendum. Quisque scelerisque ullamcorper sapien, malesuada porta arcu viverra in. Fusce a eros eget mauris maximus varius. Donec id molestie ipsum.</p>

<p>Ut sodales arcu sit amet lorem vehicula maximus. Nullam molestie dictum malesuada. Sed consequat eleifend mi ac consequat. Nullam tristique placerat convallis. Duis finibus leo sit amet eros cursus, vitae varius nulla tincidunt. Suspendisse potenti. Aliquam vitae leo ac urna sollicitudin aliquam. Donec eget turpis ultrices, congue mauris vitae, lacinia nunc. In congue efficitur leo, eu vehicula dui pharetra dapibus. Praesent convallis et lorem non rutrum. Praesent erat eros, pharetra quis sagittis mattis, placerat ullamcorper orci. Quisque ac tellus in lacus sollicitudin aliquam dignissim quis nunc. Pellentesque at hendrerit risus, feugiat fermentum nisi. Sed feugiat pulvinar dolor quis gravida. Vivamus tempor est est, a venenatis elit finibus in.</p>

</section>
</article>
<nav> 
<section class="list">
    <h2>Nyheter</h2>
    <ul>   
    <?php 

        //Visa de senaste 10 senaste inläggen  
        $result = readLatestPosts(10); 
        while ($row = mysqli_fetch_assoc($result))
            {
            $postId = $row['id'];
            $userId = $row['userId'];
            $title = $row['title'];
            //Inläggen visas med titel och länk till sidan med url-parameter $userId och $postId
            echo "<li><a href='blog.php?userId=$userId&postId=$postId'>" .$title. "</a></li>";
        } 
    ?>
    </ul>
  </section> 
</nav>
<aside> 
        <section class="list">
        <h2>Senaste bloggaren</h2>
        <ul>   
        <?php 
            //Visa de senaste 10 senaste registerade bloggarna
            $result = readLatestMembers(10); 
            while ($row = mysqli_fetch_assoc($result))
            {
            
                $userId = $row['id'];
                $username = $row['username'];

                //Bloggaren visas med användarnamn och länk till sidan med url-parameter $userId
                echo "<li><a href='blog.php?userId=$userId'>" .$username. "</a></li>";
            }
        ?>
    </ul>
</section>

</aside>

</main>
<footer>
    <?php include 'includes/footer.php' ?>
<footer>
</div>
</body>
</html>