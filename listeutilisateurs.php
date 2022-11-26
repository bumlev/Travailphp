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
	<title class="after"> Compte Administrateur </title>
	<link rel="icon" type="image/png" href="logo_400x400.png"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
	<link rel="stylesheet" href="fontawesome-free-5.2.0-web/css/all.css">

	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/dropdown.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/responsive-paginate.js"></script>

	<style>
		body {
			font-family: "Lato", sans-serif;
		}
		.line-separator{
			height:1px;
			background:#717171;
			border-bottom:1px solid #313030;

		}
		.sidenav {
			height: 100%;
			width: 0;
			position: fixed;
			z-index: 1;
			top: 0;
			left: 0;
			background-color: #111;
			overflow-x: hidden;
			transition: 0.5s;
			padding-top: 60px;
		}

		.sidenav a {
			padding: 20px 8px 20px 32px;
			text-decoration: none;
			font-size: 16px;
			color: #818181;
			display: block;
			transition: 0.3s;
		}

		.sidenav a:hover {
			color: #f1f1f1;
		}

		.sidenav .closebtn {
			position: absolute;
			top: -8px;
			right: 25px;
			font-size: 36px;
			margin-left: 50px;
		}
		.icons{
			margin-right: 5%;
		}

		#main {
			transition: margin-left .5s;
			padding: 16px;
		}

		@media screen and (max-height: 450px) {
			.sidenav {padding-top: 15px;}
			.sidenav a {font-size: 16px;}
		}
	</style>
	
	
	
	
	
	
</head>
<body style="background: url('old_map_@2X.png');">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark " style="min-height:72px;">

		<span style="font-size:30px;cursor:pointer;color:white;" onclick="openNav()">&#9776;</span>
		<a class="navbar-brand" href="#"><img src="eglisevivantelogo.png" style="width:229px;margin-top:-23px;"></a>
				<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon "></span>
				</button>
			
			<?php
			
			if(!isset($_SESSION['no']) or !isset($_SESSION['motdepa']) or substr($_SESSION['no'],0,4)!='EVJA')
				header('location:formauthentification.php');
			
				$nom='logout';
			?>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav navbar-right">
					<li class="nav-item"><a class="nav-link"><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']?></a></li>
					<!--li><a href="Administrateur.php" style="height:75px;">Report</a></li-->
				</ul>
			</div>
		
	</nav>







	<div id="mySidenav" class="sidenav " style="z-index:34;">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<div class="line-separator"></div>

		<a href="listeutilisateurs.php"><span><i class="fa fa-users icons"></i></span>Users</a>
		<div class="line-separator"></div>

		<a href="affiche.php"><span><i class="fa fa-list icons"></i></span>List of Members</a>
		<div class="line-separator"></div>
		<a href="createaccount.php" ><span><i class="fa fa-user icons"></i></span>Create Account</a>
		<div class="line-separator"></div>
		<a href="Church Member.php"><span><i class="fa fa-user-plus icons"></i></span>Create Member</a>
		<div class="line-separator"></div>
		<a href="editingprofil.php?nom=update&amp;id=<?=md5($_SESSION['id'])?>"><span><i class="fa fa-edit icons"></i></span>Edit Profil</a>
		<div class="line-separator"></div>
		<a href="user.class.php?log=<?=$nom ?>"><span><i class="fa fa-sign-out-alt icons"></i></span>Logout</a>
		<div class="line-separator"></div>
		
	</div>
	
		<div class="container" style="margin-top:-32px;padding-left: 15px;padding-right:15px;" >
			
			<div class="pull-left">
				<h1 class="fa fa-user icons" > Users</h1>
				<h4 class="fa fa-list icons"> Full list of users </h4>
			</div>
			<div class="form-group row  pull-right" style="margin-right: 2px;margin-top:64px;">
				<div class="col-md-6">
					<input type="text" name="user_name" style="margin-right:2px;width:220px;"  class="form-control" placeholder="Search by Name..." id="user_name" autocomplete="off">
					<div class="form-group" id="result_username" style="position: absolute; max-height:200px;overflow:auto;width: 175px;"></div>
				</div>
				<div class="col-md-6">
					<input type="text" name="user_serialnumber" style="width:220px;" class="form-control" placeholder="Search by Serial Number..." id="user_serialnumber" autocomplete="off">
					<div class="form-group" id="result_serialnumber" style="position: absolute; max-height:200px;overflow:auto;width: 175px;"></div>
					
				</div>
				
				
			</div>

			
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
	
	<script>
		$(document).ready(function(){
			$('#user_name').keyup(function(){
				var user_name=$(this).val();
				if(user_name !='')
				{
					$.post(
						'postmanage.php',
						{
							user_name:user_name
						},
						function(data)
						{
							/*$('#result_username').fadeIn();*/
							$('#result_username').html(data);

						});

				}
				else if(user_name =='')
				{
					$('#result_username').html('');
				}

			});

		});

		$(document).ready(function(){
			$('#user_serialnumber').keyup(function(){
				var user_serialnumber=$(this).val();
				if(user_serialnumber !='')
				{
					$.post(
						'postmanage.php',
						{
							user_serialnumber:user_serialnumber
						},
						function(data)
						{
							/*$('#result_username').fadeIn();*/
							$('#result_serialnumber').html(data);

						});

				}
				else if(user_serialnumber=='')
				{
					$('#result_serialnumber').html('');
				}

			});

		});

		$('.pagination').rPage();
		
		function openNav() {
			document.getElementById("mySidenav").style.width = "250px";
			document.getElementById("main").style.marginLeft = "250px";
		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
			document.getElementById("main").style.marginLeft= "auto";
			document.getElementById("main").style.marginRight= "auto";
		}
	</script>
	
	
</body>
</html>
