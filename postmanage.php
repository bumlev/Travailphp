

<?php
 
	require_once 'objet.php';
	$district='';
	if(isset($_POST['intara']))
	{
	
		$id_prov=$_POST['intara'];
		
		//$id_prov=1;
		$req=$bd->prepare('SELECT * FROM district WHERE id_province=:prov');
		$req->execute(array(
		'prov'=>$id_prov
		));
		
		
		if($_POST['intara']!=6)
		{
		
		$district.="<select class='custom-select' style='height:34px;border-radius:5px;' name='umurenge' id='umurenge'><option value=''>Select district...</option>";
		while($reponse=$req->fetch())
		{
			
			// $id_departement=$reponse['id_departement'];
				$district.="<option value=".$reponse['id_district'].">".htmlentities($reponse['nomdistrict'])."</option>";
		}
		
		$district.="</select>";
		}
		
		//return $district;
		echo $district;
		$req->closeCursor();
	
	}
	
	/////    SELECT AKARERE ////////////////////////////////////////


	if(isset($_POST['akarere']))
	{
		$id_dist=$_POST['akarere'];
		
		// echo $id_dist;
		
		$req=$bd->prepare('SELECT * FROM sectors WHERE id_district=:distri ORDER BY id_sector');
		$req->execute(array(
		'distri'=>$id_dist
		));
		
		  $secteur.="<select class='custom-select' style='height:34px;border-radius:5px;' id='akagari' name='akagari'><option value=''>Select sector...</option>";
			while($reponse=$req->fetch())
			{
				// $id_sport=$reponse['id_sport'];
				$secteur.="<option value=".$reponse['id_sector'].">".htmlentities($reponse['nomsector'])."</option>";
			}
		  $secteur.="</select>";
		  echo $secteur;
		//return $secteur;
		  $req->closeCursor();
	}
		////    SELECT UMURENGE /////////////////////////////////
		


	if(isset($_POST['umurenge']))
	{
		$id_sector=$_POST['umurenge'];
		
		// echo $id_dist;
		
		$req=$bd->prepare('SELECT * FROM cellule WHERE id_sector=:sector ORDER BY id_cellule');
		$req->execute(array(
		'sector'=>$id_sector
		));
		
		$cellule.="<select id='umudugudu' name='umudugudu'><option value=''>Select cellule...</option>";
			while($reponse=$req->fetch())
			{
				// $id_sport=$reponse['id_sport'];
				$cellule.="<option value=".$reponse['id_cellule'].">".htmlentities($reponse['nomcellule'])."</option>";
			}
		$cellule.="</select>";
		  echo $cellule;
		//return $secteur;
		$req->closeCursor();
	}
	
	
	
	/////////////////////////////////////////////////////  Recherche des membres //////////////////////////////////////////////////////
	
	
	if (isset($_POST['search']) And isset($_POST['ident']) And $_POST['search']=='sex')
	{
		$selesex='';
		$sex=$_POST['search'];
		$id=$_POST['ident'];
		$req=$bd->prepare('SELECT * FROM genre');
		$req->execute();
		
		$selesex.="<select class='form-control' name='$sex' id='champ".$id."'><option value=''>Select sex...</option>";
		while ($donnees=$req->fetch())
		{
			
		   $selesex.="<option value=".$donnees['nomgenre'].">".htmlentities($donnees['nomgenre'])."</option>";
		}
		   $selesex.="</select>";
		   echo  $selesex;
		   $req->closeCursor();
	}
	
	
	
	if (isset($_POST['search']) And isset($_POST['ident']) And $_POST['search']=='user')
	{
		$seleuser='';
		$user=$_POST['search'];
		$id=$_POST['ident'];
		$req=$bd->prepare('SELECT * FROM user');
		$req->execute();
		
		$seleuser.="<select class='form-control' name='$user' id='champ".$id."'><option value=''>Select user...</option>";
		while($donnees=$req->fetch())
		{
		   $seleuser.="<option value=".$donnees['Id'].">".htmlentities($donnees['nom'])." ".htmlentities($donnees['prenom']) ."</option>";
		
		}
		$seleuser.="</select>";
		echo  $seleuser;
		$req->closeCursor();
	}
	
	
	if (isset($_POST['search']) And isset($_POST['ident']) And $_POST['search']=='name')
	{
		$selecname='';
		$name=$_POST['search'];
		$id=$_POST['ident'];
		$req=$bd->prepare('SELECT * FROM membre');
		$req->execute();
		
		$selecname.="<select class='form-control' name='$name' id='champ".$id."'><option value=''>Select name...</option>";
		while($donnees=$req->fetch())
		{
		
		$selecname.="<option value=".$donnees['ID'].">".htmlentities($donnees['name']);
		$selecname.="</option>";
		
		}
		$selecname.="</select>";
		echo  $selecname;
		$req->closeCursor();
	}

	////////////////// Recherche par etat civil
	
	if (isset($_POST['search']) And isset($_POST['ident']) And $_POST['search']=='civilstatus')
	{
		$selecetatcivil='';
		$etatcivil=$_POST['search'];
		$id=$_POST['ident'];
		$req=$bd->prepare('SELECT * FROM etatcivil');
		$req->execute();
		
		$selecetatcivil.="<select class='form-control' name='$etatcivil' id='champ".$id."'><option value=''>civil status...</option>";
		while($donnees=$req->fetch())
		{
		$selecetatcivil.="<option value=".$donnees['nometatcivil'].">".htmlentities($donnees['nometatcivil']) ."</option>";
		
		}
		$selecetatcivil.="</select>";
		echo  $selecetatcivil;
		$req->closeCursor();
		
	}
	
	
	//////////////////////////////Recherche par niveau d'etude/////////////
	
	if (isset($_POST['search']) And isset($_POST['ident']) And $_POST['search']=='studylevel')
	{
	
		$selecstudylevel='';
		$studylevel=$_POST['search'];
		$id=$_POST['ident'];
		$req=$bd->prepare('SELECT * FROM niveauetude');
		$req->execute();
		
		$selecstudylevel.="<select class='form-control' name='$studylevel' id='champ".$id."'><option value=''>study level...</option>";
		while($donnees=$req->fetch())
		{
		$selecstudylevel.="<option value=".$donnees['levelname'].">".htmlentities($donnees['levelname']) ."</option>";
		
		}
		$selecstudylevel.="</select>";
		echo  $selecstudylevel;
		$req->closeCursor();
	
	}
	
	////////////////   Recherche par Departement de l'eglise///////////////////////////
	if (isset($_POST['search']) And isset($_POST['ident']) And $_POST['search']=='Department')
	{
	
		$selectdepart='';
		$departement=$_POST['search'];
		$id=$_POST['ident'];
		$req=$bd->prepare('SELECT * FROM departement');
		$req->execute();
		
		$selectdepart.="<select class='form-control' name='$departement' id='champ".$id."'><option value=''> Select department...</option>";
		while($donnees=$req->fetch())
		{
		$selectdepart.="<option value=".$donnees['nomdepart'].">".htmlentities($donnees['nomdepart']) ."</option>";
		
		}
		$selectdepart.="</select>";
		echo  $selectdepart;
		$req->closeCursor();
	
	}
	
	///////////////   recherche par cellule de priere
	if (isset($_POST['search']) And isset($_POST['ident']) And $_POST['search']=='Cell')
	{
	
		$selectcell='';
		$cell=$_POST['search'];
		$id=$_POST['ident'];
		$req=$bd->prepare('SELECT * FROM cellulepri');
		$req->execute();
		
		$selectcell.="<select class='form-control' name='$cell' id='champ".$id."'><option value=''> Select cell...</option>";
		while($donnees=$req->fetch())
		{
		$selectcell.="<option value=".$donnees['nomcell'].">".htmlentities($donnees['nomcell']) ."</option>";
		
		}
		$selectcell.="</select>";
		echo  $selectcell;
		$req->closeCursor();
	
	}
	
	
	////////////////////////////   MOTEUR DE RECHERCHE pour les membres //////////////////////////////////////////////
	
	
	
	if (isset($_POST['name'] ))
	{
		$name=$_POST['name'];
		$req=$bd->prepare("SELECT * FROM membre where CONCAT(first_name,last_name) LIKE '%".$name."%'");
		$req->execute();
		
		while($donnees=$req->fetch())
		{
		?>
		 <div style="background-color: white"><img width="50" height="50" src="uploads/<?php echo $donnees['image'];?>" style="border-radius: 50px;">&nbsp;<span><a href="affichesave.php?search=search&amp;idsearch=<?=md5($donnees['ID'])?>" ><?php echo $donnees['first_name'].' '.$donnees['last_name']; ?></a></span></div>
		
		<?php
		}

	}
