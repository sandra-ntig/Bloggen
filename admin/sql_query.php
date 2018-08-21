<?php
require_once 'db.php';

//Authentisera mot db efter användarnamn och lösenord
function authenticate($username, $password) {

    //Koppla upp sig mot databas
    $db = db_connect();

    // Läsa en specifik användare ur tabellen 'user'
    $query = 'SELECT * FROM user WHERE username = \''. mysqli_real_escape_string($db, $username) . '\'';

    //Resultatet av sql-frågan sparas i en array
    $result =  mysqli_query($db, $query);

      //Felhantering
      if(!$result) {
        die("Query failed " . db_error($db));
        }

    //Returnerar en associotiv array där varje fält motsvarar en rad från sql-frågan
    $row = mysqli_fetch_assoc($result);

    //$hash = $row['password'];
    $password_db = $row['password'];
    $userId = $row['id'];
    //$boooool = password_verify($password, $hash);

    //Kollar om det angivna lösenordet matchar det hashade i db
    //if(password_verify($password, $hash))
    if(strcmp($password, $password_db) == 0)
    {
        //Sätter sessionsvariablen 'authenticated' till det användarnamn som gått igenom authentiseringen
        $_SESSION['authenticated'] = $username; 
        //Omdirigiering frpn login.php till member.php (medlemssidan)
        header("Location: admin/member.php?userId=$userId&page=default"); 
        return true;       
    } 
    else {
        //Fel användarnam eller lösenord
        return false;
    }

    //Koppla ner från databasen
    db_disconnect($db);
}

//** Användarhantering */

//Skapa användare
function createUser($username, $password)  {

    //Koppla upp sig mot databas
    $db = db_connect();

    $query = 'SElECT * FROM user ';
    $query .= 'WHERE username=\'' . mysqli_real_escape_string($db, $username) . '\'';

     //Resultatet av sql-frågan sparas i en array
    $result = mysqli_query($db, $query);

      //Felhantering
      if(!$result) {
        die("Query failed " . db_error());
    }

    //Om användarnamnen är unikt (ej hittas i db)
    if(mysqli_num_rows($result) == 0)
    {

            //Hasha lösernordet
            //$hash_password = password_hash($password, PASSWORD_DEFAULT);

            // Skapa ny rad i tabellen user med följande username och password
            $query = 'INSERT INTO user (username, password)';
            $query .= 'VALUES (\'' . mysqli_real_escape_string($db, $username) . '\', \'' . mysqli_real_escape_string($db, $password) . '\')';
            
            //Resultatet av sql-frågan sparas i en array
            $result = mysqli_query($db, $query);

            //Sista id som tillades i tabellen user
            $userId =  mysqli_insert_id($db);
            
            //Felhantering
            if(!$result) {
                die("Query failed " . db_error($db));
            }

            //"Skapa ny användare" har lyckts
            return true;

    }
    else {
            //"Skapa ny användarre" har misslyckts
            return false;
    }

    //Koppla ner från databasen
    db_disconnect($db);

}

//Hämta användarinformation
function readUser($userId) {
   
    //Koppla upp sig mot databas
    $db = db_connect();

     // Hämta en specifik användare ur tabellen 'user'
     $query = 'SELECT * FROM user ';
     $query .= 'WHERE id=\'' . mysqli_real_escape_string($db, $userId) . '\'';

     //Resultatet av sql-frågan sparas i en array
     $result = mysqli_query($db, $query);

     //Felhantering
     if(!$result) {
         die("Query failed " . db_error($db));
         }
 
     else {
         return $result;
      }
 
    //Koppla ner från databasen
    db_disconnect($db);

}

//Uppdatera användarinformation
function updateUser($userId, $title, $presentation, $filename) {

    //Koppla upp sig mot databas
    $db = db_connect();

    //Uppdatera tabellen user - Redigera profil
    $query = 'UPDATE user ';
    $query .= 'SET title=\'' . mysqli_real_escape_string($db, $title) . '\', presentation=\'' . mysqli_real_escape_string($db, $presentation) . '\', image=\'' . mysqli_real_escape_string($db, $filename) . '\'';
    $query .= 'WHERE id = \'' . mysqli_real_escape_string($db, $userId) . '\'';  

    //Resultatet av sql-frågan sparas i en array
    $result = mysqli_query($db, $query);

    //Felhantering
    if(!$result) {
        die("Query failed " . db_error($db));
        }
        else {
            //Sql-frågan har genomförts
            return true;
        }

     //Koppla ner från databasen
    db_disconnect($db);

}

