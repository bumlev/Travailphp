<?php
	require_once 'objet.php';
	include_once 'user.class.php';
?>
<!Doctype html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="text/html">
			<meta name="viewport" content="width=device-width", initial-scale="2">
			<title class="after">Compte Administrateur</title>
			<link rel="icon" type="image/png" href="logo_400x400.png"/>
			<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		</head>
		<body style="background: url('old_map_@2X.png');">
			<nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-container">
							<span class="sr-only"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="#" class="nav-tabs-justified">
							<img src="eglisevivantelogo.png" style="width:229px;">
						</a>
					</div>
					<?php
					
					if(!isset($_SESSION['no']) or !isset($_SESSION['motdepa']) or substr($_SESSION['no'],0,4)!='EVJA')
						header('location:formauthentification.php');
					
					$nom='logout';
					?>
					<div class="collapse navbar-collapse" id="navbar-container">
						
						<form action="user.class.php" method="post" class="form-inline nav navbar-nav" style="margin-left: 115px;margin-top:42px;">
							<input id="motpass" class="form-control form-inline" type="password" name="motpass">
							<input class="btn btn-default form-inline" name="motbutton" type="submit" value="Edit password">
						</form>
						
						<ul class="nav navbar-nav navbar-right">
							<li><a><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']?></a></li>
							<li class="active"><a href="Administrateur.php" style="height:75px;">Report</a></li>
							<li><a href="createaccount.php">Create Account</a></li>
							<li><a href="user.class.php?log=<?=$nom ?>" style="height:75px;" class="btn btn-default">Logout</a></li>
						</ul>
					</div>
					
				</div>
			</nav>
			
			<div class="row" style="height:561px;">
				
				<div class="col-lg-2 navbar-inverse" style="margin-top: 77px;height: 100%;">
					<ul class="list-group" style="background-color: unset;border:none;">
						<li class="list-group-item " style="background-color: unset; border-radius: 20px;"><a href="listeutilisateurs.php" style="height:75px; color: #fff;">User</a></li>
						<li class="list-group-item" style="background-color:unset; border-radius: 20px;"><a href="#" style="color: #fff;">Administrator</a></li>
					</ul>
				</div>
				
				
				<div class="col-lg-10" style="margin-top: 176px;">
					<div class="form-inline" style="text-align: center">
						<input type="date" class="form-control" name="chercher" style="width: 170px;">
						<input type="button" class=" btn btn-success" value="search">
					</div>
				</div>
				
			</div>
		
		</body>
	</html>