?>


<?php
/////////////   MOTEUR DES RECHERCHES DES UTILISATEURS I ///////////////////////

if (isset($_POST['user'] ))
{
	?>
	<style>
		li:hover
		{
			background-color: #eee;
		}

	</style>
	<?php
	
	$user=$_POST['user'];
	$req=$bd->prepare("SELECT *  FROM user where CONCAT(nom,prenom) LIKE '%".$user."%'");
	$req->execute();
	
	$requete=$bd->prepare("SELECT COUNT(*) AS nb FROM user where CONCAT(nom,prenom) LIKE '%".$user."%'");
	$requete->execute();
	$count = $requete->fetch();
	?>
	<ul class="list-unstyled" style="background-color:white;cursor:pointer;">
		<?php
		if($count['nb'] > 0)
		{
			
		
			while($donnees=$req->fetch())
			{
				?>
				<li><?php echo $donnees['nom'].' '.$donnees['prenom']; ?></li>
				
				<?php
			}
		}
		else
		{
			?>
			<li>No Results Found...</li>
		<?php
		}
		?>
	</ul>
	
	
		<?php
}
/////////////////////  MOTEUR DE RECERCHE DES UTILISATEURS II /////////////////////


if (isset($_POST['user_name'] ))
{
	
	
	$user_name=$_POST['user_name'];
	$req=$bd->prepare("SELECT *  FROM user where CONCAT(nom,prenom) LIKE '%".$user_name."%'");
	$req->execute();
	
	$requete=$bd->prepare("SELECT COUNT(*) AS nb FROM user where CONCAT(nom,prenom) LIKE '%".$user_name."%'");
	$requete->execute();
	$count = $requete->fetch();
	
		if($count['nb'] > 0)
		{
			
			
			while($donnees=$req->fetch())
			{
				?>
				<div style="background-color:white;"><span><a href="showuser.php?search=search&amp;idsearch=<?=md5($donnees['Id'])?>" ><?php echo $donnees['nom'].' '.$donnees['prenom']; ?></a></span></div>
				
				<?php
			}
		}
		else
		{
			?>
			<div style="background-color:white;">No Results Found...</div>
			<?php
		}
		?>
	<
	
	
	<?php
}

