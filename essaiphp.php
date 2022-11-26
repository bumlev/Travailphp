<?php
require_once 'objet.php';
include_once 'user.class.php';
?>
<!doctype html>
<html lang="en">
<head>
    <title>Essai</title>
	<link rel="icon" type="image/png" href="logo_400x400.png"/>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
	<!--<link rel="stylesheet" href="fontawesome-free-5.2.0-web/css/all.css">-->
	
	<script type="text/javascript" src="js/validation/jquery.validate.js"></script>
	<script type="text/javascript" src="js/validation/additional-methods.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<!--<script type="text/javascript" src="js/dropdown.js"></script>-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/responsive-paginate.js"></script>
</head>
<body style="background: url('old_map_@2X.png');">

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="min-height:72px;">
	
	<a class="navbar-brand" href="#"><img src="eglisevivantelogo.png" style="width:229px;margin-top:-23px;"></a>

	<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon "></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav navbar-right">
			<li class="nav-item"><a class="nav-link"><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']?></a></li>
		</ul>
	</div>
	</nav>
	<!--<script>
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
	</script>-->
	<?php
	require_once 'objet.php';
	include_once 'Membremanager.class.php';
	?>
	
	<div class="col-md-6 offset-md-3" style="margin-top:-69px;margin-bottom:10px;">
			
			<div class="card card-outline-secondary"  style="margin-top:90px;">
				<div class="card-header " style="background-color: #8a6d3b;color: #efed40">
					<h2 class="text-center" >Create a Member</h2>
				<!--	<hr>-->
				</div>
				<div class="card-body" style="background-color: #f7e1b5;color:#8a6d3b; border: 2px solid transparent;">
					<form id="userform" class="form-group"  autocomplete="off" action="affichesavemember.php" method="post"  enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="idnumber">Numero y'irangamuntu</label>
							<input type="text"  class="form-control" id="idnumber" name="id">
							<span id="error_irangamuntu" class="alert-danger pull-right"></span>
						</div>
						
						<div class="form-group row ">
							<label class="col-md-12"> Amazina</label>
							<div class="col-md-6">
								<input type="text" name="firstname" id="firstname" class="form-control" autocomplete="off"   placeholder="Firstname...">
								<h4 style="color:red" class="pull-left">*</h4>
								<span id="error_firstname" class="alert-danger pull-right"></span>
							</div>
							<div class="col-md-6">
								<input type="text" name="lastname" id="lastname" class="form-control" autocomplete="off"  placeholder="Lastname...">
								  <h4 style="color:red;" class="pull-left">*</h4>
									<span id="error_lastname"  class=" alert-danger pull-right"></span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label>Igistina</label>
								<?php
								$mb=new Membremanager($bd);
								$mb->selectionner();
								?>
							</div>
							<div class="col-md-6">
								<label>Irangamirere</label>
								<select class="form-control" name="nationality" id="etatcivil" size="0">
									<option value="" selected><?php echo null;?></option>
								</select>
							</div>
							
						</div>
						<div class="form-group row">
							<label class="col-md-12">Se</label>
							<div class="col-md-6">
								<input type="text" class="form-control" autocomplete="off"   placeholder="First name...">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" autocomplete="off" placeholder="Last name..." >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-12">Nyina</label>
							<div class="col-md-6">
								<input type="text" class="form-control" autocomplete="off"   placeholder="First Name...">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" autocomplete="off"  placeholder="Last Name...">
							</div>
						</div>

						<div class="form-group row">
							
							<div class="col-md-6">
								<label>Itariki yavukiye</label>
								<input type="date" class="form-control" autocomplete="off">
							</div>
							<div class="col-md-6">
								<label>Itariki yakirijwe</label>
								<input type="date" class="form-control" autocomplete="off" >
							</div>
						</div>
						<div class="form-group row">

							<div class="col-md-6">
								<label>Itariki yabatirijwe</label>
								<input type="date" class="form-control" autocomplete="off">
							</div>
							<div class="col-md-6">
								<label>Umunyetorero kuva</label>
								<input type="date" class="form-control" autocomplete="off" >
							</div>
						</div>

						<div class="form-group">
							<label for="cc_name">Icyo Ukora</label>
							<input type="text"  class="form-control" id="cc_name">
						</div>
						
						<div class="form-group row">
							<div class="col-md-6">
								<label>Cellule ubarizwamo</label>
								<select class="form-control" name="cc_exp_mo" size="0">
									<option selected><?php echo null;?></option>
								</select>
							</div>
							<div class="col-md-6">
								<label>Departement ubarizwamo</label>
								<select class="form-control" name="cc_exp_yr" size="0">
									<option  selected><?php echo null;?></option>
								</select>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-md-6">
								<label>Amashuri yize</label>
								<select class="form-control" name="cc_exp_mo" size="0">
									<option selected><?php echo null;?></option>
								</select>
							</div>
							<div class="col-md-6">
								<label for="cc_name">Ishami yize</label>
								<input type="text"  class="form-control" id="cc_name">
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-md-6">
								<label for="cc_name">Impanokaremano</label>
								<input type="text"  class="form-control" id="cc_name">
							</div>

							<div class="col-md-6">
								<label for="cc_name">TEL.MOBILE</label>
								<input type="text"  class="form-control" id="cc_name">
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="cc_name">Email</label>
							<input type="email"  class="form-control" id="cc_name" placeholder="example@gmail.com or example@yahoo.com...">
						</div>
						
						<div class="form-group row">
							<div class="col-md-6">
								<label>Intara</label>
								<?php
								require_once 'objet.php';
								include_once 'exerca.php';
								$mb=new exerca($bd);
								$mb->selectakarere();
								?>
							</div>
							<div class="col-md-6">
								<label>Akarere</label>
								<select class="form-control" name="akarere" size="0" id="akarere" onchange="showsector();">
									<option selected="selected" value="<?php echo(null);?>"></option>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-6">
								<label>Umurenge</label>
								<select class="form-control" name="umurenge" id="umurenge" size="0" onchange=" showcellule();">
									<option selected><?php echo null;?></option>
								</select>
							</div>
							<div class="col-md-6">
								<label>Akagari</label>
								<select class="form-control" name="akagari" id="akagari1" size="0">
									<option  selected><?php echo null;?></option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label name="umurimo">Umurimo mwitorero</label>
							<input type="text" id="subject" name="umurimo" class="form-control" >
						</div>

						<div class="form-group">
							<label>
								Ifoto
								<input type="file" id="file" class="form-control" style="height:40%;">
							</label>
						</div>
						
						<hr>
						<div class="form-group ">

							<div class="col-md-6">
								<button type="submit" value="Save" name="save" class="btn btn-success btn-lg btn-block"  style="background-color: #8a6d3b ;border: 1px solid transparent;color:#efed40">Submit</button>
							</div>
							
							<!--<div class="col-md-6">
								<button type="reset" class="btn btn-default btn-lg btn-block">Cancel</button>
							</div>-->
							
						</div>
					</form>
				</div>
			</div>
	</div>
	<script type="text/javascript" language="Javascript">
		
		$('#useform').validate(
			{
				rules:
					{
/*
						id:{
							minlength: 16,
							maxlength:16,
							digits: true,
						},*/

						fistname:{
							required: true,
							minlength: 3,
						},

						lastname:{
							required: true,
							minlength: 3,
						},

						/*nationality:{
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
*/

					},
				errorPlacement: function (error, element)
				{
					/*element.css('background', 'rgba(255,0,0,0.3)');*/
					
					element.css('border-color', 'red');
					/*element.css('display', 'inline');*/
					error.appendTo(element.closest('span').find('.alert-danger'));
				}

			}
		);

	</script>
</body>
</html>












