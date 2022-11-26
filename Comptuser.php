<!Doctype html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="2">
  <title class="after">Demande d'accès au Systeme </title>
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
       <h2>Demande d'accès au system </h2>
     </div>

    </div>
    </header>
 <div class="container" >
    <div class="row">
     <form  action="user.class.php" method="post">
    	    <div class="col-md-6" >
    		

                       

                       <div class="form-group">
                          <label name="amazina">Nom:</label>
                          
                             <input  type="text" id="idname" name="name"  class="form-control" required="required" >
                              <h6 style="color:red">*Required field</h6>
                       </div>
                       
                       <div class="form-group">
                          <label name="irangamirere">Prenom:</label>
                             <input type="text" id="irangamirere" name="prenom" class="form-control" required="required" >
                              <h6 style="color:red">*Required field</h6>
                       </div>
                       <div class="form-group">
                          <label name="se">Code</label>
                             <input type="text" name="code" class="form-control" required="required">
                             <h6 style="color:red">*Required field</h6>
                       </div>

                       <div class="form-group">
                          <label name="se">Mot de passe</label>
                             <input type="password" id="pere" name="password" class="form-control" required="required">
                             <h6 style="color:red">*Required field</h6>
                       </div>

                       <div class="form-group">
                           <input type="submit" name="demander" value="Demander l'acces" class="btn btn-success">           
    	                </div>   
                      <div class="form-group">
                        <p>Si vous avez deja cree un compte?</p>
                        <a href="Signup.php">Voir votre message de confirmation</a>
                        

                      </div>        
    </div>
  </form>
    </div>
  </div>
</div>
</body>
</html>