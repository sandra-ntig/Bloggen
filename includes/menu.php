<?php
//Hämtar funktioner för databasförfrågningar
require_once 'admin/sql_query.php';

?>
              
    <section class="list">
        <h2>Nyheter</h2>
        <ul>   
              <?php 

                  //Hämtar senast 15 inläggen
                  $result = readLatestPosts(15);  
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
