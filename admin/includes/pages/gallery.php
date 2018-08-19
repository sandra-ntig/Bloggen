<?php 
//Hämtar funktioner för databasförfrågningar
require_once 'sql_query.php';
$userId = $_GET['userId'];

    $result = readImages($userId);
?>
   
<?php

        if(isset($result)) {
            echo '<div class="grid">';
        while($row = mysqli_fetch_assoc($result)) {

        $filename = $row['filename'];
        $description = $row['description'];
        $imageId = $row['id'];

    
            echo "<div class='grid-item'>
                    <img src='uploads/$filename''>
                        <hr>
                        <p>$description</p>
                 </div>";

         } 
         echo '</div>';

    }
    else {
       $feedback = "Du har inga bilder att visa";
       echo "<h4>$feedback</h4>";
    } ?>

