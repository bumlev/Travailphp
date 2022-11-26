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
	<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/responsive-paginate.js"></script
	
</head>
<body style="background: url('old_map_@2X.png');">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"  style="min-height:72px;" id="app">

		<a href="#" class="navbar-brand">
			<img src="eglisevivantelogo.png" style="width:229px;margin-top:-23px;">
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
               	<li class="nav-item active table-active" style="height:55px;background-color:black"><a href="affiche.php"  class="nav-link">List of members</a></li>
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
         <!-- <div class="form-group ">
             <input type="text" class="form-control" placeholder="Search" id="myin">
          </div>-->
  <!--label name="igitsina">Choix</label-->
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

        $mb = new Membremanager($bd);
            ?>
		<label ><h2>Results of Search </h2></label>
     </div>

<!--<div class="row">-->

<?php

 //////////////////////////////  RECHERCHE DES MEMBRES///////////////////////

         
         if(isset($_POST['cherch']))
         {
              include 'foction.php';
              include 'recherche.php';

			if(!isset($_GET['page']))
			{
				$nbrepages = ceil(nbrepays($criteres,$_POST['depart'])/5);
				$page = 1;
				$results = afficher($page,5,$criteres,$_POST['depart']);
			}

			if(isset($_GET['page']) And isset($_GET['criteres']))
			{
			  	$criteres = $_GET['criteres'];
				$nbrepages = ceil(nbrepays($criteres)/5);
				$page = intval($_GET['page']);
				$results = afficher($page,5,$criteres);
			}
   
	echo'<div class="table-responsive">';
    	echo'<table style="background-color: white;" class="table ">';
    ?>
			<thead style="background-color: chocolate;color:white;">
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
            <?php
    echo '<tbody id="mytable">';
    if($results!=NULL)
	{
		
   foreach ($results as $result)
   {
      echo "<tr>";
			echo '<th>'.$result['idnumb'].'</th>';
			echo '<th>'.$result['first_name'].' '.$result['last_name'].'</th>';
			echo '<th>'.$result['nomgenre'].'</th>';
			echo '<th>'.$result['nometatcivil'].'</th>';
			echo '<th>'.$result['datebirth'].'</th>';
			echo '<th>'.$result['datebornagain'].'</th>';
			echo '<th>'.$result['datebaptiz'].'</th>';
			echo '<th>'.$result['nom'].' '. $result['prenom'].'</th>';
      ?>
      <!--<th><a href="indexo.php?nom=delete&amp;id=<?/*=$donnees['ID'] */?>"><button class="br">Delete</button> </a></th>
      <th><a href="formodifier.php?nom=update&amp;id=<?/*=$donnees['ID'] */?>"><button class="br">Edit</button></a></th>-->
	
	   <?php
	   if(isset($_SESSION['no']) and isset($_SESSION['motdepa']) and substr($_SESSION['no'],0,4)=='EVJA')
	   {
		   ?>
			<th><a href="formodifier.php?nom=update&amp;id=<?=$result['ID']?>"><button class=" btn btn-info fa fa-edit ">Edit</button></a></th>
		   <?php
	   }
	   ?>
	   		<th><a href="personalidentification.php?nom=info&amp;id=<?=$result['ID'] ?>"  class="btn btn-info">More</a></th>
      <?php
      echo "</tr>";
   }
		
	}elseif($results==NULL)
	{
		echo '<th colspan="10" style="text-align:center">No Data Found...</th>';
	}
   echo "</tbody>";
   echo "</table>";
   echo '</div>';
?>
 <div class="row"><a href="affiche.php"  style="text-align:center" class="btn btn-primary center-block">Show All Members </a></div>
<?php
$i=1;

echo '<ul class="pagination">';
?>
<li class="<?php if($page=="1"){echo "disabled";} ?>"><a href="?page=<?php if($page!="1"){echo($page-1); } else{echo $page;}?>&&pp=<?php echo $_GET['pp'];?>&&criteres=<?php echo $criteres;?>">&laquo;</a></li>
<?php
while ($i<=$nbrepages)
{
  if($i==$page)
   echo '<li class="active">'. '<a href="?page='.$i.'&&criteres='.$criteres.'">'.$i.'</a>'.'</li>';
  else
   echo '<li>'. '<a href="?page='.$i.'&&criteres='.$criteres.'">'.$i.'</a>'.'</li>';
   $i++;
}
?>
<li class="<?php if($page==$nbrepages){echo "disabled";} ?>"><a href="?page=<?php if($page!=$nbrepages){echo($page+1);} else{echo $page;}?>&&criteres=<?php echo $criteres;?>">&raquo;</a></li>

<?php
 //echo '</br> '.'</br>'.$criteres;
 echo '</ul>';


            ?>
            
      <?php
         }
         
	if(isset($_GET['criteres']))
	{
		include 'foction.php';
		include 'recherche.php';

		if(!isset($_GET['page']))
		{
			$nbrepages=ceil(nbrepays($criteres)/5);
			$page=1;
			$results=afficher($page,5,$criteres);
		}
	
		if(isset($_GET['page']) And isset($_GET['criteres']))
		{
			$criteres=$_GET['criteres'];
			$nbrepages=ceil(nbrepays($criteres)/5);
			$page=intval($_GET['page']);
			$results=afficher($page,5,$criteres);
		}
  
		echo '<div class="table-responsive">';
		echo'<table style="background-color:white;" class="table ">';
    ?>
    <thead style="background-color: chocolate;color:white">
                <tr>
                    <th>Idnumb</th>
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
      <?php
    echo '<tbody id="mytable">';
   foreach ($results as $result)
   {
      	echo "<tr>";
      	echo '<th>'.$result['idnumb'].'</th>';
      	echo '<th>'.$result['first_name'].''.$result['last_name'].'</th>';
      	echo '<th>'.$result['nomgenre'].'</th>';
      	echo '<th>'.$result['nometatcivil'].'</th>';
      	echo '<th>'.$result['datebirth'].'</th>';
      	echo '<th>'.$result['datebornagain'].'</th>';
      	echo '<th>'.$result['datebaptiz'].'</th>';
		echo '<th>'.$result['nom'].' '.$result['prenom'].'</th>';
      ?>
    
	   <?php
	   if(isset($_SESSION['no']) and isset($_SESSION['motdepa']) and substr($_SESSION['no'],0,4)=='EVJA')
	   {
		   ?>
		   <th><a href="formodifier.php?nom=update&amp;id=<?=$result['ID']?>"><button class=" btn btn-info fa fa-edit ">Edit</button></a></th>
		   <?php
	   }
	   ?>
	   <th><a href="personalidentification.php?nom=info&amp;id=<?=$result['ID'] ?>" class=" btn btn-info">More</a></th>
      <?php
      echo "</tr>";
   }

   echo "</tbody>";
   echo "</table>";
   echo '</div>';

$i=1;
?>
  <div class="row"><a href="affiche.php" style="margin-left: 40%" class="btn btn-primary ">Show All Members </a></div>
<?php
echo '<ul  class="pagination">';
?>
<li class="<?php if($page=="1"){echo "disabled";} ?>"><a href="?page=<?php if($page!="1"){echo($page-1); } else{echo $page;}?>&&criteres=<?php echo $criteres;?>">&laquo;</a></li>

<?php
while ($i<=$nbrepages)
{
  if($i==$page)
   echo '<li class="active">'. '<a href="?page='.$i.'&&criteres='.$criteres.'">'.$i.'</a>'.'</li>';
  else
   echo '<li>'. '<a href="?page='.$i.'&&criteres='.$criteres.'">'.$i.'</a>'.'</li>';
   $i++;
}
?>
<li class="<?php if($page==$nbrepages){echo "disabled";} ?>"><a href="?page=<?php if($page!=$nbrepages){echo($page+1);} else{echo $page;}?>&&criteres=<?php echo $criteres;?>">&raquo;</a></li>

<?php
 echo '</ul>';

 }
?>
<script>
	$('.pagination').rPage();
</script>

</div>
</body>
</html>




