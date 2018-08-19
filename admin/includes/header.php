
<a href='../index.php'><h1>Boulderbloggen</h1></a>

<?php
//Hämtar funktioner för databasförfrågningar
require_once 'sql_query.php';
session_start();

    if (isset($_SESSION['authenticated'])) {
        
        $username = $_SESSION['authenticated'];
        echo '<p> Välkommen du är nu inloggad som ' .$username.'</p>'; 
        echo "<a href='../logout.php'>Logout</a>";
    }

    else {
        //Redirect to login page
        header('location: ../login.php');

    }
?>
