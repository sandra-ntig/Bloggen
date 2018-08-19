 <?php 
//Hämtar funktioner för databasförfrågningar
require_once 'sql_query.php';

 if(isset($_POST['new_post'])) {

    $userId = $_GET['userId'];

    $title = $_POST['post_title'];
    $content = $_POST['post_content'];
    $postId = createPost($userId, $title, $content);

    if(upload_image($postId)) {
        header("Location: member.php?userId=$userId&page=posts"); // Redirecting To Other Page
    }

    
 }

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

// Ladda upp en bild i ett inlägg
function upload_image($postId)
{
   
    // Hantera formulärets data
    $tmp_file = $_FILES['file_upload']['tmp_name'];
    $upload_dir = "uploads/";
    $target_file = basename($_FILES['file_upload']['name']);

    if(!file_exists($upload_dir . $target_file)) {
            
            // Om move_uploaded_file och file_exists returnerar true så gick uppladdningen bra
            if(move_uploaded_file($tmp_file, $upload_dir . $target_file))
            {


                    $description = $_POST['description'];
                    $message = "Filen har laddats upp.";
                    createImage($target_file, $description, $postId);
                    return true;
                
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
    }
    else {
        $message = "Filen existerar redan";
        echo "<div class='message'>";
        echo $message;
        echo "</div>";    }


}

?>
<main>
    <form class="post" action="" enctype="multipart/form-data" method="POST">
            <fieldset>
                    <legend> Skriv text </legend>
                    <label>Rubrik</label>
                    <input id="post_title" type="text" name="post_title"/>
                    <label>Text</label>
                    <textarea id="post_content" rows="5" name="post_content"></textarea>
            </fieldset>
            <fieldset>
                <legend>Bild</legend>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                    <input type="file" name="file_upload" />
                    <label>Bildbeskrivning</label>       
                    <input type="text" name="description" />
                       
            </fieldset>
            <input class="publish" type="submit" name="new_post" value="Publicera"/> 
    </form>
</main>