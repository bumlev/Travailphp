<?php
   include_once 'user.class.php';
?>

<!Doctype html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="2">
  <title class="after">Update</title>
  <!--Bootstrap css-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" href="fontawesome-free-5.2.0-web/css/all.css">

	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/dropdown.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/responsive-paginate.js"></script>
	
	
  <!-- <link rel="stylesheet" type="text/css" href="css/manage.css"/>-->
   <!-- <link rel="icon" href="favicon.ico" />-->
    <link rel="icon" type="image/png" href="logo_400x400.png" />
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
           $re=$bd->prepare('SELECT * FROM membre
					
					INNER JOIN niveauetude ON membre.studylevel = niveauetude.idniveau
					INNER JOIN cellulepri ON membre.cellule = cellulepri.Idcell
					INNER JOIN etatcivil ON membre.nationality = etatcivil.Idetatcivil
					INNER JOIN genre ON membre.sex = genre.Idgenre
					 WHERE ID=:iD');

          $re->execute(array(

          'iD'=>$_GET['id']
                     ));

         }
         catch (Exception $e)
         {
          die('Erreur: '. $e->getMessage());
         }

      $donnees=$re->fetch();
     ?>


	<nav class="navbar navbar-expand-lg navbar-dark bg-dark " style="min-height:72px;">
		<a href="#" class="navbar-brand">
			<img src="eglisevivantelogo.png" style="width:229px;margin-top:-23px;">
		</a>

		<<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
				</ul>
	
			</div>

    </nav>

    <script type="text/javascript">
      function showdistrict()
        {
          
            
                  $.post(
                     'postmanage.php', // Un script PHP que l'on va créer juste après
                  {
                       //username : $("#username").val(),  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                       intara:$("#intara").val()
                   },
                   
                   function (data)
                   {
                       //alert(data);
                      $('#akarere').html(data);
                   }

                  );
                 //alert($("#akarere").val());
                 
          }

          function showsector()
          {
          //var pro=document.getElementById('akarere').value;
          //alert(pro);
            
                  $.post(
                     'postmanage.php', // Un script PHP que l'on va créer juste après
                  {
                       akarere:$("#akarere").val()
                   },
                   
                   function (data)
                   {
                       //alert(data);
                      $('#umurenge').html(data);
                   }

                  );
                 //alert($("#akarere").val());
                 
            }
            function showcellule()
            {
              $.post(
                     'postmanage.php', // Un script PHP que l'on va créer juste après
                  {
                       //username : $("#username").val(),  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                       umurenge:$("#umurenge").val()
                   },
                   
                   function (data)
                   {
                       //alert(data);
                      $('#akagari').html(data);
                   }

                  );

            }
    </script>


