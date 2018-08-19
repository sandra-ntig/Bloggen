<?php

//Hämtar funktioner för databasförfrågningar
require_once 'sql_query.php';

$userId = $_GET['userId'];

    $result = readUser($userId);
    $row = mysqli_fetch_assoc($result);
    
    $title = $row['title'];
    $username = $row['username'];
    $presentation = $row['presentation'];
    $image = $row['image'];
    $created = $row['created'];

?>


<form  class="post" method="POST">
            <fieldset> 
                <legend>  <?php echo $title ?> </legend>

            <p><?php echo $presentation ?> </p>
            
            <p> <small> Medlem sedan: <?php echo $created ?></small> </p>
        </fieldset>

        <fieldset>
                <img src="uploads/<?php echo $image;?>" alt="Profilbild_<?php echo $username;?>">    
        </fieldset>

        <fieldset> 
            <input type="submit" class="publish" name="edit_profile" value="Redigera profil" /><br />
        </fieldset>

</form>

<?php
  if(isset($_POST['edit_profile'])) {
    header("Location: member.php?userId=$userId&page=edit_profile"); // Redirecting To Other Page

}
   
?>

