<?php
//Hämtar de olika funktionerna för uppkopplng mot databas
include "admin/db.php";

//Kopplar upp sig mot databasen
$db = db_connect();

//importera databasen med namnet cms.sql, TRUE = skriv över gamla tabeller
db_import($db, "cms.sql", TRUE);

//Importeringen klar
echo "DONE";
?>