
<a href='../index.php'><h1>Boulderbloggen</h1></a>

<?php
//Hämtar funktioner för databasförfrågningar
require_once 'admin/sql_query.php';
//Initierar sessionen
session_start();

//Om sessionen 'authenticated' är satt - hälsa besökare välkommen med desss anävndarnamn
//Visa/möjliggör 'Logga ut'
if (isset($_SESSION['authenticated'])) {
    
    $username = $_SESSION['authenticated'];
    echo '<p> Välkommen du är nu inloggad som ' .$username.'</p>'; 
    echo "<a href='../logout.php'>Logout</a>";
}
//Om sessionen 'authenticated' inte är satt - omdirigera till loginsidan
else {
    header('location: login.php');
  

}
?>


 
   

