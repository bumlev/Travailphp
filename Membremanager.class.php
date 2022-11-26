<?php
 include_once 'user.class.php';
?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="text/html">
      <meta name="viewport" content="width=device-width", initial-scale="2">
  <title></title>
  <link rel="stylesheet" type="text/css" href="affi.css"/>
  <link rel="stylesheet" type="text/css" href="form.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
	<link rel="stylesheet" href="fontawesome-free-5.2.0-web/css/all.css">

	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/dropdown.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
    <?php


class Membremanager
{
  	private $db;
  
// Contructeur d'une classe Membremanager
  	function __construct($db)
  {
    $this->setdb($db);
  }

// Instancier une classe de la base de donnees
  	public function setdb(PDO $db)
  {
      $this->db=$db;
  }

  //recherche d'un idnumber similaire pour l'enregistrement
  	public function searchid($id)
   {
           $i=0;

           //recherche des idnumber national dans la table membre

           $requet=$this->db->query('SELECT * FROM membre');

           while ( $donnees=$requet->fetch() )
           {
              if ($donnees['idnumb']==$id And $donnees['idnumb']>0)
              {
                  $i++;
              }
           }
             
             $requet->closeCursor();
             return $i;
   }

// ajout d'un membre de l'eglise

   	public function addmembre(Membre $mb)
   {
      $iduser= $_SESSION['id'];
	   
    try
    {
          // insertion des donnees(enregistrement des membres)
		
               if ($mb->nbrenull()==0)
               {
				 $re=$this->db->prepare('INSERT  INTO  membre(idnumb,serialnumber,chiffre,lettre,annee,Iduser,first_name,last_name,sex,nationality,se_firstname,se_lastname,nyina_firstname,nyina_lastname,datebirth,datebornagain,datebaptiz,fonction,member,cellule,studylevel,faculty,talent,tel,email,intara,akarere,umurenge,akagari,umrimo,image) VALUES(:id,:serialnumber,:chiffre,:lettre,:annee,:Iduser,:first_name,:last_name,:sex,:nationality,:se_firstname,:se_lastname,:nyina_firstname,:nyina_lastname,:datebirth,:datebornagain,:datebaptiz,:fonction,:member,:cellule,:studylevel,:faculty,:talent,:tel,:email,:intara,:akarere,:umurenge,:akagari,:umrimo,:img)');
                 $re->execute(array(
                'id'=>$mb->id(),
                'Iduser'=>$iduser,
                'serialnumber' =>$this->new_serialnumber(),
                'chiffre' => $this->chiffre(),
                'lettre' => $this->lettre(),
                'annee' => date('Y',strtotime('now')),
                'first_name'=>$mb->first_name(),
                'last_name'=>$mb->last_name(),
                'sex'=>$mb->sex(),
                'nationality'=>$mb->nationality(),
                'se_firstname'=>$mb->se_firstname(),
                'se_lastname'=>$mb->se_lastname(),
                'nyina_firstname'=>$mb->nyina_firstname(),
                'nyina_lastname'=>$mb->nyina_lastname(),
                'datebirth'=>$mb->datebirth(),
                'datebornagain'=>$mb->datebornagain(),
                'datebaptiz'=>$mb->datebaptiz(),
                'fonction'=>$mb->fonction(),
                'member'=>$mb->member(),
                'cellule'=>$mb->cellule(),
                'studylevel'=>$mb->studylevel(),
                'faculty'=>$mb->faculty(),
                'talent'=>$mb->talent(),
                'tel'=>$mb->tel(),
                'email'=>$mb->email(),
                'intara'=>$mb->intara(),
                'akarere'=>$mb->akarere(),
                'umurenge'=>$mb->umurenge(),
                'akagari'=>$mb->akagari(),
                'umrimo'=>$mb->umurimo(),
                'img'=>$mb->img()
                     ));
                echo '<script> alert(" Saving succeded");</script>';
                $requet = $this->db->prepare('INSERT INTO member_department (id_member,id_department) VALUES ((SELECT MAX(ID) FROM membre),:id_department)');
                $requet->execute(array(
                		'id_department' => $mb->departement(),
				));
               
               }

    }

    catch (Exception $e)
    {

      die('Erreur:'. $e->getMessage());
    }

   }
		
