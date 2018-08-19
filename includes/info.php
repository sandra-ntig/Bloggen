<?php
//Hämtar funktioner för databasförfrågningar
require_once 'admin/sql_query.php';

//Kollar om url-parameter userId är satt
if(!isset($_GET['userId'])) {

    //Ingen bloggare vald - Visa information om bloggen

    //TODO 
    echo "info om bloggen";

}
else {

//Om url-parameter $userId är satt - visa nformation om bloggaren 

//Hämtar värdet på url-parameter $userId
$userId = $_GET['userId'];

//Hämtar information om användare utifrån $userId
$result = readUser($userId);

$row = mysqli_fetch_assoc($result);

//Hämtar värdet för varja rad för specifikt $userId
$presentation = $row['presentation'];
$filename = $row['image'];
$username = $row['username'];
$title = $row['title'];
$created = $row['created'];

//Skrivet ut innehållet från raden i HTML
?>
<section class="info">
    <h2>
        <?php echo $username;?>
    </h2>
    <p>
        <?php echo $title; ?>
    </p>
    <p>
        <?php echo $presentation; ?>
    </p>
  
    <img src="admin/uploads/<?php echo $filename;?>" alt="Profilbild_<?php echo $username;?>"> 
 <p class="small"> Medlem sedan: <?php echo '&nbsp'; echo $created;?></p>
</section>

<?php } ?>