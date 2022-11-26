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
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/manage.css"/>

</head>
<body style="background: url('old_map_@2X.png');">
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
		<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="dropdown" data-target="#navbar-container">
				 <span class="sr-only"> Show and Hide the navigation</span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
			  </button>
			  <a href="#" class="navbar-tabs-justified">
				<img src="eglisevivantelogo.png" style="width:229px;">
			  </a>
		</div>
			<?php
			   if(!isset($_SESSION['no']) or !isset($_SESSION['motdepa']) or substr($_SESSION['no'],0,4)!='EVJU')
				  header('location:formauthentification.php');
		
				  $nom='logout';
			?>
		
		<div class="collapse navbar-collapse" id="navbar-container">
			<!--<form action="user.class.php" method="post" class="form-inline nav navbar-nav" style="margin-left: 115px;margin-top:42px;">
				<input id="motpass" class="form-control form-inline" type="password" name="motpass">
				<input class="btn btn-default form-inline" name="motbutton" type="submit" value="Edit password">
			</form>-->
		
			<ul class="nav navbar-nav navbar-right">
				<li><a><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']?></a></li>
				<!--<li class="active"><a href="Church Management.php" style="height:75px;">Registration of members</a></li>-->
				<li><a href="affiche.php">List of members</a></li>
				<li><a href="user.class.php?log=<?=$nom ?>" style="height:75px;" class="btn btn-default">Logout</a></li>
			</ul>
		
		</div>
		
		</div>
	</nav>


    <script type="text/javascript">
		
      	function showdistrict()
        {
		  	$.post(
				 	'postmanage.php',
				{
					intara:$("#intara").val()
				},
       
			   	function (data)
			   	{
					$('#akarere').html(data);
			   	}
			  	);
		}

	  	function showsector()
	  	{
			$.post(
				 	'postmanage.php',
				{
					akarere:$("#akarere").val()
				},
			   
			   	function (data)
			   	{
					$('#umurenge').html(data);
			   	}
				);
	  	}

		function showcellule()
		{
		  	$.post(
				 	'postmanage.php',
				{
					umurenge:$("#umurenge").val()
				},
				
				function (data)
				{
					$('#akagari1').html(data);
				}
				);
		}
    </script>
    
	<div class="container">
		<div class="row">
        <div class="panel panel-info br">
          <div class="panel-heading">
            <h3>Registration of members</h3>
          </div>
          <?php
            require_once 'objet.php';
            include_once 'Membremanager.class.php';
          ?>

