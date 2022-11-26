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
				<li class="nav-item " style=" text-decoration:none;"><a href ="modifierprofil.php?nom=update&amp;id=<?=$_SESSION['id'] ?>" style="color: #fff;text-decoration:none;" class="nav-link">Edit Profil</a></li>
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
     </div>


</div>

<div class="table-responsive-md" style="margin-right:62px;margin-left:62px;" >

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
         

         	if (isset($_POST['first_name']))
           		$membre->setfirst_name($_POST['first_name']);

			if (isset($_POST['last_name']))
				$membre->setlast_name($_POST['last_name']);
			
			
        	if (isset($_POST['sex']))
          		$membre->setSex($_POST['sex']);

        	if (isset($_POST['nationality']))
          		$membre->setNationality($_POST['nationality']);

        	if (isset($_POST['se_firstname']))
          		$membre->setse_firstname($_POST['se_firstname']);

			if (isset($_POST['se_lastname']))
				$membre->setse_lastname($_POST['se_lastname']);

        	if (isset($_POST['nyina_firstname']))
          		$membre->setnyina_firstname($_POST['nyina_firstname']);
        	
			if (isset($_POST['nyina_lastname']))
				$membre->setnyina_lastname($_POST['nyina_firstname']);

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


</div>


	<div class="row"><a href="affiche.php" style="margin-left: 40%" class="btn btn-primary ">Show All Members </a></div>
	<div class="row">
	    <?php
	    include 'Modal_create_department.php';
	    ?>
	</div>

	<script type="text/javascript" src="js/$2.js"></script>
	<script type="text/javascript" src="js/chosen.jquery.js"></script>
	<script>
		
		$('[id^="create_Department_"]').each(function(e)
		{
			
			var button = $(this);
			var member = $.parseJSON(button.parent().find('#member').text());
			console.log(member);
			button.on('click', function(e)
			{
				$('#newDepartmentModal').on('shown.modal.bs', function (e)
				{
					var modal = $(this);
					modal.find('#member_department').text(member.first_name +'  '+ member.last_name).show();
					modal.find('#member_dep').val(member.ID)

				}).modal('show');
			});
		});
	
	</script>
</body>

</html>



