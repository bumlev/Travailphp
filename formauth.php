<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> LOG IN</title>
	<link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>
<div class="loginbox">
	<img src="auth.jpg" class="user">
      <h2>Log In Here</h2>
      <form method="post" action="formauth.php">
        <p>Nom ou Prenom</p>
        <input type="text" name="nom" placeholder="Nom ou Prenom" required="required">
        <p>Mot de passe</p>
        <input type="password" name="motdepasse" placeholder="***************" required="required">
        <input type="submit" name="aut" value="S'authentifier">
         <a href="Comptuser.php">S'inscrire</a>
      </form>
     
</div>

<?php

   require_once'objet.php';
   include_once'user.class.php';
   if(isset($_POST['aut']) And isset($_POST['nom']) And isset($_POST['motdepasse']))
   {  
    $us=new user($bd);
    $us->authentification($_POST['nom'],$_POST['motdepasse']);
   }
  
?>


</body>
</html>