/************************** */

//** Hantering av inlägg */

//Skapa inlägg
function createPost($userId, $title, $content) {

    //Koppla upp sig mot databas
    $db = db_connect();

    //Skapa nytt inlägg 
    $query = 'INSERT INTO post (title, content, userID)';
    $query .= 'VALUES (\'' . mysqli_real_escape_string($db, $title) . '\', \'' . mysqli_real_escape_string($db, $content) . '\', \'' . mysqli_real_escape_string($db, $userId) . '\')';
    
    //Resultatet av sql-frågan sparas i en array
    $result = mysqli_query($db, $query);

    //Hämtar id från senaste skapade inlägg
    $last_postId = mysqli_insert_id($db);


    //Felhantering
    if(!$result) {
        die("Query failed " . db_error($db));
        }
        else {
            //Returnera id för senaste tillagda inlägg
            return $last_postId;
        }

    //Koppla ner från databasen
    db_disconnect($db);


}

//Hämta alla inlägg för en användare
function readPosts($userId) {

    //Koppla upp sig mot databas
    $db = db_connect();

    //Hämta alla inlägg för en viss användare
    $query = 'SELECT * FROM post WHERE userID = \''.mysqli_real_escape_string($db, $userId).'\' ORDER BY created DESC';


    //Resultatet av sql-frågan sparas i en array
    $result = mysqli_query($db, $query);

    //Felhantering
    if(!$result) {
        die("Query failed " . db_error($db));
        }

    else {
        //Returna alla inlägg sparade i en array
        return $result;
     }

    //Koppla ner från databasen
    db_disconnect($db); 

}

//Hämta ett inlägg utifrån id
function readPost($postId) {

    //Koppla upp sig mot databas
    $db = db_connect();

    //Sql-fråga för att hämta ett specifikt inlägg
    $query = 'SELECT * FROM post ';
    $query .= 'WHERE id=\'' . mysqli_real_escape_string($db, $postId) . '\'';
    
    //Resultatet av sql-frågan sparas i en array
    $result = mysqli_query($db, $query);

    //Felhantering
    if(!$result) {
        die("Query failed " . db_error($db));
        }

    else {

        //Returna inlägget sparad i en array
        return $result;
    }

    //Koppla ner från databasen
    db_disconnect($db);


}

//Uppdatera inlägg
function updatePost($postId, $title, $content) {

    //Koppla upp sig mot databas
    $db = db_connect();

    //Sql-fråga för att uppdatera ett inlägg
    $query =  'UPDATE post SET title =\'' . mysqli_real_escape_string($db, $title) . '\', content = \''.  mysqli_real_escape_string($db, $content) . '\'';
    $query .= 'WHERE id=\''. mysqli_real_escape_string($db, $postId).'\'';  

    //Resultatet av sql-frågan sparas i en array
    $result = mysqli_query($db, $query);

    //Felhantering
    if(!$result) {
        echo  "Query failed " . mysqli_error($connection);
        }
        else {
            //Inägget upddaterat
            return true;
        }

    //Koppla ner från databasen
    db_disconnect($db);


}

//Ta bort inlägg utifrån id
function deletePost($postId) {

    //Koppla upp sig mot databas
    $db = db_connect();

    //Ta bort inlägg med angivet id
    $query =  'DELETE FROM post WHERE id = \'' . mysqli_real_escape_string($db, $postId). '\'';

    //Resultatet av sql-frågan sparas i en array
    $result = mysqli_query($db, $query);

    //Felhantering
    if(!$result) {
        echo  "Query failed ";
        }
        else {
            //Inlägget har tagits bort
            return true;
        }

    //Koppla ner från databasen
    db_disconnect($db);

}

/************************** */

//** Hantering av bilder */

//Lägg till bild i db
function createImage($filename, $description, $postId) {

    //Koppla upp sig mot databas
    $db = db_connect();
     
    $query = 'INSERT INTO image (filename, description, postId)';
    $query .= 'VALUES (\'' . mysqli_real_escape_string($db, $filename) . '\', \'' . mysqli_real_escape_string($db, $description) . '\', \'' . mysqli_real_escape_string($db, $postId) . '\' )';
     

    //Resultatet av sql-frågan sparas i en array
     $result = mysqli_query($db, $query);
     
      //Felhantering
     if(!$result) {
         die("Query failed " . db_error($db));
         }
 
     else {
            //Bilden har lagts till i databasen
            return true;
     }

    //Koppla ner från databasen
     db_disconnect($db);
}

