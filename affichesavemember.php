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
			<ul class="nav navbar-nav navbar-right">
				<li><a><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']?></a></li>
				<!--li><a href="Administrateur.php" style="height:75px;">Report</a></li-->
			</ul>
		</div>
	
	</div>
</nav>

<div class="row" style="height:561px;">
	
	<div class="col-lg-2 navbar-inverse" style="margin-top: 77px;height: 139%;">
		<ul class="list-group" style="background-color: unset;border:none;">
			<li class="list-group-item " style="background-color: unset; border-radius: 20px;"><a href="listeutilisateurs.php" style="height:75px; color: #fff;text-decoration: none;">Users</a></li>
			<li class="list-group-item active" style="background-color: unset; border-radius: 20px;"><a href="listeutilisateurs.php" style="height:75px; color: #fff;text-decoration: none;">Registration of a Member</a></li>
			<!--<li class="list-group-item" style="background-color:unset; border-radius: 20px;"><a href="#" style="color: #fff;text-decoration:none;">Administrator</a></li>-->
			<li class="list-group-item" style="background-color:unset; border-radius: 20px;"><a href="createaccount.php" style="color: #fff;text-decoration:none;">Create Account</a></li>
			<li class="list-group-item" style="background-color:unset; border-radius: 20px;"><a href="Church Member.php" style="color: #fff;text-decoration:none;">Create a Member</a></li>
			<li class="list-group-item " style="background-color:unset; border-radius: 20px;"><a href="editingprofil.php?nom=update&amp;id=<?=$_SESSION['id'] ?>" style="color: #fff;text-decoration:none;">Edit Profil</a></li>
			<li class="list-group-item" style="background-color:unset; border-radius: 20px;"><a href="user.class.php?log=<?=$nom ?>" style="color: #fff;text-decoration: none;">Logout</a></li>
		</ul>
	</div>
	
	
	<div class="col-lg-10" style="margin-top: 176px;">
		
		<div  class="container">
			<div class="row ">
				<div class="panel panel-default " style="width: 980px;">
					
					<div class="panel-body">
						<h3> Registration of a Member</h3>
					</div>
				
				</div>
				
				<div class="row">
					<div class="col-md-4">
						<div class="form-inline">
							<input type="text" class="form-control form-inline" placeholder="Search" id="myin">
						</div>
					</div>
				</div>
				
				
				<?php
				
				include_once 'Membremanager.class.php';
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
				
				?>
			
			</div>
			<script>
				$(document).ready(function(){
					$("#myin").on("keyup", function() {
						var value = $(this).val().toLowerCase();
						$("#mytable tr").filter(function() {
							$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						});
					});
				});
			</script>
			
			<div class="row">
				
				<?php
				
				if (!isset($_SESSION['no']) And !isset($_SESSION['motdepa']))
				{
					header('location:formauthentification.php');
				}
				
				include_once 'Membremanager.class.php';
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
				
				$mb=new Membremanager($bd);
				
				// $mb->affichnumb();
				?>
				
				<?php
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
				
				$mb=new Membremanager($bd);
				
				/////////////////////////// instancier un membre et initiaiser ses donnees ////////////////////////////////////////////////////
				include_once('Membre.class.php');
				$membre = new Membre();
				
				$pattern='#[^0-9]#';
				
				
				if(isset($_POST['idnumb']))
				{
				if (preg_match($pattern, $_POST['idnumb']))
				{
				$test.='<label style="color:red;background-color:pink;" id="chiff" class="pull-right depl">oui </label> ';
				echo $test;
				}
				else
				{
				$test.='<label style="color:red;background-color:pink;" id="chiff" class="pull-right depl">non </label> ';
				echo $test;
				}
				}
				
				
				
				if (isset($_POST['id']) And isset($_POST['save']) )
				{
				$membre->setId($_POST['id'],$mb);
				}
				
				if (isset($_POST['id']) And isset($_POST['update']))
				$membre->setIdmodif($_POST['telnum'],$mb, $_POST['id']);
				
				
				if (isset($_POST['name']))
				$membre->setName($_POST['name']);
				
				if (isset($_POST['sex']))
				$membre->setSex($_POST['sex']);
				
				if (isset($_POST['nationality']))
				$membre->setNationality($_POST['nationality']);
				
				if (isset($_POST['se']))
				$membre->setSe($_POST['se']);
				
				if (isset($_POST['nyina']))
				$membre->setNyina($_POST['nyina']);
				
				if (isset($_POST['datebirth']))
				$membre->setDatebirth($_POST['datebirth']);
				
				if (isset($_POST['datebornagain']))
				$membre->setDatebornagain($_POST['datebornagain']);
				
				if (isset($_POST['datebaptiz']))
				$membre->setDatebaptiz($_POST['datebaptiz']);
				
				if (isset($_POST['akazi']))
				$membre->setFonction($_POST['akazi']);
				
				if (isset($_POST['membre']))
				$membre->setMember($_POST['membre']);
				
				if (isset($_POST['cellule']))
				$membre->setcellule($_POST['cellule']);
				
				if (isset($_POST['depart']))
				$membre->setdepartement($_POST['depart']);
				
				if (isset($_POST['studylevel']))
				$membre->setStudylevel($_POST['studylevel']);
				
				if (isset($_POST['faculty']))
				$membre->setFaculty($_POST['faculty']);
				
				if (isset($_POST['talent']))
				$membre->setTalent($_POST['talent']);
				
				if (isset($_POST['tel']))
				$membre->setTel($_POST['tel']);
				
				if (isset($_POST['email']))
				$membre->setEmail($_POST['email']);
				
				if (isset($_POST['intara']))
				$membre->setIntara($_POST['intara']);
				
				
				
				if (isset($_POST['akarere']))
				$membre->setAkarere($_POST['akarere']);
				
				if (isset($_POST['umurenge']))
				$membre->setUmurenge($_POST['umurenge']);
				
				if (isset($_POST['akagari']))
				$membre->setAkagari($_POST['akagari']);
				
				if (isset($_POST['umurimo']))
				$membre->setUmurimo($_POST['umurimo']);
				
				
				
				
				if (isset($_FILES['fichier']['name']) And isset($_POST['save']))
				{
				
				$membre->setimg($_FILES['fichier']['name']);
				
				// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
				
				if (isset($_FILES['fichier']) AND $_FILES['fichier']['error']== 0)
				{
				// Testons si le fichier n'est pas trop gros
				
				if ($_FILES['fichier']['size'] <=100000000000)
				{
				// Testons si l'extension est autorisée
				
				$infosfichier =  pathinfo($_FILES['fichier']['name']);
				$extension_upload = $infosfichier['extension'];
				$extensions_autorisees = array('jpg', 'jpeg', 'gif','png','JPG');
				
				if (in_array($extension_upload ,$extensions_autorisees) And !file_exists('uploads/'.basename($_FILES['fichier']['name'])))
				{
				// On peut valider le fichier et le stocker définitivement
				
				move_uploaded_file($_FILES['fichier']['tmp_name'], 'uploads/'.basename($_FILES['fichier']['name']));
				
				//echo "L'envoi a bien été effectué !";
				}
				}
				
				}
				
				
				
				}
				
				
				
				
				if (isset($_FILES['fichier']['name']) And isset($_POST['update']))
				{
				$membre->setimgmodif($_FILES['fichier']['name']);
				if(empty($_FILES['fichier']['name']) And isset($_POST['fich']))
				$membre->setimgmodif($_POST['fich']);
				
				// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
				
				if (isset($_FILES['fichier']) And $_FILES['fichier']['error'] == 0)
				{
				// Testons si le fichier n'est pas trop gros
				
				if ($_FILES['fichier']['size'] <=100000000000)
				{
				// Testons si l'extension est autorisée
				
				$infosfichier=pathinfo($_FILES['fichier']['name']);
				
				$extension_upload=$infosfichier['extension'];
				
				
				$extensions_autorisees=array('jpg', 'jpeg', 'gif','png','JPG','mp4');
				
				if (in_array($extension_upload ,$extensions_autorisees) And !file_exists('uploads/'.basename($_FILES['fichier']['name'])))
				{
				// On peut valider le fichier et le stocker définitivement
				
				move_uploaded_file($_FILES['fichier']['tmp_name'], 'uploads/'.basename($_FILES['fichier']['name']));
				
				//echo "L'envoi a bien été effectué !";
				}
				}
				
				}
				}
				
				//////////////////////////////     RECHERCHE DES MEMBRES //////////////////////////////////////////////////////////////
				
				
				$criteres='';
				
				if(isset($_POST['civilstatus']) And !empty($_POST['civilstatus']))
				$criteres.=" AND nationality LIKE '".$_POST['civilstatus']."'";
				
				if(isset($_POST['idnumb']) And !empty($_POST['idnumb']) )
				$criteres.=" AND idnumb LIKE '".$_POST['idnumb']."'";
				
				if(isset($_POST['name'])And !empty($_POST['name']))
				$criteres.=" AND ID LIKE '".$_POST['name']."'";
				
				if(isset($_POST['Se']) And !empty($_POST['Se']) )
				$criteres.=" AND Se LIKE '".$_POST['Se']."'";
				
				if(isset($_POST['user']) And !empty($_POST['user']))
				$criteres.=" AND Iduser LIKE '".$_POST['user']."'";
				
				if(isset($_POST['Nyina']) And !empty($_POST['Nyina']))
				$criteres.=" AND Nyina LIKE '".$_POST['Nyina']."'";
				
				if(isset($_POST['sex']) And !empty($_POST['sex']))
				$criteres.=" AND sex LIKE '".$_POST['sex']."'";
				
				if(isset($_POST['fonction']) And !empty($_POST['fonction']))
				$criteres.=" AND fonction LIKE '".$_POST['fonction']."'";
				
				if(isset($_POST['studylevel']) And !empty($_POST['studylevel']) )
				{
				
				$criteres.=" AND studylevel LIKE '".$_POST['studylevel']."'";
				}
				
				if(isset($_POST['faculty']) And !empty($_POST['faculty']))
				$criteres.=" AND faculty LIKE '".$_POST['faculty']."'";
				
				if(isset($_POST['talent']) And !empty($_POST['talent']))
				$criteres.=" AND talent LIKE '".$_POST['talent']."'";
				
				if(isset($_POST['intara']) And !empty($_POST['intara']))
				$criteres.=" AND intara LIKE '".$_POST['intara']."'";
				
				if(isset($_POST['akarere']) And !empty($_POST['akarere']))
				$criteres.=" AND akarere LIKE '".$_POST['akarere']."'";
				
				if(isset($_POST['umurenge']) And  !empty($_POST['umurenge']))
				$criteres.=" AND umurenge LIKE '".$_POST['umurenge']."'";
				
				if(isset($_POST['akagari']) And !empty($_POST['akagari']))
				$criteres.=" AND akagari LIKE '".$_POST['akagari']."'";
				
				if(isset($_POST['member']) And !empty($_POST['member']))
				$criteres.=" AND member LIKE '".$_POST['member']."'";
				
				/*         include 'pagin.php';
				
				if(isset($_POST['cherch']))
				{
				$mb->afficherech($criteres);
				*/?><!--
            <ul class="pagination">
          <li class="<?php /*if($curren=='1'){echo "disabled";} */?>"><a href="?z=<?php /*if($curren!='1'){echo($curren - 1); } else{echo $curren;}*/?>&&zz=<?php /*if(isset($_GET['zz'])) echo $_GET['zz'];*/?>&&criteres=<?php /*echo($criteres);*/?>">&laquo;</a></li>
           <?php
				/*              for($i=1;$i<=$nbpag;$i++)
							  {
							  
								   if($i==$curren)
								   {
									 */?>
                  <li class="active"><a href="?z=<?php /*echo $i;*/?>&&zz=<?php /*if(isset($_GET['zz'])) echo $_GET['zz'];*/?>&&$criteres=<?php /*echo $criteres;*/?>"><?php /*echo $i;*/?></a></li>

                  <?php
				/*                   }
								   else
								   {
									*/?>
                    <li><a href="?z=<?php /*echo $i;*/?>&&zz=<?php /*if(isset($_GET['zz'])) echo $_GET['zz'];*/?>&&$criteres=<?php /*echo $criteres;*/?>"><?php /*echo $i;*/?></a></li>
                  <?php
				/*                   }
							  
							  }
						   */?>
         <li class="<?php /*if($curren==$nbpag){echo "disabled";} */?>"><a href="?z=<?php /*if($curren!=$nbpag){echo($curren + 1); } else{echo $curren;} */?>&&zz=<?php /*if(isset($_GET['zz'])) echo $_GET['zz'];*/?>&&$criteres=<?php /*echo $criteres;*/?>">&raquo;</a></li>
         
         
      </ul>
      <?php
				/*         }
						  
						  if(isset($_GET['criteres']))
						  {
						  $criteres=$_GET['criteres'];
						  $mb->afficherech($criteres);
				
						  */?>
           <ul class="pagination">
          <li class="<?php /*if($curren=='1'){echo "disabled";} */?>"><a href="?z=<?php /*if($curren!='1'){echo($curren - 1); } else{echo $curren;}*/?>&&zz=<?php /*if(isset($_GET['zz'])) echo $_GET['zz'];*/?>&&$criteres=<?php /*echo $criteres;*/?>">&laquo;</a></li>
           <?php
				/*              for($i=1;$i<=$nbpag;$i++)
							  {
							  
								   if($i==$curren)
								   {
									 */?>
                  <li class="active"><a href="?z=<?php /*echo $i;*/?>&&zz=<?php /*if(isset($_GET['zz'])) echo $_GET['zz'];*/?>&&$criteres=<?php /*echo $criteres;*/?>"><?php /*echo $i;*/?></a></li>

                  <?php
				/*                   }
								   else
								   {
									*/?>
                    <li><a href="?z=<?php /*echo $i;*/?>&&zz=<?php /*if(isset($_GET['zz'])) echo $_GET['zz'];*/?>&&$criteres=<?php /*echo $criteres;*/?>"><?php /*echo $i;*/?></a></li>
                  <?php
				/*                   }
							  
							  }
						   */?>
         <li class="<?php /*if($curren==$nbpag){echo "disabled";} */?>"><a href="?z=<?php /*if($curren!=$nbpag){echo($curren + 1); } else{echo $curren;} */?>&&zz=<?php /*if(isset($_GET['zz'])) echo $_GET['zz'];*/?>&&$criteres=<?php /*echo $criteres;*/?>">&raquo;</a></li>
         
         
      </ul>-->
				
				<?php
				/* }*/
				
				/////////// ajout d'un membre/////////////////////////////////////////////////////////////////////
				if (isset($_POST['save']))
				{
					$mb->addmembre($membre);
					$mb->affichsave();
				}
				///////////////////////// Modifier un membre ///////////////////////////////////////////////
				if (isset($_POST['update']))
				{
					$mb->update($_POST['telnum'],$membre);
					$mb->affichemodif($_POST['telnum']);
				}
				
				//////////////////////supprimer un membre//////////////////////////////////////////////////////
				
				if (isset($_GET['id'])And isset($_GET['nom']) And $_GET['nom']=='delete')
				{
					$mb->deletemb($_GET['id']);
					$mb->affiche();
				}
				
				if(isset($_GET['search']) And isset($_GET['idsearch']))
				{
					$idsearchname=$_GET['idsearch'];
					$mb->searchname($idsearchname);
				}
				
				?>
				<a href="affiche.php" style="margin-left: 40%" class="btn btn-primary "> Show All members </a>
			</div>
		</div>
	
	</div>

</div>

</body>
</html>
