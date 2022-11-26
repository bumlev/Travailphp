
<?php

   include 'objet.php';

   if(isset($_GET['pp']) And !empty($_GET['pp']) And ctype_digit($_GET['pp'])==1)
    $perpage=$_GET['pp'];
   else
   $perpage=5;

   $req=$bd->query('SELECT count(*) as nb from membre');
   $resultat=$req->fetch();
   $total=$resultat['nb'];
   $nbpage=ceil($total/$perpage);
    $current=1;
   if (isset($_GET['p']) And !empty($_GET['p']) And ctype_digit($_GET['p'])==1)
   {
            if ($_GET['p'] > $nbpage)
              {

              	 $current=$nbpage;
              }
              else
              {
              	$current=$_GET['p'];
              }
   }
   else
   {
      $current=1;
   }
     $firstofpage=($current-1)*$perpage;

?>

