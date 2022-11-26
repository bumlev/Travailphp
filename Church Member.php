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
	<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" href="fontawesome-free-5.2.0-web/css/all.css">

	<script type="text/javascript" src="js/bootstrap.js"></script>
	<!--<script type="text/javascript" src="js/dropdown.js"></script>-->
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
	
	
	<?php
	if(isset($_SESSION['no']) And isset($_SESSION['motdepa']) And substr($_SESSION['no'],0,4) =='EVJA' or isset($_SESSION['no']) And isset($_SESSION['motdepa']) And substr($_SESSION['no'],0,4) =='EVJS')
	{
		?>
		<span style="font-size:30px;cursor:pointer;color:white;" onclick="openNav()">&#9776;</span>
		<?php
	}
	?>
	<a href="#" class="navbar-brand">
		<img src="eglisevivantelogo.png" style="width:229px;margin-top:-23px;">
	</a>
	<<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon "></span>
	</button>
	
	<?php
	
	if(!isset($_SESSION['no']) or !isset($_SESSION['motdepa']) or substr($_SESSION['no'],0,4)!='EVJA' And substr($_SESSION['no'],0,4)!='EVJS')
		header('location:formauthentification.php');
	
	$nom='logout';
	?>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class=" navbar-nav navbar-right">
			<li class="nav-item"><a class="nav-link"><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']?></a></li>
			<!--li><a href="Administrateur.php">Report</a></li-->
		</ul>
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
<?php
require_once 'objet.php';
include_once 'Membremanager.class.php';
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