/////////////////////  MOTEUR DE RECERCHE DES UTILISATEURS  PAR NUMERO DE SERIE  /////////////////////
if (isset($_POST['user_serialnumber'] ))
{
	
	
	$user_name=$_POST['user_serialnumber'];
	$req=$bd->prepare("SELECT *  FROM user where pseudo LIKE '%".$user_name."%'");
	$req->execute();
	
	$requete=$bd->prepare("SELECT COUNT(*) AS nb FROM user where pseudo LIKE '%".$user_name."%'");
	$requete->execute();
	$count = $requete->fetch();
		if($count['nb'] > 0)
		{
			
			
			while($donnees=$req->fetch())
			{
				?>
				<div style="background-color:white;"><span><a href="showuser.php?search=search&amp;idsearch=<?=md5($donnees['Id'])?>" ><?php echo $donnees['nom'].' '.$donnees['prenom']; ?></a></span></div>
				
				<?php
			}
		}
		else
		{
			?>
			<div>No Results Found...</div>
			<?php
		}
		?>
	</ul>
	
	
	<?php
}



////////////////////////////    MOTEUR DE RECHERCHE PAR GENRE  ///////////////////

if (isset($_POST['gender'] ))
{
	?>
	<style>
		li:hover
		{
			background-color: #eee;
		}

	</style>
	<?php
	$gender=$_POST['gender'];
	$req=$bd->prepare("SELECT * FROM genre where nomgenre LIKE '%".$gender."%'");
	$req->execute();
	
	$requete=$bd->prepare("SELECT COUNT(*) AS nb FROM genre where nomgenre LIKE '%".$gender."%'");
	$requete->execute();
	$count = $requete->fetch();
	?>
	<ul class="list-unstyled" style="background-color:white;cursor:pointer;">
		<?php
		if($count['nb'] > 0)
		{
			
			
			while($donnees=$req->fetch())
			{
				?>
				<li><?php echo $donnees['nomgenre'];?></li>
				
				<?php
			}
		}
		else
		{
			?>
			<li>No Results Found...</li>
			<?php
		}
		?>
	</ul>
	
	
	<?php
}
/////////////////////////////////  MOTEUR DE RECHERCHE PAR CELLULE ///////////////////

