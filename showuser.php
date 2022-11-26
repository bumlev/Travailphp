<?php
include_once 'user.class.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width", initial-scale="1">
	<title>Liste des Membres</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
	
	<link rel="stylesheet"  type="text/css" href="css/ser06.css">
	<link rel="stylesheet"  type="text/css" href="css/form.css">
	
	<link rel="icon" type="image/png" href="logo_400x400.png" />
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/responsive-paginate.js"></script>
</head>
<body style="background: url('old_map_@2X.png');">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="min-height:72px;">
	
	<a href="#" class="navbar-brand">
		<img src="eglisevivantelogo.png" style="width:229px;margin-top:-23px;">
	</a>
	
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
			
			
			<?php
			if(substr($_SESSION['no'],0,4)=='EVJU')
			{
				?>
				<li class="nav-item active table-active" style="background-color:black;height:55px;"><a href="affiche.php" class="nav-link">List of members</a></li>
				<?php
			}
			?>
			<?php
			if(substr($_SESSION['no'],0,4)=='EVJU')
			{
				?>
				<li class="nav-item " style=" text-decoration:none;"><a href =editingprofil.php?nom=update&amp;id=<?=$_SESSION['id'] ?>" style="color: #fff;text-decoration:none;" class="nav-link">Edit Profil</a></li>
				<?php
			}
			?>
			
			<?php
			if(substr($_SESSION['no'],0,4)=='EVJU')
			{
				?>
				<li class="nav-item"><a href="user.class.php?log=<?=$nom ?>"  class="nav-link">Logout</a></li>
				<?php
			}
			?>
		
		</ul>
	
	</div>



</nav>

<div  class="container">
	
	
	
	
	<div class="form-row">
		<?php
		
		if (!isset($_SESSION['no']) And !isset($_SESSION['motdepa']))
		{
			header('location:formauthentification.php');
		}
		
		include_once 'user.class.php';
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
		
		$user=new user($bd);
		
		// $mb->affichnumb();
		?>
	</div>


</div>

<div class="table-responsive" style="padding-right:15px;padding-left:15px;" >
	
	<?php
	
	
	/////////// ajout d'un membre/////////////////////////////////////////////////////////////////////
	
	
	if(isset($_GET['search']) And isset($_GET['idsearch']))
	{
		$idsearchname=$_GET['idsearch'];
		$user->show_user($idsearchname);
	}
	?>
</div>
<div class="row"><a href="listeutilisateurs.php" style="margin-left: 40%" class="btn btn-primary ">Show All Users </a></div>
</body>
</html>



