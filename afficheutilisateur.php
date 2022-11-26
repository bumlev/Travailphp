<!DOCTYPE html>
<html lang="en">
<head>
	    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="1">
      <title>Liste des demandes d'accès</title>
       <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
      <link rel="stylesheet"  type="text/css" href="form.css">
      
      <link rel="icon" href="favicon.ico" />
      <link rel="icon" type="image/png" href="logo_400x400.png" />
       <script type="text/javascript" src="js/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body style="background: url('old_map_@2X.png');">
<div  class="container">
<div class="row ">
   <div class="panel panel-default ">

        <div class="panel-body">
             <h2> Liste des utilisateurs</h2>
        </div>

   </div>
   
   <div class="row">
       <div class="col-md-4">
          <div class="form-group">
             <input type="text" class="form-control" placeholder="Search" id="myin">
          </div>
          <button type="submit" class="btn btn-default">Search</button>
     </div>
   </div>
  

         <?php

    include_once 'Membremanager.class.php';
  //  connexion a la  base de donnees

         try
         {

          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
          $bd= new PDO('mysql:host=localhost;dbname=blog', 'root', '',
            $pdo_options);
         }
         catch (Exception $e)
         {
          die('Erreur: '. $e->getMessage());
         }

            ?>
    
</div>
<script>
$(document).ready(function(){
  $("#myin").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#mytable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<div class="row">

<?php

  //  connexion a la  base de donnees

         try
         {

         	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         	$bd= new PDO('mysql:host=localhost;dbname=blog', 'root', '',
            $pdo_options);
         }
         catch (Exception $e)
         {
         	die('Erreur: '. $e->getMessage());
         }

    /////////////////////////// instancier un membre et initiaiser ses donnees ////////////////////////////////////////////////////
         include_once('user.class.php');
         	$use = new user($bd);
        	$use->affiche();

?>
</div>
</div>
</body>
</html>