		//Afficher la liste des membres de l'egise
  
	public function affiche()
   {
       include 'pagination.php';
       $requet=$this->db->prepare('SELECT *  FROM membre

					INNER JOIN niveauetude ON membre.studylevel = niveauetude.idniveau
					INNER JOIN cellulepri ON membre.cellule = cellulepri.Idcell
					INNER JOIN etatcivil ON membre.nationality = etatcivil.Idetatcivil
					INNER JOIN genre ON membre.sex = genre.Idgenre
					INNER JOIN user ON membre.Iduser = user.Id

 				ORDER BY membre.ID DESC LIMIT'.' '.$firstofpage.', '.$perpage.'');
       $requet->execute();
       ?>
       
        <table style="background-color: white;" class="table table-responsive-md">
			  	<thead style="background-color:chocolate;color:white">
					<tr>
						<th>Nimero y'irangamuntu </th>
						<th>Izina</th>
						<th>Igitsina</th>
						<th>Irangamirere</th>
						<th>Itariki Yavukiyeko</th>
						<th>Itariki Yakirijweko</th>
						<th>Itariki Yabatirijweko</th>
						<th>Uwari kuri sytem</th>
						<th></th>
						<th></th>
					</tr>
				</thead>

                <tbody id="mytable">
       <?php
	   if($this->nbrenregistrement() > 0)
	   {
		  
		
         while ( $donnees=$requet->fetch() )
           {
             ?>
		   <tr>
				<th><?php echo $donnees['idnumb'];?></th>
				<th><?php echo $donnees['first_name'].' '.$donnees['last_name'];?></th>
				<th><?php echo $donnees['nomgenre'];?></th>
				<th><?php echo $donnees['nometatcivil'];?></th>
				<th><?php echo $donnees['datebirth'];?></th>
				<th><?php echo $donnees['datebornagain'];?></th>
				<th><?php echo $donnees['datebaptiz'];?></th>
			 	<th><?php echo $donnees['nom'].' '.$donnees['prenom'];?></th>
			  
				<?php
				if(isset($_SESSION['no']) and isset($_SESSION['motdepa']) and substr($_SESSION['no'],0,4)=='EVJA')
				{
				?>
					<th>
						<a id="create_Department_<?php echo $donnees['ID'];?>" class="btn btn-success"  style="color:white;">Create Department</a>
						<span id="member" class="hidden"><?php echo json_encode($donnees);?></span>
					</th>
				<?php
				}
				?>
				<?php
				if(isset($_SESSION['no']) and isset($_SESSION['motdepa']) and substr($_SESSION['no'],0,4)=='EVJA')
				{
				?>
					<th><a href="affiche.php?nom=delete&amp;id=<?=md5($donnees['ID'])?>" ><button class="btn btn-danger ">Delete</button> </a></th>
				<?php
				}
				?>
				 <?php
	           if(isset($_SESSION['no']) and isset($_SESSION['motdepa']) and substr($_SESSION['no'],0,4)=='EVJA')
	           {
		           ?>
                    <th><a href="formodifier.php?nom=update&amp;id=<?=$donnees['ID']?>"><button class=" btn btn-info fa fa-edit ">Edit</button></a></th>
					<?php
	           }
	           ?>
				<th><a href="personalidentification.php?nom=info&amp;id=<?=$donnees['ID'] ?>"  class=" btn btn-info">More</a></th>

			</tr>


          <?php
           }
	   }
	   elseif($this->nbrenregistrement() ==0)
	   {
		   ?>
		   <th colspan="10" style="text-align:center;">No Data found...</th>
		   <?php
	   }
             $requet->closeCursor();
           
           ?>
          </tbody>
        </table>
      

      <ul class="pagination" id="pagination" style="visibility:visible;">
          <li class="<?php if($current=='1'){echo "disabled";} ?>"><a href="?p=<?php if($current !='1'){echo($current-1); } else{echo $current;}?>&&pp=<?php if(isset( $_GET['pp'])) echo $_GET['pp'];?>#app">&laquo;</a></li>
           <?php
              for($i=1;$i<=$nbpage;$i++)
              {
                   if($i==$current)
                   {
                     ?>
                  	<li class="active"><a href="?p=<?php echo $i;?>&&pp=<?php if(isset( $_GET['pp'])) echo $_GET['pp'];?>#app"><?php echo $i;?></a></li>

                  <?php
                   }
                   else
                   {
					   
                    ?>
					<li><a href="?p=<?php echo	$i;?>&&pp=<?php if(isset( $_GET['pp'])) echo $_GET['pp'];?>#app"><?php echo $i;?></a></li>
                  <?php
					   
                   }
				 
              }
           ?>
		  
         <li class="<?php if($current==$nbpage){echo "disabled";} ?>"><a href="?p=<?php if($current!=$nbpage){echo($current+1); } else{echo $current;} ?>&&pp=<?php if(isset($_GET['pp'])) echo $_GET['pp'];?>#app">&raquo;</a></li>
		  
      </ul>
<?php
   }

	public function affichemodif($id)
   {
       
       $requet=$this->db->prepare('SELECT * FROM membre
			
			INNER JOIN niveauetude ON membre.studylevel = niveauetude.idniveau
			INNER JOIN cellulepri ON membre.cellule = cellulepri.Idcell
			INNER  JOIN etatcivil ON membre.nationality = etatcivil.Idetatcivil
			INNER JOIN genre ON membre.sex = genre.Idgenre
			INNER JOIN user ON membre.Iduser = user.Id
			WHERE membre.ID=:id LIMIT 1');
       $requet->execute(array(
           'id'=>$id
       ));
       ?>
        <table style="background-color: white;" class="table">

			<thead style="background-color:chocolate;color:white">
				<tr>
					<th>Nimero y'irangamuntu </th>
					<th>Izina</th>
					<th>Igitsina</th>
					<th>Irangamirere</th>
					<th>Itariki Yavukiyeko</th>
					<th>Itariki Yakirijweko</th>
					<th>Itariki Yabatirijweko</th>
					<th>Uwari kuri sytem</th>
					<th></th>
					<th></th>

				</tr>
			</thead>
                <tbody id="mytable">
       <?php
         while ( $donnees=$requet->fetch() )
           {
             ?>
               <tr>
				<th><?php echo $donnees['idnumb'];?></th>
				<th><?php echo $donnees['first_name'].' '.$donnees['last_name'];?></th>
				<th><?php echo $donnees['nomgenre'];?></th>
				<th><?php echo $donnees['nometatcivil'];?></th>
				<th><?php echo $donnees['datebirth'];?></th>
				<th><?php echo $donnees['datebornagain'];?></th>
				<th><?php echo $donnees['datebaptiz'];?></th>
				<th><?php echo $donnees['nom'].' '.$donnees['prenom'];?></th>
			   <!--<th><a href="affiche.php?nom=delete&amp;id=<?/*=$donnees['ID'] */?>#app" ><button class="br">Delete</button> </a></th>-->
	           <?php
	           if(isset($_SESSION['no']) and isset($_SESSION['motdepa']) and substr($_SESSION['no'],0,4)=='EVJA')
	           {
		           ?>
				   <th><a href="formodifier.php?nom=update&amp;id=<?=$donnees['ID']?>"><button class=" btn btn-info fa fa-edit ">Edit</button></a></th>
		           <?php
	           }
	           ?>
			   <th><a href="personalidentification.php?nom=info&amp;id=<?=$donnees['ID'] ?>" class=" btn btn-info">More</a></th>
				  
			   <!--<th ><a href="affiche.php?nom=delete&amp;id=<?/*=$donnees['ID'] */?>" ><button class="br">Delete</button> </a></th>-->
                </tr>


          <?php
           }
             
             $requet->closeCursor();
           
           ?>
          </tbody>
        </table>
<?php
   }
		
	public function nbrenregistrement()
     {
         $requet = $this->db->prepare('SELECT COUNT(*) AS nb FROM membre');
         $requet->execute();
         $row = $requet->fetch();
         $lignes = $row['nb'];
         return  $lignes;
     }
		
	public function count_registration()
	{
		$actual_date =  date('y' , strtotime('now'));
		$requet=$this->db->prepare('SELECT COUNT(*) AS nb FROM membre WHERE annee=:actual_date ORDER BY ID DESC LIMIT 1');
		$requet->execute(array
		(
			'actual_date' => $actual_date,
		));
		$row=$requet->fetch();
		$lignes=$row['nb'];
		return  $lignes;
	}
// AFFICHER UN SEUL ENREGISTREMENT APRES AVOIR ENREGISTRE UN MEMBRE/////////////////////////////////
	public function affichsave()
  	{
       $requet=$this->db->prepare('SELECT * FROM membre
		
		INNER JOIN niveauetude ON membre.studylevel = niveauetude.idniveau
		INNER JOIN cellulepri ON membre.cellule = cellulepri.Idcell
		INNER JOIN etatcivil ON membre.nationality = etatcivil.Idetatcivil
		INNER JOIN genre ON membre.sex =genre.Idgenre
		INNER JOIN user ON membre.Iduser = user.Id
		WHERE membre.ID =(SELECT MAX(ID) FROM membre)');
       $requet->execute();
       ?>
        <table style="background-color:white;" class="table" >
			
			<thead style="background-color:chocolate;color:white;">
     
					<tr>
						<th>Nimero y'irangamuntu </th>
						<th>Izina</th>
						<th>Igitsina</th>
						<th>Irangamirere</th>
						<th>Itariki Yavukiyeko</th>
						<th>Itariki Yakirijweko</th>
						<th>Itariki Yabatirijweko</th>
						<th>Uwari kuri sytem</th>
					</tr>
			</thead>
                <tbody id="mytable">
		
       <?php
            while ($donnees=$requet->fetch())
            {
				
             ?>
               <tr>
					<th><?php echo $donnees['idnumb'];?></th>
					<th><?php echo $donnees['first_name'].'  '.$donnees['last_name'];?></th>
					<th><?php echo $donnees['nomgenre'];?></th>
					<th><?php echo $donnees['nometatcivil'];?></th>
					<th><?php echo $donnees['datebirth'];?></th>
					<th><?php echo $donnees['datebornagain'];?></th>
					<th><?php echo $donnees['datebaptiz'];?></th>
				   <th><?php echo $donnees['nom'].' '.$donnees['prenom'];?></th>
                    <!--<th><a href="affiche.php?nom=delete&amp;id=<?/*=$donnees['ID'] */?>"><button class="br">Delete</button> </a></th>-->
	               <?php
	               if(isset($_SESSION['no']) and isset($_SESSION['motdepa']) and substr($_SESSION['no'],0,4)=='EVJA')
	               {
		               ?>
					   <th><a href="formodifier.php?nom=update&amp;id=<?=$donnees['ID']?>"><button class=" btn btn-info fa fa-edit ">Edit</button></a></th>
		               <?php
	               }
	               ?>
					<th><a href="personalidentification.php?nom=info&amp;id=<?=$donnees['ID'] ?>" ><button class="btn btn-info">More</button></a></th>
                </tr>


          <?php
        
           }
            
             $requet->closeCursor();
           ?>
          </tbody>
        </table>
<?php

  }
		

  /// Recherche d'un nom
   	public function searchname($id)
  {
       $req=$this->db->prepare('SELECT * FROM membre
		
		INNER JOIN niveauetude ON membre.studylevel = niveauetude.idniveau
		INNER JOIN cellulepri ON membre.cellule = cellulepri.Idcell
		INNER JOIN etatcivil ON membre.nationality = etatcivil.Idetatcivil
		INNER JOIN genre ON membre.sex = genre.Idgenre
		INNER JOIN user ON membre.Iduser = user.Id
		where md5(membre.ID)=:id LIMIT 1' );
       
       $req->execute(array(
        'id'=>$id
       ));
       ?>
	  <label><h2>Results of Search</h2></label>
        <table style="background-color:white;margin-top:10px;" class="table ">
			<thead style="background-color: chocolate;color:white">
      
						<tr>
							<th>Nimero y'irangamuntu </th>
							<th>Izina</th>
							<th>Igitsina</th>
							<th>Irangamirere</th>
							<th>Itariki Yavukiyeko</th>
							<th>Itariki Yakirijweko</th>
							<th>Itariki Yabatirijweko</th>
							<th>Uwari kuri sytem</th>
						</tr>
			</thead>
                <tbody id="mytable">
       <?php
            $i=0;
            while ($donnees=$req->fetch())
            {
             
             ?>
			<tr>
					<th><?php echo $donnees['idnumb'];?></th>
					<th><?php echo $donnees['first_name'].' '.$donnees['last_name'];?></th>
					<th><?php echo $donnees['nomgenre'];?></th>
					<th><?php echo $donnees['nometatcivil'];?></th>
					<th><?php echo $donnees['datebirth'];?></th>
					<th><?php echo $donnees['datebornagain'];?></th>
					<th><?php echo $donnees['datebaptiz'];?></th>
					<th><?php echo $donnees['nom'].' '. $donnees['prenom'];?></th>
					<?php
					if(isset($_SESSION['no']) and isset($_SESSION['motdepa']) and substr($_SESSION['no'],0,4)=='EVJA')
					{
					   ?>
					   <th>
						   <a id="create_Department_<?php echo $donnees['ID'];?>" class="btn btn-success"  style="color:white;">Create Department</a>
						   <span id="member" class="hidden"><?php echo json_encode($donnees);?></span>
					   </th>
					   <?php
					}
					?>
				
				   <th><a href="affiche.php?nom=delete&amp;id=<?=md5($donnees['ID']); ?>" ><button class="btn btn-danger ">Delete</button> </a></th>
	               <?php
	               if(isset($_SESSION['no']) and isset($_SESSION['motdepa']) and substr($_SESSION['no'],0,4)=='EVJA')
	               {
		               ?>
					   <th><a href="formodifier.php?nom=update&amp;id=<?=$donnees['ID']?>"><button class=" btn btn-info fa fa-edit ">Edit</button></a></th>
		               <?php
	               }
	               ?>
                
				   <th><a href="personalidentification.php?nom=info&amp;id=<?=$donnees['ID'] ?>" class="btn btn-info">More</a></th>
			</tr>


          <?php
           
           }
            
             $req->closeCursor();
           ?>
          </tbody>
        </table>
   
<?php

  }
		
// Supprimer un membre de l'eglise
  	public function deletemb($id)
  {
      $re=$this->db->prepare('DELETE FROM membre WHERE md5(ID)=:id LIMIT 1');
      $re->execute(array(
       'id'=> $id
      ));
      $re->closeCursor();
  }
		
//recherche d'un ID pour la modification des donnees
  	public function rechercheID($id)
  {
           $i=0;
            //recherche des idnumber national dans la table membre
           $requet=$this->db->query('SELECT * FROM membre');

           while ( $donnees=$requet->fetch() )
           {
              if ($donnees['ID']==$id And $donnees['idnumb']>0)
              {
                   $i=$donnees['idnumb'];
              }
           }
             
             $requet->closeCursor();
             return $i;
  }

// Modification des donnees des membres de l'eglise
  	public function update($id,Membre $mb)
  {
	  
			  	$iduser= $_SESSION['id'];
	try
    {
          // Modification des donnees(Modification des membres)
               if ($mb->nbrenull()==0)
               {
                 $re=$this->db->prepare('UPDATE   membre SET idnumb=:idnumb,Iduser=:Iduser,first_name=:first_name,last_name=:last_name,sex=:sex,nationality=:nationality,se_firstname=:se_firstname,se_lastname=:se_lastname,nyina_firstname=:nyina_firstname,nyina_lastname=:nyina_lastname,datebirth=:datebirth,datebornagain=:datebornagain,datebaptiz=:datebaptiz,fonction=:fonction,member=:member,cellule=:cellule,studylevel=:studylevel,faculty=:faculty,talent=:talent,tel=:tel,email=:email,intara=:intara,akarere=:akarere,umurenge=:umurenge,akagari=:akagari,umrimo=:umrimo,image=:image WHERE ID=:id LIMIT 1');
				   
                 $re->execute(array(
                'id'=>$id,
                'Iduser'=>$iduser,
                'idnumb'=>$mb->id(),
                'first_name'=>$mb->first_name(),
                'last_name'=>$mb->last_name(),
                'sex'=>$mb->sex(),
                'nationality'=>$mb->nationality(),
                'se_firstname'=>$mb->se_firstname(),
                'se_lastname'=>$mb->se_lastname(),
                'nyina_firstname'=>$mb->nyina_firstname(),
                'nyina_lastname'=>$mb->nyina_lastname(),
                'datebirth'=>$mb->datebirth(),
                'datebornagain'=>$mb->datebornagain(),
                'datebaptiz'=>$mb->datebaptiz(),
                'fonction'=>$mb->fonction(),
                'member'=>$mb->member(),
                'cellule'=>$mb->cellule(),
                'studylevel'=>$mb->studylevel(),
                'faculty'=>$mb->faculty(),
                'talent'=>$mb->talent(),
                'tel'=>$mb->tel(),
                'email'=>$mb->email(),
                'intara'=>$mb->intara(),
                'akarere'=>$mb->akarere(),
                'umurenge'=>$mb->umurenge(),
                'akagari'=>$mb->akagari(),
                'umrimo'=>$mb->umurimo(),
                'image'=>$mb->img()
                     ));
				echo '<script> alert(" Modification reussi")</script>';
               }
    }

    catch (Exception $e)
    {

      die('Erreur:'. $e->getMessage());
    }
  }

  	public function selectgender()
   {
	   $req=$this->db->prepare("SELECT * FROM genre");
	   $req->execute();
    ?>
       <select class="custom-select"  name="sex" id="sex" size="0" style="height:33px;border-radius:5px;">
		   
			<option selected="selected" value="<?php echo null;?>"><?php echo htmlentities('Select Gender...');?></option>
			<?php
			$i=1;
			while ($donnees=$req->fetch())
			{
				?>
				<option value="<?=$donnees['Idgenre']?>"><?php echo htmlentities($donnees['nomgenre']);$i++;?></option>
				<?php
			}
			?>
        </select>
   <?php
   }
		
	public function selectgendermodif($idgenre , $nomgenre)
	{
		
		$req=$this->db->prepare("SELECT * FROM genre");
		$req->execute();
		?>
		<select class="form-control" name="sex" id="sex" size="0">
			<option selected="selected" value="<?=$idgenre?>"><?php echo $nomgenre;?> </option>
			<?php
			while ($donnees=$req->fetch())
			{
				?>
				<option value="<?php echo $donnees['Idgenre'];?>"><?php echo $donnees['nomgenre'];?></option>
				<?php
			}
			?>
		</select>
		<?php
	}

  	public function selectetatcivil()
  {
     $req=$this->db->prepare("SELECT * FROM etatcivil");
     $req->execute();
   ?>
	  <select class="custom-select" name="nationality" id="etatcivil" size="0" style="height:34px;border-radius:5px;">
        <option selected="selected" value="<?php echo null;?>"><?php echo htmlentities('Select Civil Status...');?></option>
   		<?php
        $i=1;
         while ($donnees=$req->fetch())
         {
	   	?>
         <option value="<?php echo $donnees['Idetatcivil'] ?>"><?php echo htmlentities($donnees['nometatcivil']);$i++;?></option>
       <?php
         }
         
     	?>
	  </select>

   <?php

  }

  	public function selectetatcivilmo($idetatcivil,$etatcivil)
  {
      $req=$this->db->prepare("SELECT * FROM etatcivil");
     $req->execute();
   ?>
     <select class="form-control" name="nationality" size="0">
        <option selected="selected" value="<?php echo $idetatcivil;?>"><?php echo $etatcivil;?></option>
   <?php
        $i=1;
         while ($donnees=$req->fetch())
         {
           ?>
           
         <option value="<?php echo $donnees['Idetatcivil'] ?>"><?php echo($donnees['nometatcivil']);$i++;?></option>
       <?php
         }
         
     ?>

     </select>
   <?php


  }

   	public function selectstudylevel()
  {
     $req=$this->db->prepare("SELECT * FROM niveauetude");
     $req->execute();
   ?>
     <select class="custom-select"  name="studylevel" size="0" style="height:34px;border-radius:5px;">
        <option selected="selected" value="0"><?php echo htmlentities('Select Level of Study...');?></option>
   <?php
        $i=1;
         while ($donnees=$req->fetch())
         {
           ?>
           
         <option value="<?php echo $donnees['idniveau']; ?>"><?php echo htmlentities($donnees['levelname']);?></option>
       <?php
         }
         
     ?>

     </select>
   <?php

  }
		
	public function selectstudymodif($idniveau,$niveau)
      {
           $req=$this->db->prepare("SELECT * FROM niveauetude");
           $req->execute();
      ?>

      <select class="form-control" name="studylevel" id="studylevel" size="0">
           <option selected="selected" value="<?=$idniveau?>"><?php echo htmlentities($niveau) ;?> </option>
       <?php
       while ($donnees=$req->fetch())
       {
        ?>
           <option value="<?php echo $donnees['idniveau'];?>"><?php echo htmlentities($donnees['levelname']);?></option>
      <?php
       }
        ?>
      </select>
      <?php

       }
		
	public function selectcell()
    {
      $req=$this->db->prepare("SELECT * FROM cellulepri");
      $req->execute();
        ?>
     <select class="custom-select" name="cellule" id="cellule" size="0" style="height:33px;border-radius:5px;">
        <option selected="selected" value="0"><?php echo('Select Cell...');?></option>
        <?php
        $i=1;
         while ($donnees=$req->fetch())
         {
        ?>
         
         <option value="<?php echo $donnees['Idcell'] ;?>"><?php echo($donnees['nomcell']);?></option>
        <?php
         }
         
        ?>
     </select>
      <?php

    }
    
	public function selectcellmodif($idcell,$nomcell)
    {

           $req=$this->db->prepare("SELECT * FROM cellulepri");
           $req->execute();
      ?>

      <select class="custom-select" name="cellule" id="cellulepri" size="0" style="height:34px;border-radius:5px;">
           <option selected="selected" value="<?=$idcell?>"><?php echo $nomcell;?> </option>
       <?php
       while ($donnees=$req->fetch())
       {
        
        ?>
           <option value="<?php echo $donnees['Idcell'];?>"><?php echo $donnees['nomcell'];?></option>
      <?php
       }
        ?>
      </select>
      <?php

    }

	public function selectdepart()
   {
     	$req=$this->db->prepare("SELECT * FROM departement");
      	$req->execute();
        ?>
     	<select class="custom-select" name="depart" id="depart" size="0" style="height:34px;border-radius:5px;">
			<option selected="selected" style="text-align:center;" value="0"><?php echo htmlentities('Select Department...');?></option>
        <?php
       
         while ($donnees=$req->fetch())
         {
           ?>
         <option value="<?php echo $donnees['Iddepart'];?>"><?php echo($donnees['nomdepart']);?></option>
        <?php
         }
       ?>
     	</select>
      <?php
   }

	public function selectdepartmodif($depart)
  {
    
	  	$req=$this->db->prepare("SELECT * FROM departement");
	  	$req->execute();
      ?>
	  	<select class="form-control" name="depart" id="departement" size="0">
		  <option selected="selected" value="<?=$depart?>"><?php echo $depart;?></option>
       <?php
       while ($donnees=$req->fetch())
       {
        
        ?>
           <option value="<?php echo $donnees['nomdepart'];?>"><?php echo $donnees['nomdepart'];?></option>
      <?php
       }
        ?>
      	</select>
      <?php
  }
		
	public function createdepartment_members( $id_member,$id_department)
	{
		
		try
		{
			$requet = $this->db->prepare('INSERT INTO member_department(id_member,id_department) VALUES (:id_member ,:id_department)');
			$requet->execute(array(
				'id_member' => $id_member,
				'id_department' =>$id_department
			));
		}
		catch (Exception $e)
		{
			die('Erreur:'.$e->getMessage());
		}
		
	}
	
	public function testadd(Membre $mb)
	{
		$utilisateur= $_SESSION['nom']." ".$_SESSION['prenom'];
		$iduser= $_SESSION['id'];
		
		
		try
		{
			
			
			// insertion des donnees(enregistrement des membres)
			
				$re=$this->db->prepare('INSERT  INTO  membre(idnumb,Iduser,utilisateur,name,sex,nationality,Se,Nyina,datebirth,datebornagain,datebaptiz,fonction,member,cellule,departement,studylevel,faculty,talent,tel,email,intara,akarere,umurenge,akagari,umrimo,image) VALUES(:id,:Iduser,:utilisateur,:name,:sex,:nationality,:se,:nyina,:datebirth,:datebornagain,:datebaptiz,:fonction,:member,:cellule,:departement,:studylevel,:faculty,:talent,:tel,:email,:intara,:akarere,:umurenge,:akagari,:umrimo,:img)');
				$re->execute(array(
					'id'=>$mb->id(),
					'Iduser'=>$iduser,
					'utilisateur'=>$utilisateur,
					'name'=>$mb->name(),
					'sex'=>$mb->sex(),
					'nationality'=>$mb->nationality(),
					'se'=>$mb->se(),
					'nyina'=>$mb->nyina(),
					'datebirth'=>$mb->datebirth(),
					'datebornagain'=>$mb->datebornagain(),
					'datebaptiz'=>$mb->datebaptiz(),
					'fonction'=>$mb->fonction(),
					'member'=>$mb->member(),
					'cellule'=>$mb->cellule(),
					'departement'=>$mb->departement(),
					'studylevel'=>$mb->studylevel(),
					'faculty'=>$mb->faculty(),
					'talent'=>$mb->talent(),
					'tel'=>$mb->tel(),
					'email'=>$mb->email(),
					'intara'=>$mb->intara(),
					'akarere'=>$mb->akarere(),
					'umurenge'=>$mb->umurenge(),
					'akagari'=>$mb->akagari(),
					'umrimo'=>$mb->umurimo(),
					'img'=>$mb->img()
				));
				
			}
		catch (Exception $e)
		{
			
			die('Erreur:'. $e->getMessage());
		}
		
	}
	
	public function new_serialnumber()
	{
		
		$actual_year = date('Y',strtotime('now'));
		$requet = $this->db->prepare('SELECT substring(serialnumber,1,4) AS serial_number,annee  FROM membre WHERE annee=:actual_year ORDER BY ID DESC LIMIT 1');
		$requet->execute(array
		(
				'actual_year' => $actual_year,
		));
		$lignes = $requet->fetch();
		
		// NOMBRE D'ENREGISTREMENT ////
		$numberof_registration = $this->count_registration();
		
		// Gestion des periodes d'annees pour les numeros de serie
		$actual_date = substr(date('Y',strtotime('now')), 2,2);
		
		if($numberof_registration == 0)
			return 'EVJM'.$actual_date.'A001';
		
		elseif($numberof_registration > 0)
		{
				if($this->chiffre() < 5)
				{
					return $lignes['serial_number'].$actual_date.$this->lettre().'00'.$this->chiffre();
				}
				
				elseif($this->chiffre() <=9)
				{
					return $lignes['serial_number'].$actual_date.$this->lettre().'0'.$this->chiffre();
				}
				elseif($this->chiffre() ==10)
				{
					return $lignes['serial_number'].$actual_date.$this->lettre().'00'.$this->chiffre();
				}
				
		}
	}
	
	public function chiffre()
	{
		$actual_date = date('y' , strtotime('now'));
		$requet = $this->db->prepare('SELECT *  FROM membre WHERE annee=:actual_date ORDER  BY ID DESC  LIMIT 1');
		$requet->execute(array
		(
			'actual_date' => $actual_date,
		));
		$digits = $requet->fetch();
		
		
		// Nombre d'enregistrement
		
		$numberof_registration = $this->count_registration();
		
		if( $numberof_registration == 0 )
			return 1;
		elseif( $numberof_registration > 0)
		{
			$chiffres = $digits['chiffre'] + 1;
			
			if($chiffres <= 9)
			{
				return $chiffres;
			}
			elseif($chiffres == 10)
				return 1;
			
		}
	}
	
	public function lettre()
	{
		$actual_date = date('y' , strtotime('now'));
		$requet = $this->db->prepare('SELECT *  FROM membre WHERE annee=:actual_date ORDER  BY ID DESC  LIMIT 1');
		$requet->execute(array
		(
			'actual_date' => $actual_date,
		));
		$letters = $requet->fetch();
		
		
		// Nombre d'enregistrement
		$numberof_registration = $this->count_registration();
		
		if( $numberof_registration == 0 )
			return 'A';
	    elseif($numberof_registration > 0)
		{
			$chiffres = $letters['chiffre'] + 1;
			
			if( $chiffres <=9)
			{
				$lettres = $letters['lettre'];
				return $lettres;
			}
			elseif($chiffres == 10)
			{
				$lettres = $letters['lettre'];
				$lettres ++;
				return $lettres;
			}
			
		}
	}
	
}


?>
</body>
</html>




