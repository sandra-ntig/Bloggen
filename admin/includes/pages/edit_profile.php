<?php 
//Hämtar funktioner för databasförfrågningar
require_once 'sql_query.php';

$userId = $_GET['userId'];


$result = readUser($userId);
$row = mysqli_fetch_assoc($result);

$title = $row['title'];
$username = $row['username'];
$presentation =$row['presentation'];
 


  // Följande definition kan med fördel ligga i en separat config-fil.
$upload_errors = array(
    // http://www.php.net/manual/en/features.file-upload.errors.php
    UPLOAD_ERR_OK          => "Inga fel.",
    UPLOAD_ERR_INI_SIZE    => "Filen är större än den storlek som anges i php.ini (upload_max_filesize).",
    UPLOAD_ERR_FORM_SIZE   => "Filen är större än den största filstorlek som angets i formuläret (MAX_FILE_SIZE).",
    UPLOAD_ERR_PARTIAL     => "Filen blev delvis uppladdad.",
    UPLOAD_ERR_NO_FILE     => "Ingen fil är vald.",
    UPLOAD_ERR_NO_TMP_DIR  => "Ingen temporär katalog finns på webbservern.",
    UPLOAD_ERR_CANT_WRITE  => "Kan inte skriva till disk.",
    UPLOAD_ERR_EXTENSION   => "Filuppladdningen är stoppad av ett tillägg (extension)."
);

 // Ladda upp profilbild
function profile_image()
{

    // Hantera formulärets data
    $tmp_file = $_FILES['file_upload']['tmp_name'];
    $upload_dir = "uploads/";
    $target_file = basename($_FILES['file_upload']['name']);

    
    if(!file_exists($upload_dir . $target_file)) {

        // Om move_uploaded_file returnerar true så gick uppladdningen bra
        if(move_uploaded_file($tmp_file, $upload_dir . $target_file))
        {
            $message = "Filen har laddats upp.";
            return $target_file;
        
        }

        // Något gick fel vid uppladdningen
        else
        {
            $error = $_FILES['file_upload']['error'];
            $message = $upload_errors[$error];
            echo "<div class='message'>";
            echo $message;
            echo "</div>";
        }

    } else {
        $message = "Filen existerar redan";
        echo "<div class='message'>";
        echo $message;
        echo "</div>";

    }


}

if(isset($_POST['edit_profile'])) {

    $title = $_POST['post_title'];
    $presentation = $_POST['post_presentation'];
    $filename = profile_image();    

    if(updateUser($userId, $title, $presentation, $filename)) {
        header("Location: member.php?userId=$userId&page=profile"); // Redirecting To Other Page
    }
    else {
        //Stanna kvar på sidan
        //Visa felmeddelande
    }

    
 }
 ?>
<main>
    <form class="post" enctype="multipart/form-data" method="POST">
<fieldset>
        <legend> Redigera profil</legend>
        <label>Titel</label>
        <input type="text" name="post_title" value="<?php echo $title?>"/>
        <label>Text</label>
        <textarea rows="5" name="post_presentation" ><?php echo $presentation?></textarea>
</fieldset>
<fieldset>
    <legend>Bild</legend>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input type="file" name="file_upload"/>
       
</fieldset>
        <input class="publish" type="submit" name="edit_profile" value="Uppdatera profil"/> 
    </form>
</main>



