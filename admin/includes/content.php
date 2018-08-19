<?php
//Hämtar funktioner för databasförfrågningar
require_once 'sql_query.php';

$page = $_GET['page'];


function layout($page) {

    switch ($page) {
        default:
        include "pages/user_posts.php";
        break;
        case "createpost":
        include "pages/create_post.php";
        break;
        case "post":
        include "pages/post.php";
        break;
        case "edit_post":
        include "pages/edit_post.php";
        break;
        case "posts":
        include "pages/user_posts.php";
        break;
        case "profile":
        include "pages/profile.php";
        break;
        case "edit_profile":
        include "pages/edit_profile.php";
        break;
        case "gallery";
        include "pages/gallery.php";
        break;

     }
}

layout($page);
?>

         