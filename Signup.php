

<!Doctype html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="2">
  <title class="after">S'authentifier </title>
  <!--Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
  
   <link rel="stylesheet" type="text/css" href="css/style.css"/>
 <link rel="icon" href="favicon.ico" />
 <link rel="icon" type="image/png" href="logo_400x400.png" />
   
</head>
<body style="background: url('old_map_@2X.png');">
<div class="row">
  <header>
     <div class="row">

     <div class="pull-center">
       <h2>Authentifiez-vous ici</h2>
     </div>

    </div>
    </header>
   <div class="container">
      <div class="row">
        <form  action="Page de confirmation.php" method="post">
            <div class="col-md-6" >
        
                       <div class="form-group">
                          <label name="se">Code</label>
                             <input type="text" name="co" class="form-control" required="required">
                             <h6 style="color:red">*Required field</h6>
                       </div>

                       <div class="form-group">
                          <label name="se">Mot de passe</label>
                             <input type="password" id="pere" name="pas" class="form-control" required="required">
                             <h6 style="color:red">*Required field</h6>
                       </div>

                       <div class="form-group">
                           <input type="submit" name="authenti" value="se connecter " class="btn btn-success">           
                      </div>           
    </div>
  </form>
    </div>
  </div>
</div>
</body>
</html>



<?php
/*
   require_once'objet.php';
   include_once'user.class.php';
   if(isset($_POST['aut']) And isset($_POST['nom']) And isset($_POST['motdepasse']))
   {  
    $us=new user($bd);
    $us->authentification($_POST['nom'],$_POST['motdepasse']);
   }
   */
?>