if (isset($_POST['cell'] ))
{
	?>
	<style>
		li:hover
		{
			background-color: #eee;
		}

	</style>
	<?php
	$cell=$_POST['cell'];
	$req=$bd->prepare("SELECT * FROM cellulepri where nomcell LIKE '%".$cell."%'");
	$req->execute();
	
	$requete=$bd->prepare("SELECT COUNT(*) AS nb FROM cellulepri where nomcell LIKE '%".$cell."%'");
	$requete->execute();
	$count = $requete->fetch();
	?>
	<ul class="list-unstyled" style="background-color:white;cursor:pointer;">
		<?php
		if($count['nb'] > 0)
		{
			
			
			while($donnees = $req->fetch())
			{
				?>
				<li><?php echo $donnees['nomcell'];?></li>
				
				<?php
			}
		}
		else
		{
			?>
			<li>No Results Found...</li>
			<?php
		}
		?>
	</ul>
	
	
	<?php
}
//////////////////////////    RECHERCHE PAR DEPARTEMENT   //////////////////////////


if (isset($_POST['department'] ))
{
	?>
	<style>
		li:hover
		{
			background-color: #eee;
		}

	</style>
	<?php
	$department=$_POST['department'];
	$req=$bd->prepare("SELECT * FROM departement where nomdepart LIKE '%".$department."%'");
	$req->execute();
	
	$requete=$bd->prepare("SELECT COUNT(*) AS nb FROM departement where nomdepart LIKE '%".$department."%'");
	$requete->execute();
	$count = $requete->fetch();
	?>
	<ul class="list-unstyled" style="background-color:white;cursor:pointer;">
		<?php
		if($count['nb'] > 0)
		{
			
			
			while($donnees=$req->fetch())
			{
				?>
				<li><?php echo $donnees['nomdepart'];?></li>
				
				<?php
			}
		}
		else
		{
			?>
			<li>No Results Found...</li>
			<?php
		}
		?>
	</ul>
	
	
	<?php
}
//////////////////////////////////////   RECHERCHE PAR ETAT CIVIL /////////////////////
if (isset($_POST['civilstatus'] ))
{
	?>
	<style>
		li:hover
		{
			background-color: #eee;
		}

	</style>
	<?php
	$civilstatus=$_POST['civilstatus'];
	$req=$bd->prepare("SELECT * FROM etatcivil where nometatcivil LIKE '%".$civilstatus."%'");
	$req->execute();
	
	$requete=$bd->prepare("SELECT COUNT(*) AS nb FROM etatcivil where nometatcivil LIKE '%".$civilstatus."%'");
	$requete->execute();
	$count = $requete->fetch();
	?>
	<ul class="list-unstyled" style="background-color:white;cursor:pointer;">
		<?php
		if($count['nb'] > 0)
		{
			
			
			while($donnees = $req->fetch())
			{
				?>
				<li><?php echo $donnees['nometatcivil'];?></li>
				
				<?php
			}
		}
		else
		{
			?>
			<li>No Results Found...</li>
			<?php
		}
		?>
	</ul>
	
	
	<?php
}
////////////////////////////////   RECHERCHE PAR NIVEAU D'ETUDE //////////////////


