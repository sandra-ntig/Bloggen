<?php
//Hämtar funktioner för databasförfrågningar
require_once 'sql_query.php';

$userId = $_GET['userId'];

//En klickbar lista med alla bloggens inlägg (menu.php)
$result = readPosts($userId);

?>
                
    <section class="list">
    <?php 
    $num_rows = mysqli_num_rows($result);

        if($num_rows>0) {
          echo '<h2>Mina inlägg</h2>'; 
        } else {
          echo '<h4>Du har inga inlägg</h4>'; 

        }


    ?>
    <ul>   
    <?php 

   while ($row = mysqli_fetch_assoc($result)) {
    $postId = $row['id'];
    $userId = $row['userId'];
    $title = $row['title'];

    echo "<li><a href='member.php?userId=$userId&postId=$postId&page=post'>" .$title. "</a></li>";
    } 
    ?>
    </ul>
  </section>