<div class="col-md-6 offset-md-3" style="margin-top:-69px;margin-bottom:20px;">
    <div class="card card-outline-secondary" style="margin-top:90px;">
		<div class="card-header" style="background-color: #8a6d3b;color: #efed40;">
			 <h2 class="text-center">Edit a Member</h2>
		</div>
		<div class="card-body" style="background-color:#f7e1b5;color:#8a6d3b;">
         <form  action="affichesave.php" method="post" enctype="multipart/form-data" id="useform">
    		
                       <div class="form-group" style="display: none;">
							<label name="identity" type="hidden"></label>
						 	<input type="hidden" id="irangamuntu" name="telnum" class="form-control" value="<?=$donnees['ID']?>">
                       </div>
			 
                       <div class="form-group">
                          	<label name="identity">No y'irangamuntu:</label>
						   	<input type="text" id="irangamuntu" name="id" class="form-control" value="<?=$donnees['idnumb']?>">
						   <span id="error_irangamuntu" style="display:none;" class="alert-danger pull-right"></span>
                       </div>

                       <div class="form-group row ">
							<label class="col-md-12">Amazina:</label>
							<div class="col-md-6">
								<input  type="text" id="first_name" name="first_name"  class="form-control" placeholder="FirstName..." value="<?=$donnees['first_name']?>">
								<span id="error_firstname" style="display:none;" class="alert-danger pull-right"></span>
							</div>

						   <div class="col-md-6">
							   <input  type="text" id="first_name" name="last_name"  class="form-control" placeholder="LastName..." value="<?=$donnees['last_name']?>">
							   <span id="error_lastname" style="display:none;" class=" alert-danger pull-right"></span>
						   </div>
                       </div>
			 
                       <div class="form-group row">
							<div class="col-md-6">
								<label name="igitsina">Igitsina:</label>
								<?php
								require_once 'objet.php';
								include_once 'Membremanager.class.php';
								$mb=new Membremanager($bd);
								$mb->selectgendermodif($donnees['Idgenre'],$donnees['nomgenre']);
								?>
								<span id="error_gender" style="display:none;" class="alert-danger pull-right"></span>
							</div>
					   		<div class="col-md-6">
							   <label>Irangamirere:</label>
		
		                       <?php
		                       $mb=new Membremanager($bd);
		                       $mb->selectetatcivilmo($donnees['Idetatcivil'],$donnees['nometatcivil']);
		
		                       ?>
							   <span id="error_civilstatus" style="display:none;" class="alert-danger pull-right"></span>
						   </div>
							  
                       </div>
                       
                       <div class="form-group row ">
						<label class="col-md-12">Se:</label>
						<div class="col-md-6">
							<input type="text" id="se_firstname" name="se_firstname" placeholder="Firstname..." class="form-control" value="<?=$donnees['se_firstname']?>">
						</div>

						<div class="col-md-6">
						   <input type="text" id="se_lastname" name="se_lastname" placeholder="Lastname..." class="form-control" value="<?=$donnees['se_lastname']?>">
						</div>
                       
                       </div>
                       <div class="form-group row">
                          	<label class="col-md-12">Nyina:</label>
							<div class="col-md-6">
								<input type="text" id="nyina_firstname" name="nyina_firstname" placeholder="Firstname..." class="form-control" value="<?=$donnees['nyina_firstname']?>">
							</div>
						   <div class="col-md-6">
							   <input type="text" id="nyina_lastname" name="nyina_lastname" placeholder="Lastname..." class="form-control" value="<?=$donnees['nyina_firstname']?>">
						   </div>
						
                       
                       </div>
                       <div class="form-group row">
							<div class="col-md-6">
								<label name="ivuka">Igihe yavukiye:</label>
								<input  id="kuvuka" type="date" name="datebirth" class="form-control" required="required" value="<?=$donnees['datebirth']?>">
							</div>
						   <div class="col-md-6">
							   <label name="yakirijwe">Igihe yakirijwe:</label>
							   <input id="gukizwa" type="date" name="datebornagain" class="form-control" value="<?=$donnees['datebornagain']?>">
						   </div>
                       </div>
                       
                       <div class="form-group row">
						   
						<div class="col-md-6">
							<label name="bapteme">Igihe yabatirijwe:</label>
							<input id="kubatizwa" type="date" name="datebaptiz" class="form-control" value="<?=$donnees['datebaptiz']?>">
						</div>
						<div class="col-md-6">
						   <label name="membre">Umunyetorero kuva:</label>
						   <input id="membre" type="YEAR" name="membre" class="form-control" value="<?=$donnees['member']?>">
						</div>
                       
                       </div>

                        <div class="form-group">
                          <label name="akazi">Icyo ukora:</label>
                             <input type="text" id="akazi" name="akazi" class="form-control" value="<?=$donnees['fonction']?>">
                       </div>
                       
						
						<div class="form-group row">
							
							<div class="col-md-6">
								<label name="cellule">Cellule ubarizwamo:</label>
								<?php
								$mb=new Membremanager($bd);
								$mb->selectcellmodif($donnees['Idcell'] , $donnees['nomcell']);
								?>
							</div>
							<!--<div class="col-md-6">
								<label name="cellule">Inkingi y'itorero ubarizwamo:</label>
								<?php
