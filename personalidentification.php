<?php
session_start();
?>
<!Doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="text/html">
	<meta name="viewport" content="width=device-width", initial-scale="2">
	<title class="after">Registration of members</title>
	<!--Bootstrap css-->
	
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


		<?php
		if (!isset($_SESSION['no']) And !isset($_SESSION['motdepa']))
		{
			header('location:formauthentification.php');
		}
		try
		{
			
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bd= new PDO('mysql:host=localhost;dbname=blog', 'root', '',
				$pdo_options);
			
			$req=$bd->prepare('SELECT * FROM membre
							
							INNER JOIN niveauetude ON membre.studylevel = niveauetude.idniveau
							INNER JOIN cellulepri ON membre.cellule = cellulepri.Idcell
							INNER  JOIN etatcivil ON membre.nationality = etatcivil.Idetatcivil
							INNER  JOIN genre ON membre.sex = genre.Idgenre
							 WHERE ID=:id');
			
			$req->execute(array(
				
				'id'=>$_GET['id']
			));
			
		}
		catch (Exception $e)
		{
			die('Erreur: '. $e->getMessage());
		}
		$donnees=$req->fetch();
		
		try
		{
			
			$req=$bd->prepare('SELECT * FROM member_department
							
							INNER JOIN departement ON member_department.id_department =departement.iddepart
							 WHERE id_member=:id');
			
			$req->execute(array(
				
				'id'=>$_GET['id']
			));
			
		}
		catch (Exception $e)
		{
			die('Erreur: '. $e->getMessage());
		}
		
		
		
		?>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="min-height:72px;">
			
			<?php
			if(isset($_SESSION['no']) And isset($_SESSION['motdepa']) And substr($_SESSION['no'],0,4) =='EVJA')
			{
				?>
				<span style="font-size:30px;cursor:pointer;color:white;" onclick="openNav()">&#9776;</span>
				<?php
			}
			?>
			<a class="navbar-brand" href="#"><img src="eglisevivantelogo.png" style="width:229px;margin-top:-23px;"></a>

			<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon "></span>
			</button>
			<?php
			if (!isset($_SESSION['no']) And !isset($_SESSION['motdepa']))
				header('location:formauthentification.php');
			
			$nom='logout';
			?>
			<div class="collapse navbar-collapse " id="navbarNav">

				<ul class="navbar-nav navbar-right mr-auto">
					<li class="nav-item"><a class="nav-link"><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']?></a></li>
					<!--<li class="nav-item"><a href="Church Management.php" class="nav-link">Registration of members</a></li>-->
					<?php
					if(substr($_SESSION['no'],0,4)=='EVJU')
					{
						?>
						<li class="nav-item active table-active " style="height:60px;background-color: black"><a href="affiche.php" class="nav-link">List of Members</a></li>
						<?php
					}
					?>
					
					<?php
					if(substr($_SESSION['no'],0,4)=='EVJU')
					{
						?>
						<li class="nav-item" style="background-color:unset; border-radius: 20px; text-decoration:none;"><a href ="modifierprofil.php?nom=update&amp;id=<?=$_SESSION['id'] ?>" style="color: #fff;text-decoration:none;" class="nav-link">Edit Profil</a></li>
						<?php
					}
					?>
					
					<?php
					if(substr($_SESSION['no'],0,4)=='EVJU')
					{
						?>
						<li class="nav-item"><a href="user.class.php?log=<?=$nom ?>" class="nav-link">Logout</a></li>
						
						<?php
					}
					?>
				</ul>

			</div>

		</nav>
		
		<?php
		if(substr($_SESSION['no'],0,4)=='EVJA')
		{
			
			?>

			<div id="mySidenav" class="sidenav ">
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
			<?php
		}
		?>



		<div class="col-md-8 offset-md-2 " style="margin-top:-69px;margin-bottom:20px;">

			<div class="card card-outline-secondary" style="margin-top:90px;">
				<div class="card-header" style="background-color: #8a6d3b;color: #efed40;">
					<h2 class="text-center">Identification of  <?php echo' '. $donnees['first_name'].' '.$donnees['last_name'];?></h2>
				</div>


				<div class="card-body" style="background-color: #f7e1b5;color:#8a6d3b;">
					
					<div class="table-responsive" style="margin-top: 76px;">
		<table class="table" style="width:80%; border:;background-color:wheat" align="center">
			<thead>
				<tr>
					<td style="font-weight: bold;">
						<table align="center">
							<tr><td style="text-align: left;">No y'irangamuntu:</td></tr>
							<tr><td style="text-align: left;">Amazina:</td></tr>
							<tr><td style="text-align: left;">Igitsina:</td></tr>
							<tr><td style="text-align: left;">Irangamirere:</td></tr>
							<tr><td style="text-align: left;">Itariki yavukiyeko:</td></tr>
						
						</table>
					</td>
					<td>
						<table>
							<tr><td><?php if(!empty($donnees['idnumb'])) echo $donnees['idnumb'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['first_name']) or !empty($donnees['last_name'])) echo $donnees['first_name'].'  '.$donnees['last_name'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['nomgenre'])) echo $donnees['nomgenre'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['nometatcivil'])) echo $donnees['nometatcivil'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['datebirth'])) echo $donnees['datebirth'];else echo'---';?></td></tr>
						
						</table>
					</td>
					<td style="border:none; background-color: transparent;"></td>
					<td><img  src="uploads/<?php echo $donnees['image'];?>" class="img-fluid  " style="width:150px;height:150px;margin-right: 10px;"></td>
				</tr>
			</thead>
			<tbody style="border-top:hidden;">
				<tr>
					<td style="font-weight:bold;">
						<table align="center">
							<tr> <td style="text-align: left;">Se:</td></tr>
							<tr> <td style="text-align: left;">Nyina:</td> </tr>
							<tr> <td style="text-align: left;">Itariki Yakirijweko:</td> </tr>
							<tr> <td style="text-align: left;">Itariki Yabatirijweko:</td> </tr>
							<tr> <td style="text-align: left;">Icyo Akora:</td> </tr>
							<tr> <td style="text-align: left;">Umunyetorero kuva:</td> </tr>
							<tr> <td style="text-align: left;">Cellule ubarizwamo:</td> </tr>
							<tr> <td style="text-align: left;">Umurimo ubarizwamo:</td> </tr>
							<tr> <td style="text-align: left;">Amashuri yize:</td></tr>
							<tr> <td style="text-align: left;">Ishami yize:</td> </tr>
							<tr> <td style="text-align: left;">Impanokaremano:</td> </tr>
							<tr> <td style="text-align: left;">Telephone:</td> </tr>
							<tr> <td style="text-align: left;">Email:</td> </tr>
							<tr> <td style="text-align: left;">Intara:</td> </tr>
							<tr> <td style="text-align: left;">Akarere:</td> </tr>
							<tr> <td style="text-align: left;">Umrenge:</td> </tr>
							<tr> <td style="text-align: left;">Akagari</td> </tr>
						
						</table>
					</td>
					<td>
						<table>
							<tr><td><?php if(!empty($donnees['se_firstname']) or !empty($donnees['se_lastname'])) echo $donnees['se_firstname'].' '.$donnees['se_lastname'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['nyina_firstname']) or !empty($donnees['nyina_lastname'])) echo $donnees['nyina_firstname'].' '.$donnees['nyina_lastname'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['datebornagain'])) echo $donnees['datebornagain'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['datebaptiz'])) echo $donnees['datebaptiz'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['fonction'])) echo $donnees['fonction'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['member'])) echo $donnees['member'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['nomcell'])) echo $donnees['nomcell'];else echo'---';?></td></tr>
							<tr><td><?php while($result =$req->fetch()){ if(!empty($result['nomdepart'])) echo $result['nomdepart'].'  ';else echo'---';}?></td></tr>
							<tr><td><?php if(!empty($donnees['levelname'])) echo $donnees['levelname'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['faculty'])) echo $donnees['faculty'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['talent'])) echo $donnees['talent'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['tel'])) echo $donnees['tel'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['email'])) echo $donnees['email'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['intara'])) echo $donnees['intara'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['akarere'])) echo $donnees['akarere'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['umurenge'])) echo $donnees['umurenge'];else echo'---';?></td></tr>
							<tr><td><?php if(!empty($donnees['akagari'])) echo $donnees['akagari'];else echo'---';?></td></tr>
						</table>
					</td>
					<td style="border:none; background-color: transparent;"></td>
				</tr>
			</tbody>
		</table>
	</div>
				
				
				
				
				
				
				
				
				</div>
			</div>

		</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
		<script>
			function openNav() {
				document.getElementById("mySidenav").style.width = "250px";
				/*document.getElementById("main").style.marginLeft = "250px";
				document.getElementById("pagination").style.visibility.hide();*/
			}

			function closeNav() {
				document.getElementById("mySidenav").style.width = "0";
				/*document.getElementById("main").style.marginLeft= "auto";
				document.getElementById("main").style.marginRight= "auto";*/
				/*	document.getElementById("pagination").style.display=inline;*/
			}
		</script>

</body>
</html>