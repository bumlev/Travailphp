<!DOCTYPE html>
<html lang="en">
<head>
	    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="2">
      <title>Message de confirmation</title>
       <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
      <link rel="stylesheet"  type="text/css" href="form.css">
      <link rel="icon" href="favicon.ico" />
      <link rel="icon" type="image/png" href="logo_400x400.png" />
</head>
<body style="background: url('old_map_@2X.png');">
<div  class="container">
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

        include_once 'user.class.php';

        $us=new user($bd);
       
       if(isset($_POST['authenti']) And isset($_POST['co']) And isset($_POST['pas']))
           $us->pageconfirm($_POST['co'],$_POST['pas']);

    ?>               
          
 </div>
</div>




</div>
</div>
</body>
</html>