<div class="panel-body" style="background: url('old_map_@2X.png');">
        
  
          <form id="useform" action="affichesave.php" method="post" class="form" enctype="multipart/form-data" >
            <div class="container">
              <div class="row">
                <div class="col-md-4" >
                  <div class="form-group">
                    <label name="identity">No y'irangamuntu:</label>
                    <input type="text" id="idnumber" name="id" class="form-control">
                    <span id="error_irangamuntu" class="alert-danger pull-right">
                    </span>
                  </div>

                  <div class="form-group">
                    <label name="amazina">Amazina:</label>
                    <input  type="text" id="name" name="name" class="form-control">
                    <h4 style="color:red;display:none;" class="pull-left">*</h4>
                    <span style="display:none;" id="error_name" class="has-error text-center alert-danger pull-right"></span>
                  </div>

                  <div class="form-group">
                    <label name="igitsina">Igitsina:</label>
                    <?php
                      $mb=new Membremanager($bd);
                      $mb->selectionner();
                    ?>
                    <h4 style="color:red" class="pull-left">*</h4>
                    <span id="error_sex" class="alert-danger pull-right"></span>
                  </div>

                  <div class="form-group">
                    <label name="irangamirere">Irangamirere:</label>
                    <?php
                        $mb=new Membremanager($bd);
                        $mb->selectetatcivil();
                    ?>
                    <!--input type="text" id="irangamirere" name="nationality" class="form-control " required="required" -->
                    <h4 style="color:red" class="pull-left" >*</h4>
                    <span id="error_etatcivil" class="alert-danger pull-right"></span>
                  </div>

                  <div class="form-group">
                    <label name="se">Se:</label>
                    <input type="text" id="pere" name="se" class="form-control">
                  </div>

                  <div class="form-group">
                    <label name="nyina">Nyina:</label>
                    <input type="text" id="mere" name="nyina" class="form-control">
                  </div>

                  <div class="form-group">
                    <label name="ivuka">Igihe yavukiye:</label>
                    <input  id="datebirth" type="date" name="datebirth" class="form-control" >
                    <h4 style="color:red">*</h4>
                    <span id="error_datebirth" class="alert-danger pull-right"></span>
                  </div>

                  <div class="form-group">
                    <label name="yakirijwe">Igihe yakirijwe:</label>
                    <input id="datebornagain" type="date" name="datebornagain" class="form-control" >
                  </div>

                  <div class="form-group">
                    <label name="bapteme">Igihe yabatirijwe:</label>
                    <input id="datebaptiz" type="date" name="datebaptiz" class="form-control" >
                  </div>

                  <div class="form-group">
                    <label name="akazi">Icyo ukora:</label>
                    <input type="text" id="akazi" name="akazi" class="form-control" >
                  </div>

                  <div class="form-group">
                    <label name="membre">Umunyetorero kuva:</label>
                    <input id="membre" type="date" name="membre" class="form-control" >
                  </div>

                  <div class="form-group">
                    <label name="cellule">Cellule ubarizwamo:</label>
                      <?php
                        $mb=new Membremanager($bd);
                        $mb->selectcell();
                      ?>
                      <h4 style="color:red">*</h4>
                      <span id="error_cellule" class="alert-danger pull-right"></span>
                  </div>
                </div>
                <div class="col-md-4" ></div>
                <div class="col-md-4" style="padding-right:45px;">
                  <div class="form-group">
                    <label name="departement">Departement ubarizwamo:</label>
                    <?php
                      $mb=new Membremanager($bd);
                      $mb->selectdepart();

                    ?>
                    <h4 style="color:red">*</h4>
                    <span id="error_depart" class="alert-danger pull-right"></span>
                  </div>

                  <div class="form-group">
                    <label name="ishuri">Amashuri yize:</label>
                    <?php
                        $mb=new Membremanager($bd);
                        $mb->selectstudylevel();
                    ?>
                  </div>

                  <div class="form-group">
                    <label name="Ishami">Ishami yize:</label>
                    <input type="text" id="faculty" name="faculty" class="form-control" >
                  </div>

                  <div class="form-group">
                    <label name="impano">Impanokaremano:</label>
                    <input type="text" id="impano" name="talent" class="form-control" >
                  </div>

                  <div class="form-group">
                    <label name="mobile">TEL.MOBILE:</label>
                    <input type="text" id="mobile" name="tel" class="form-control" >
                  </div>

                  <div class="form-group">
                    <label name="mail">Email:</label>
                    <input type="text" id="mail" name="email" class="form-control" >
                  </div>

                  <div class="form-group">
                    <label name="intara">Intara:</label>
                      <?php
                        //require_once 'objet.php';
                        include_once 'exerca.php';
                        $mb=new exerca($bd);
                        $mb->selectakarere();
                      ?>
                      <h4 style="color:red" class="pull-left">*</h4>
                      <span id="error_intara" class="alert-danger pull-right"></span>
                  </div>

                  <div class="form-group">
                    <label name="umurenge">Akarere</label>
                    <select class="form-control" name="akarere" id="akarere" onchange="showsector();">
                      <option selected="selected" value="<?php echo(null);?>"></option>
                    </select>
                    <h4 style="color:red" class="pull-left">*</h4>
                    <span id="error_akarere" class="alert-danger pull-right"></span>
                  </div>

                  <div class="form-group">
                    <label name="akagari">Umurenge:</label>
                      <select class="form-control" name="umurenge" id="umurenge" onchange="showcellule();">
                        <option selected="selected"><?php echo null;?> </option>
                      </select>
                      <h4 style="color:red">*</h4>
                      <span id="error_umurenge" class="alert-danger pull-right"></span>
                  </div>

                  <div class="form-group">
                    <label name="akagari">Akagari:</label>
                    <select class="form-control" name="akagari" id="akagari1">
                      <option selected="selected"><?php echo null;?></option>
                    </select>
                    <h4 style="color:red" class="pull-left">*</h4>
                    <span id="error_akagari" class="alert-danger pull-right"></span>
                  </div>

                  <div class="form-group">
                    <label name="umurimo">Umurimo mwitorero</label>
                    <input type="text" id="subject" name="umurimo" class="form-control" >
                  </div>

                  <div class="form-group">
                    <input type="file" name="fichier" class="form-control" placeholder="file">
                  </div>

                  <div class="form-group">
                    <input type="submit"  value="Save" name="save" class="btn btn-success">
                  </div>
      	       </div>
              </div>
            </div>
          </form>
        </div>
      </div>
		</div>
	</div>
  
    <script type="text/javascript" language="javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/validation/additional-methods.js"></script>
    <script type="text/javascript" language="javascript">
     /* $( function()
      {
           $('#error_irangamuntu').hide();
           $('#error_name').hide();
           $('#error_sex').hide();
           $('#error_datebirth').hide();
           $('#error_etatcivil').hide();
           $('#error_cellule').hide();
           $('#error_depart').hide();
           $('#error_intara').hide();
           $('#error_akarere').hide();
           $('#error_akagari').hide();
           
           var error_irangamuntu = false;
           var error_name = false;
           var error_sex = false;
           var error_datebirth = false;
           var error_etatcivil = false;
           var error_cellule = false;
           var error_depart = false;
           var error_intara = false;
           var error_akarere = false;
           var error_akagari = false;
           
           $('#idnumber').focusout(function(){
              check_irangamuntu();
            
           });

           $('#name').focusout(function(){
              check_name();
            
           });

           $('#sex').focusout(function(){
              check_sex();
            
           });

          $('#etatcivil').focusout(function(){
              check_etatcivil();
           });

          $('#datebirth').focusout(function(){
              check_datebirth();
            
           });

          $('#cellule').focusout(function(){
              check_cellule();
            
           });

          $('#depart').focusout(function(){
              check_departement();

           });
          
          // Champ pour l'id d'identite national
          function check_irangamuntu()
          {
              var reg =/^[0-9]*$/;
              var idnumber_length = $('#idnumber').val().length;
              if(idnumber_length!= 0 )
              {
                if( (idnumber_length!=16 && !reg.test($('#idnumber').val())) || !reg.test($('#idnumber').val()) || idnumber_length!=16)
                {
                $('#error_irangamuntu').html('This field must have 16 numeric characters without space');
                $('#idnumber').css('border-color','red');
                $('#error_irangamuntu').show();
                  error_irangamuntu = true;
                }
                 else
                 {
                   $('#idnumber').css('border-color','');
                   $('#error_irangamuntu').hide();

                 }
              }
              else
              {
                 $('#idnumber').css('border-color','');
                 $('#error_irangamuntu').hide();
              }
          }

          // champ de saisi pour le nom du membre
          function check_name()
          {
            var reg =/^[A-Za-z]*$/;
            var name_length = $('#name').val().length;
            var name = $('#name').val();
             if(name=='' || name_length < 3 && !reg.test(name) || name_length < 3 || !reg.test(name))
             {
                $('#error_name').html('Fill the empty field with only letters without space');
                 $('#name').css('border-color','red');
                $('#error_name').show();
                error_name = true;
             }
             else
             {
               $('#name').css('border-color','');
               $('#error_name').hide();
             }
          }

          function check_sex()
          {
            var reg =/^[A-Za-z]*$/;
            var sex = $('#sex').val();
            
            if(!reg.test(sex) || sex=='')
            {
                $('#error_sex').html('Fill the empty field with only letters without space');
                $('#sex').css('border-color','red');
                $('#error_sex').show();
                error_sex = true;
            }
            else
            {
               $('#sex').css('border-color','');
               $('#error_sex').hide();
             }
            

          }

          $('#useform').submit(function(){
            
              error_irangamuntu=false;
              error_name = false;
              error_sex = false;
              check_irangamuntu();
              check_name();
              check_sex();

              if(error_irangamuntu == false && error_name ==false && error_sex==false)
                return true;
              else
                return false;
          });

         });*/

       $('#useform').validate(
      {
        rules:
          {
          
				id:{
					minlength: 16,
					maxlength:16,
					digits: true,
				},
		
				name:{
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
			error.appendTo(element.closest('div.form-group').find('span.alert-danger'));
		}
		
      }
    );
		
	</script>

</body>
</html>