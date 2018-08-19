
<?php

//Hämtar funktioner för databasförfrågningar
require_once 'sql_query.php';
    //Hämta postId för inlägget i url-parameter
    $postId = $_GET['postId'];
    $userId = $_GET['userId'];
    
    //Läs in inlägget
    $result = readPost($postId);
    $row = mysqli_fetch_assoc($result);
    
    $title = $row['title'];
    $content= $row['content'];
    $created = $row['created'];
    //Läs in bilden för inlägget
$result = readImage($postId);
$row = mysqli_fetch_assoc($result);
$filename = $row['filename'];
$description = $row['description'];
    
?>


<form  class="post" method="POST">
    <fieldset> 
        <legend>  <?php echo $title ?> </legend>

    <p><?php echo $content ?> </p>
       
    <p> <small> Skapad: <?php echo $created ?></small> </p>
</fieldset>
<fieldset>
        <img src="uploads/<?php echo $filename;?>" alt="<?php echo $description;?>">
    
</fieldset>
<fieldset> 
<input type="submit" class="publish" name="remove_post" value="Ta bort inlägg" /><br />
<input type="submit" class="publish" name="edit_post" value="Redigera inlägg" /><br />
</fieldset>

<?php
   if(isset($_POST['remove_post'])) {
           if(deleteImage($postId)) {
               echo "Image deleted";

                if(deletePost($postId)) {
                    echo "Post deleted";
                    header("Location: member.php?userId=$userId&page=posts"); // Redirecting To Other Page
                }
                else {
                    echo "delete post failed";

                }
            } else {
                echo "delete image failed";
            }
}

   if(isset($_POST['edit_post'])) {
    header("Location: member.php?userId=$userId&postId=$postId&page=edit_post"); // Redirecting To Other Page
}
?>
</form>

