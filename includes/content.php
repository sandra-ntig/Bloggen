<?php

//Det valda inlägget eller det senaste inlägget om inget inlägg är valt 

if(empty($_GET['postId'])) {

    //Hämta senaste inlägget
    $result = readLatestPosts(1);

    $row = mysqli_fetch_assoc($result);

    $title = $row['title'];
    $content = $row['content'];
    $created = $row['created'];

}
else  {
    //Hämtar valt inlägg
    $postId = $_GET['postId'];

    $result = readPost($postId);

    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $content = $row['content'];
    $created = $row['created'];

}

?>

<!-- Visar innehåll från det läsa inlägget -->
<section class="content"> 
    <h2>Boulderbetrakelse</h2>
    <p class="title"> <?php echo $title; ?></p>
    <p> <?php echo $content; ?></p>
    <p class="small"> Skapad: <?php echo '&nbsp'; 
                                    echo '&nbsp';
                                    echo  $created; ?></p>
</section>