/*								$mb=new Membremanager($bd);
								$mb->selectdepartmodif($donnees['departement']);
								
								*/?>
							</div>-->
							
						</div>
						
       
    	
       <!--div class="col-md-4" style="padding-left:40px;padding-right:36px; padding-top:40px;padding-bottom:40px; height:90;width: 100;" >

                    <div class="form-group" >
                      <label name="pic">Photo</label>
                      <img   src="uploads/<?php /*echo $donnees['image'] */?>" class="img-thumbnail" style="border-radius: 40%; height:90;width: 100;" >

                    </div>
  
         </div>-->
                       
 						
                       <div class="form-group row">
						   
							<div class="col-md-6">
								<label name="ishuri">Amashuri yize:</label>
								<?php
								$mb=new Membremanager($bd);
								$mb->selectstudymodif($donnees['idniveau'] , $donnees['levelname']);
								
								?>
							</div>

					   		<div class="col-md-6">
							   <label name="Ishami">Ishami yize:</label>
							   <input type="text" id="subject" name="faculty" class="form-control" value="<?=$donnees['faculty']?>">
							</div>
                       
                       
                       </div>

                      
                        <div class="form-group row">
							<div class="col-md-6">
								<label name="impano">Impanokaremano:</label>
								<input type="text" id="impano" name="talent" class="form-control" value="<?=$donnees['talent']?>">
							</div>
							<div class="col-md-6">
								<label name="mobile">TEL.MOBILE:</label>
								<input type="text" id="mobile" name="tel" class="form-control" value="<?=$donnees['tel']?>">
							</div>
                       
                       </div>
                        
                        <div class="form-group">
                          <label name="mail">Email:</label>
                             <input type="text" id="mail" name="email" class="form-control" value="<?=$donnees['email']?>">
                       </div>
                        <div class="form-group row">
							
							<div class="col-md-6">
								<label name="intara">Intara:</label>
								
								<?php
								//require_once 'objet.php';
								include_once 'exerca.php';
								
								$mb=new exerca($bd);
								$mb->selectakareremodif($donnees['intara']);
								
								
								?>
							</div>
							<div class="col-md-6">
								<label name="akarere">Akarere</label>

								<select class="form-control" name="akarere" size="0" id="akarere" onchange="showsector();">
									<option selected="selected" value="<?=$donnees['akarere']?>"><?php echo $donnees['akarere'];?></option>
								</select>
								<span id="error_akarere" class="alert-danger pull-right"></span>
                       		</div>
						</div>
                        <div class="form-group row">
							
							<div class="col-md-6">
								<label name="umurenge">Umurenge:</label>

								<select class="form-control" name="umurenge" id="umurenge" size="0" onchange="showcellule();">
									<option selected="selected" value="<?=$donnees['umurenge']?>"> <?php echo $donnees['umurenge'];?> </option>
								</select>
								<span id="error_umurenge" class="alert-danger pull-right"></span>
							</div>
							<div class="col-md-6">
								<label name="akagari">Akagari:</label>

								<select class="form-control" name="akagari" size="0" id="akagari">
									<option selected="selected" value="<?=$donnees['akagari']?>"><?php echo $donnees['akagari'];?> </option>
								</select>
							</div>
                       	</div>
                       
                        <div class="form-group">
                          <label name="umurimo">Umurimo mwitorero</label>
                             <input type="text" id="subject" name="umurimo" class="form-control" value="<?=$donnees['umrimo']?>">
                       </div>
                       <div class="form-group">
                       <input type="file" name="fichier" style="height:40%;" class="form-control" placeholder="file" value="<?php echo $donnees['image'];?>" >
                       <input type="text" id="fich" readonly="readonly" style="visibility:hidden" name="fich" class="form-control" value="<?=$donnees['image']?>">
                      </div>

                       <div class="form-group row">
						   
						   <div class="col-md-6">
								<input type="submit" style="background-color: #8a6d3b;color: #efed40;border-color:transparent;" value="Edit" name="update" class="btn col-md-10">
						   </div>
						   <div class="col-md-6">
								<a href="affiche.php" style="background-color: #8a6d3b;color: #efed40;border-color:transparent;" class="btn col-md-10">Show All Members</a>
						   </div>
						   
					   </div>

        


  </form>
</div>
    </div>
  </div>
  	<script type="text/javascript" language="javascript" src="js/jquery.min.js"></script>
  	<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
  	<script type="text/javascript" src="js/validation/additional-methods.js"></script>
  	<script type="text/javascript" language="javascript">
	    $('#useform').validate(
		    {
			    rules:
				    {

					    id:{
						    minlength: 16,
						    maxlength:16,
						    digits: true,
					    },

					    first_name:{
						    required: true,
						    minlength: 3,
					    },
						
					    last_name:{
						    required: true,
						    minlength: 3,
					    },

					    nationality:{
						    required: true,
					    },

					    sex:{
						    required:true,
					    },
					    intara:{
						    required:true,
					    },
					    akarere:{
						    required:true,
					    },

				    },
			    errorPlacement: function (error, element)
			    {
					/*element.css('background', 'rgba(255,0,0,0.3)');*/

				    element.css('border-color', 'red');
				    element.closest('div.form-group').find('span').css('display','inline');
				    element.closest('div.col-md-6').find('span').css('display','inline');
				    error.appendTo(element.closest('div.col-md-6').find('span#error_firstname'));
				    error.appendTo(element.closest('div.col-md-6').find('span#error_lastname'));
				    error.appendTo(element.closest('div.col-md-6').find('span#error_gender'));
				    error.appendTo(element.closest('div.col-md-6').find('span#error_civilstatus'));
				    error.appendTo(element.closest('div.col-md-6').find('span#error_intara'));
				    error.appendTo(element.closest('div.col-md-6').find('span#error_akarere'));
				    error.appendTo(element.closest('div.form-group').find('span#error_irangamuntu'));


			    }
		    }
	    );

	</script>
</body>
</html>