if (isset($_POST['level_study'] ))
{
	?>
	<style>
		li:hover
		{
			background-color: #eee;
		}

	</style>
	<?php
	$level_study=$_POST['level_study'];
	$req=$bd->prepare("SELECT * FROM niveauetude where levelname LIKE '%".$level_study."%'");
	$req->execute();
	
	$requete=$bd->prepare("SELECT COUNT(*) AS nb FROM niveauetude where levelname LIKE '%".$level_study."%'");
	$requete->execute();
	$count = $requete->fetch();
	?>
	<ul class="list-unstyled" style="background-color:white;cursor:pointer;">
		<?php
		if($count['nb'] > 0)
		{
			
			
			while($donnees=$req->fetch())
			{
				?>
				<li><?php echo $donnees['levelname'];?></li>
				
				<?php
			}
		}
		else
		{
			?>
			<li>No Results Found...</li>
			<?php
		}
		?>
	</ul>
	
	
	<?php
}


	////////// RECHERCHE DU NUMERO DE SERIE  DANS LE COMPTE  ADMINISTRATEUR ////////////////////////////////////////////////////
	


	function nbrenregistrement($type)
	{
		
		include 'objet.php';
		$req=$bd->prepare('SELECT COUNT(*) AS nb  FROM user where SUBSTRING(pseudo,1,4)=:pseudo ');
		$req->execute(array(
				'pseudo' =>$type
		));
		$row = $req->fetch();
		$lignes=$row['nb'];
		return $lignes;
	}

	 function dernierchiffres($type)
	{
		include 'objet.php';
		$req=$bd->prepare('SELECT chiffre FROM user where SUBSTRING(pseudo,1,4)=:pseudo ORDER BY Id DESC LIMIT 1');
		$req->execute(array(
				'pseudo' =>$type
		));
		$row=$req->fetch();
		$lignes=$row['chiffre'];
		return $lignes;
	}

function dernierlettres($type)
{
	include 'objet.php';
	$req=$bd->prepare('SELECT lettre FROM user where SUBSTRING(pseudo,1,4)=:pseudo ORDER BY Id DESC LIMIT 1');
	$req->execute(array(
		'pseudo' =>$type
	));
	$row = $req->fetch();
	$lignes = $row['lettre'];
	return $lignes;
}

function derniernombres_serie($type)
{
	include 'objet.php';
	$req=$bd->prepare('SELECT pseudo FROM user where SUBSTRING(pseudo,1,4)=:pseudo ORDER BY Id DESC LIMIT 1');
	$req->execute(array(
		'pseudo' =>$type
	));
	$row = $req->fetch();
	$lignes = $row['pseudo'];
	return $lignes;
}





 	function increment($type)
    {
	    $lignes = nbrenregistrement($type);
	   
	    if($lignes == 0)
	    {
		    return 'A001';
	    }
		   
	    $num = dernierchiffres($type) + 1;
		$lett = dernierlettres($type);
		$annee_nombre_serie = substr(derniernombres_serie($type),4,2);
	 
		
	    $actual_year = substr(date("Y",strtotime("now")),2,2)  ;
	    $difference_year = $actual_year - $annee_nombre_serie;
		
	    if($lignes > 0 && $num <=9 && $difference_year <= 0 )
			return $lett.'00'.$num;
	  
		elseif($lignes > 0 && $num <= 99 && $difference_year <= 0)
			return $lett.'0'.$num;
		
		elseif($lignes > 0 && $num <=999 && $difference_year <= 0)
			return $lett.$num;
		
		
			elseif($lignes > 0 && $num >=1000 && $difference_year <= 0)
			{
				if($num == 1000)
				{
					
					$lett++;
					$num = 1;
				}
				
				return $lett.'00'.$num;
			}
		
			
			if($lignes > 0 &&  $difference_year > 0)
			{
				return 'A001';
			}
			
    }
 
	
	
	if(isset($_POST['profil']))
	{
		$profil = $_POST['profil'];
		$req = $bd->prepare('SELECT * FROM role where id=:id LIMIT 1');
		$req->execute(array(
				'id' =>$profil
		));
		
		$donnees = $req->fetch();
		$type = $donnees['type'];
		
		$now_year = substr(date("Y",strtotime("now")),2,2);
		$type = $type.$now_year.increment($type);
		
		echo $type;
		$req->closeCursor();
		
	}
	?>