<div class="col-md-6 offset-md-3" style="margin-top:-69px;margin-bottom:20px;">

	<div class="card card-outline-secondary" style="margin-top:90px;">
		<div class="card-header" style="background-color: #8a6d3b;color: #efed40;">
			<h2 class="text-center">Registration of members</h2>
		</div>


		<div class="card-body" style="background-color: #f7e1b5;color:#8a6d3b;">

			<form id="createform" action="affichesave.php" method="post"  enctype="multipart/form-data" >

				<div class="form-group">
					<label>No y'irangamuntu:</label>
					<input type="text" id="idnumber" name="id" class="form-control" >
					<span id="error_irangamuntu" style="display:none;" class="alert-danger pull-right"></span>
				</div>


				<div class="form-group row">
					<div class="col-md-6 center-block">
						<?php $mb = new Membremanager($bd);?>
						<label>Serialnumber</label>
						<input name="serial_number" readonly="readonly"  type="text" id="serial_number" class="form-control" style="border-radius:5px;" value="<?php echo $mb->new_serialnumber();?>">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-12">Amazina:</label>
					<div class="col-md-6">
						<input  type="text" id="first_name" name="first_name" autocomplete="off" class="form-control" placeholder="FirstName...">
						<span id="error_firstname" style="display:none;" class=" alert-danger pull-left"></span>
					</div>

					<div class="col-md-6">
						<input  type="text" id="last_name" name="last_name" autocomplete="off" class="form-control" placeholder="LastName...">
						<span id="error_lastname" style="display:none;" class=" alert-danger pull-right"></span>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-6">
						<label>Igitsina:</label>
						<?php
						$mb=new Membremanager($bd);
						$mb->selectgender();
						?>
						<span id="error_gender" style="display:none;" class=" alert-danger pull-right"></span>
					</div>

					<div class="col-md-6">
						<label>Irangamirere:</label>
						<?php
						$mb=new Membremanager($bd);
						$mb->selectetatcivil();
						?>
						<span id="error_civilstatus" style="display:none;" class="alert-danger pull-right"></span>
					</div>

				</div>

				<div class="form-group row">
					<label class="col-md-12">Se:</label>
					<div class="col-md-6">
						<input type="text" id="se_firstname" name="se_firstname" class="form-control" placeholder="FirstName...">
					</div>

					<div class="col-md-6">
						<input type="text" id="se_lastname" name="se_lastname" class="form-control" placeholder="LastName...">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-12">Nyina:</label>
					<div class="col-md-6">
						<input type="text" id="mere" name="nyina_firstname" class="form-control" placeholder="FirstName...">
					</div>
					<div class="col-md-6">
						<input type="text" id="mere" name="nyina_lastname" class="form-control" placeholder="LastName...">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-6">
						<label name="ivuka">Igihe yavukiye:</label>
						<input  id="datebirth" type="date" name="datebirth" class="form-control" >
						<span id="error_datebirth" class="alert-danger pull-right"></span>
					</div>
					<div class="col-md-6">
						<label name="yakirijwe">Igihe yakirijwe:</label>
						<input id="datebornagain" type="date" name="datebornagain" class="form-control" >
					</div>
				</div>



				<div class="form-group row">

					<div class="col-md-6">
						<label name="bapteme">Igihe yabatirijwe:</label>
						<input id="datebaptiz" type="date" name="datebaptiz" class="form-control" >
					</div>

					<div class="col-md-6">
						<label name="membre">Umunyetorero kuva:</label>
						<input id="membre" type="date" name="membre" class="form-control" >
					</div>

				</div>

				<div class="form-group">
					<label name="akazi">Icyo ukora:</label>
					<input type="text" id="akazi" name="akazi" class="form-control" >
				</div>




				<div class="form-group row">
					<div class="col-md-6">
						<label name="cellule">Cellule ubarizwamo:</label>
						<?php
						$mb=new Membremanager($bd);
						$mb->selectcell();
						?>
						<span id="error_cellule" class="alert-danger pull-right"></span>
					</div>

					<div class="col-md-6">
						<label name="departement">Inkingi y'itorero ubarizwamo:</label>
						<?php
						$mb=new Membremanager($bd);
						$mb->selectdepart();
						
						?>
						<span id="error_depart" class="alert-danger pull-right"></span>

					</div>
				</div>

				<div class="form-group row">

					<div class="col-md-6">

						<label name="ishuri">Amashuri yize:</label>
						<?php
						$mb=new Membremanager($bd);
						$mb->selectstudylevel();
						?>
					</div>

					<div class="col-md-6">
						<label name="Ishami">Ishami yize:</label>
						<input type="text" id="faculty" name="faculty" class="form-control" >
					</div>
				</div>

				<div class="form-group row">

					<div class="col-md-6">
						<label name="impano">Impanokaremano:</label>
						<input type="text" id="impano" name="talent" class="form-control" >
					</div>

					<div class="col-md-6">
						<label name="mobile">TEL.MOBILE:</label>
						<input type="text" id="mobile" name="tel" class="form-control" >
					</div>

				</div>



				<div class="form-group">
					<label name="mail">Email:</label>
					<input type="text" id="mail" name="email" class="form-control" >
				</div>

				<div class="form-group row">


					<div class="col-md-6">
						<label>Intara:</label>
						<?php
						//require_once 'objet.php';
						include_once 'exerca.php';
						$mb=new exerca($bd);
						$mb->selectakarere();
						?>
						<span id="error_intara" class="alert-danger pull-right"></span>
					</div>

					<div class="col-md-6">
						<label>Akarere</label>
						<select class="custom-select" style="border-radius:5px;height:34px;" size="0" name="akarere" id="akarere" onchange="showsector();">
							<option selected="selected" value="<?php echo(null);?>"></option>
						</select>
						<span id="error_akarere" class="alert-danger pull-right"></span>
					</div>

				</div>

				<div class="form-group row">

					<div class="col-md-6">

						<label name="akagari">Umurenge:</label>
						<select class="custom-select" style="border-radius:5px;height:34px;" size="0" name="umurenge" id="umurenge" onchange="showcellule();">
							<option selected="selected"><?php echo null;?> </option>
						</select>
						<span id="error_umurenge" class="alert-danger pull-right"></span>
					</div>
					<div class="col-md-6">
						<label>Akagari:</label>
						<select class="custom-select" style="border-radius:5px;height:34px;" size="0" name="akagari" id="akagari1">
							<option selected="selected"><?php echo null;?></option>
						</select>
						<span id="error_akagari" class="alert-danger pull-right"></span>
					</div>
				</div>
				<div class="form-group">
					<label name="umurimo">Umurimo mwitorero</label>
					<input type="text" id="subject" name="umurimo" class="form-control" >
				</div>

				<div class="form-group">
					<label>
						Ifoto
						<input type="file" style="height:40%;" name="fichier" class="form-control" placeholder="file">
					</label>

				</div>

				<div class="form-group row">
					<input type="submit"  value="Save" name="save" class="btn  col-md-5 center-block" style="background-color: #8a6d3b;color: #efed40;border-color:transparent;">
				</div>
			</form>
		</div>

	</div>
	<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/validation/additional-methods.js"></script>
	<script type="text/javascript" language="javascript">


		$('#createform').validate(
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

				},
			});

		function openNav() {
			document.getElementById("mySidenav").style.width = "250px";
		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
		}


	</script>

</body>
</html>