//Hämta bild utifrån id
function readImage($postId) {

    //Koppla upp sig mot databas    
    $db = db_connect();

    //Sql-fråga för att hämta filnamn för en bild med givet id
    $query = 'SELECT * FROM image WHERE postId = \''.mysqli_real_escape_string($db, $postId).'\'';

    //Resultatet sparas i en array
    $result = mysqli_query($db, $query);

    //Felhantering
    if(!$result) {
        die("Query failed " . db_error($db));
        }

    else {
        //Bildinformation har hämtats från databasen
        return $result;
     }

    //Koppla ner från databasen
    db_disconnect($db);


}

//Hämta alla bilder utifrån användarid
function readImages($userId) {

    //Koppla upp sig mot databas
    $db = db_connect();

    //Sql-fråga för att hämta alla bilder i db för viss användare
    $query = 'SELECT * FROM post WHERE userId = \''. mysqli_real_escape_string($db, $userId) .'\'';

    //Resultatet av sql-frågan sparas i en array
    $result = mysqli_query($db, $query);

    

    //Felhantering
    if(!$result) {
        die("Query failed " . db_error($db));
        }
    
    else {

        //Antal rader som sql-frågan ger
        $num_rows = mysqli_num_rows($result);
        
        if($num_rows>0) {

                $results = array();

                while($row = mysqli_fetch_assoc($result)) {
                    $results[] =  $row['id'];
                }
                
                $query = "SELECT * FROM image WHERE postId IN(".implode(',',$results).")";
                
            
                //Resultatet av sql-frågan sparas i en array
                $result = mysqli_query($db, $query);
            
                //Error handling 
                if(!$result) {
                    die("Query failed " . db_error($db));
                    }
            
                else {
                    return $result;
                }
                }
        else {
                $feedback = "Du har inga bilder att visa";
        }
    }


    //Koppla ner från databasen
    db_disconnect($db);

}

//Uppdatera bild efter inläggsid
function updateImage($filename, $description, $postId) {

    //Koppla upp sig mot databas
    $db = db_connect();

    $query =  "UPDATE image SET filename = '$filename', description='$description' ";
    $query .= "WHERE postId= '$postId'";  
    
    //Resultatet av sql-frågan sparas i en array
    $result = mysqli_query($db, $query);

    //Error handling 
    if(!$result) {
        echo  "Query failed";
        }
        else {
            return true;
        }

    //Koppla ner från databasen
    db_disconnect($db);


}

//Ta bort bild utifrån inläggsid
function deleteImage($postId) {

    //Koppla upp sig mot databas
    $db = db_connect();

    $query =  "DELETE FROM image WHERE postId = '$postId'";

    //Resultatet av sql-frågan sparas i en array
    $result = mysqli_query($db, $query);

    //Error handling 
    if(!$result) {
        echo  "Query failed";
        }
        else {
            return true;
        }

    //Koppla ner från databasen
    db_disconnect($db);


}


//*    NYHETSHANTERING  */

//Läs senaste inlägg 
function readLatestPosts($number) {

    //Koppla upp sig mot databas
    $db = db_connect();
    //Nyheter, exempel på nyheter är senast publicerade inlägg, nyaste bloggaren och liknande.

    $query = "SELECT * FROM post ORDER BY created DESC LIMIT ".$number;

    //Resultatet av sql-frågan sparas i en array
    $result =  mysqli_query($db, $query);

        //Error handling 
        if(!$result) {
            die("Query failed" . db_error($db));
            }

    //Koppla ner från databasen
    db_disconnect($db);

    return $result;
}

//Läs senaste registrerade medlemmar
function readLatestMembers($number) {

    //Koppla upp sig mot databas
    $db = db_connect(); // Koppla upp mot databasen, görs först i scriptet

    //Klickbar lista över alla bloggare
    $query = "SELECT id, username, title, presentation FROM user ORDER BY created DESC LIMIT ".$number;
    
    //Resultatet av sql-frågan sparas i en array
    $result =  mysqli_query($db, $query);

      //Error handling 
      if(!$result) {
        die("Query failed" . db_error($db));
        }


    //Koppla ner från databasen
    db_disconnect($db);

    return $result;


} 


?>