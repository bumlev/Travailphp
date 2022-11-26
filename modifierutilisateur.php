<!Doctype html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="2">
  <title class="after">Valider l'accès au Systeme </title>
  <!--Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="css1/bootstrap.min.css"/>
  
   <link rel="stylesheet" type="text/css" href="css/style.css"/>
   <link rel="icon" href="favicon.ico" />
 <link rel="icon" type="image/png" href="logo_400x400.png" />
   
</head>
<body style="background:url(jaube.jpg); ">
   <?php
       try 
         {

          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
          $bd= new PDO('mysql:host=localhost;dbname=blog', 'root', '',
            $pdo_options);
           $re=$bd->prepare('SELECT * FROM user WHERE Id=:iD');

          $re->execute(array(

          'iD'=>$_GET['id']

                     ));

         } 
         catch (Exception $e) 
         {
          die('Erreur: '. $e->getMessage());
         }

        $donnees=$re->fetch();
    ?>

<div class="row">
  <header>
     <div class="row">

     <div class="pull-center">
       <h2> Valider l'accès au Systeme </h2>
     </div>

    </div>
    </header>

    <div class="row">
     <form  action="modifierutilisateur.php" method="post">
          <div class="col-md-6" >

                      <div class="form-group">
                          <label name="identity" type="hidden"></label>
                             <input type="hidden" id="irangamuntu" name="dim" class="form-control" value="<?= htmlspecialchars($donnees['Id'])?>">
                       </div>

                       <div class="form-group">
                          <label name="amazina">Nom:</label>
                          
                             <input  type="text" id="idname" name="nam"  class="form-control" required="required" value="<?=$donnees['nom']?>">
                              <h6 style="color:red">*Required field</h6>
                       </div>
                       
                       <div class="form-group">
                          <label name="irangamirere">Prenom:</label>
                             <input type="text" id="irangamirere" name="preno" class="form-control" required="required" value="<?=$donnees['prenom']?>">
                              <h6 style="color:red">*Required field</h6>
                       </div>

                          <div class="form-group">
                            <label>Bloquer l'utilisateur?: </label>
                                 <div class="radio">
                                    <label>
                                      OUI
                                        <input type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
                                    </label>
                                    <label>
                                      NON
                                        <input type="radio" name="blankRadio" id="blankRadio2" value="option2" aria-label="...">
                                    </label>
                                 </div>


                          </div>

                       <div class="form-group">
                           <input type="submit" name="valid" value="Enregistrer" class="btn btn-success">           
                      </div>  
                      

    </div>


  </form>
    </div>
</div>

<?php

   if (isset($_POST['valid'])) 
    {
   
       if (isset($_POST['inlineRadioOptions'])  ) 
     {
          echo $_POST['inlineRadioOptions'].'</br>';
     } 

  }  

?>
</body>
</html>