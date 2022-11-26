<?php
	include_once 'user.class.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width", initial-scale="2">
	
	<title>List of Members</title>
	
	<!--link rel="icon" href="favicon.ico"/-->
	<link rel="icon" type="image/png" href="logo_400x400.png"/>
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
	
	
	<!--
	<link rel="stylesheet"  type="text/css" href="css/ser06.css">
	<link rel="stylesheet"  type="text/css" href="css/form.css">-->
	
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/dropdown.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/responsive-paginate.js"></script>
	<!--	<script type="text/javascript" src="js/bootstrap.min.js"></script>-->

</head>

<body style=" background:url('old_map_@2X.png');">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="min-height:72px;">
	<a class="navbar-brand" href="#"><img src="eglisevivantelogo.png" style="width:229px;margin-top:-23px;"></a>
	
	<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon "></span>
	</button>
	<?php
	if (!isset($_SESSION['no']) And !isset($_SESSION['motdepa']))
		header('location:formauthentification.php');
	
	$nom='logout';
	?>
	<div class="collapse navbar-collapse" id="navbarNav">
		
		<ul class="navbar-nav navbar-right">
			<li class="nav-item"><a class="nav-link"><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']?></a></li>
			<!--<li class="nav-item"><a href="Church Management.php" class="nav-link">Registration of members</a></li>-->
			<li class="nav-item" style="height:60px;"><a href="affiche.php" class="nav-link">List of Members</a></li>
			<li class="nav-item active table-active" style="background-color: black; text-decoration:none;"><a href ="editingprofil.php?nom=update&amp;id=<?=$_SESSION['id']?>" style="color: #fff;text-decoration:none;" class="nav-link">Edit Profil</a></li>
			<li class="nav-item"><a href="user.class.php?log=<?=$nom?>" class="nav-link">Logout</a></li>
		
		</ul>
	
	</div>

</nav>
<?php
try
{
	
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bd= new PDO('mysql:host=localhost;dbname=blog', 'root', '',
		$pdo_options);
	$re=$bd->prepare('SELECT * FROM user WHERE Id=:iD');
	
	$re->execute(array(
		
		'iD'=>htmlspecialchars($_GET['id'])
	));
	
}
catch (Exception $e)
{
	die('Erreur: '. $e->getMessage());
}
	$donnees=$re->fetch();
?>

<div class="col-md-6 offset-md-3" style="margin-top:-69px;margin-bottom:20px;">

	<div class="card card-outline-secondary" style="margin-top:90px;">
		<div class="card-header" style="background-color: #8a6d3b;color: #efed40;">
			<h2 class="text-center">Create an Account</h2>
		</div>


		<div class="card-body" style="background-color:#f7e1b5;color:#8a6d3b;">

			<form  action="Roleuser.class.php" method="post">
				<div class="form-group">
					<input name="Iduser"   type="text" id="serialnumb" class="form-control" style="width: 290px;border-radius: 5px;display:none;" value="<?=$donnees['Id']?>">
				</div>

				<div class="form-group row">
					<div class="col-md-9 center-block">
						<label>Last Name</label>
						<input name="nom"  type="text" id="nom" class="form-control" style=";border-radius: 5px;" value="<?=$donnees['nom']?>">
					</div>
					
				</div>

				<div class="form-group row">
					<div class="col-md-9 center-block">
						<label>First Name</label>
						<input name="prenom"  type="text" id="prenom" class="form-control" style=";border-radius: 5px;" value="<?=$donnees['prenom']?>">
					</div>
					
				</div>

				<div class="form-group row">
					
					<div class="col-md-9 center-block">
						<label>Change your password</label>
						<input name="changepassword"  type="password" id="changepassword" class="form-control" style="border-radius: 5px;">
					</div>
					
				</div>

				<div class="form-group row">
					<input type="submit" value="Reset" class="btn col-md-8 center-block" name="Edituser" style="width: 290px;background-color: #8a6d3b;color: #efed40;">
				</div>

			</form>
		</div>
	</div>
</div>
</body>
</html>



