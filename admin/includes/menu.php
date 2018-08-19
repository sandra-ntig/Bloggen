 
 <?php 
 //Hämta url-parameter $userId
 $userId = $_GET['userId'];
 ?>        
                    
<section class="menu_list">
    <h2>Min sida</h2>
    <ul>   
        <!-- Meny som länkar till medlemsida och vald url-parameter 'page'-->
         <li><a href="../admin/member.php?userId=<?php echo $userId."&"; ?>page=createpost">Skriv inlägg</a></li>         
        <li><a href="../admin/member.php?userId=<?php echo $userId."&"; ?>page=profile">Min sida</a></li>
        <li><a href="../admin/member.php?userId=<?php echo $userId."&"; ?>page=posts">Mina inlägg</a></li>
        <li><a href="../admin/member.php?userId=<?php echo $userId."&"; ?>page=gallery">Mina bilder</a></li>
    </ul>
  </section>
        