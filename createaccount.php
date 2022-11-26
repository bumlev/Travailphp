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
			<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
			<link rel="stylesheet" href="fontawesome-free-5.2.0-web/css/all.css">

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
					position:fixed;
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
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="min-height:72px;">

				<span style="font-size:30px;cursor:pointer; color: white" onclick="openNav()">&#9776;</span>
				<a class="navbar-brand" href="#"><img src="eglisevivantelogo.png" style="width:229px;margin-top:-23px;"></a>
				
				<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon "></span>
				</button>
					
					<?php
					
					if(!isset($_SESSION['no']) or !isset($_SESSION['motdepa']) or substr($_SESSION['no'],0,4)!='EVJA'  And substr($_SESSION['no'],0,4)!='EVJS')
						header('location:formauthentification.php');
					
						$nom='logout';
					?>
					<div class="collapse navbar-collapse" id="#navbarNav">
						<ul class="navbar-nav navbar-right">
							<li class="nav-item"><a class="nav-link"><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']?></a></li>
							<!--li><a href="Administrateur.php">Report</a></li-->
						</ul>
					</div>
			</nav>



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
						<h2 class="text-center">Create an Account</h2>
					</div>


					<div class="card-body" style="background-color: #f7e1b5;color:#8a6d3b;">

						<form action="Roleuser.class.php" method="post" class="center-block">
							<?php
									if(substr($_SESSION['no'], 0,4) =='EVJS')
									{
										?>
										<div class="form-group row">

											<div class="col-md-7 center-block">
												<label>Profil</label>
												<?php
												$user = new user($bd);
												$user->select_users_admin_supervisors();
												?>
											</div>

										</div>
										<?php
									}
									elseif(substr($_SESSION['no'], 0,4) =='EVJA')
									{
										?>
										<div class="form-group row">

											<div class="col-md-7 center-block">
												<label>Profil</label>
												<?php
												$user = new user($bd);
												$user->selectgrpuser();
												?>
											</div>

										</div>
										<?php
									}
							?>
							
							
							
								<script type="text/javascript" language="javascript" src="js/jquery.min.js"></script>
								<script type="text/javascript" language="JavaScript">

									$('#profil').change(function ()
									{
										//alert($('#profil').val());
										$.post(
											'postmanage.php',
											{
												profil:$('#profil').val()
											},
											function (data)
											{
												if($('#profil').val()=='')
													$('#serialnumb').val('');
												else
													$('#serialnumb').val(data);

											}
										);
									})
								</script>
								<div class="form-group row">
									<div class="col-md-7 center-block">
										<label>Serialnumber</label>
										<input name="serialnumb" readonly="readonly"  type="text" id="serialnumb" class="form-control" style="border-radius:5px;">
									</div>
									
								</div>

								<div class="form-group row">
									
									<div class="col-md-7 center-block">
										<label>First Name</label>
										<input name="nom"  type="text" id="nom" class="form-control" style="border-radius: 5px;">
									</div>
									
									
								</div>

								<div class="form-group row">
									<div class="col-md-7 center-block">
										<label>Last Name</label>
										<input name="prenom"  type="text" id="prenom" class="form-control" style="border-radius: 5px;">
									</div>
									
								</div>

								<div class="form-group row">
									
									
									<div class="col-md-7 center-block">
										<label>Password</label>
										<input name="pass"  type="password" id="motdepasse" class="form-control" style="border-radius: 5px;">
									</div>
									
								</div>

								<div class="form-group row">
									
									<div class="col-md-7 center-block">
										<label>Comfirm your Password</label>
										<input name="confirm"  type="password" id="confirmotdepasse" class="form-control" style="border-radius: 5px;">
									</div>
								</div>

								<div class="form-group row">
									<div class="col-md-7 center-block">
										<input type="submit" value="save" class="btn col-md-12 center-block" name="save" style=" border-radius: 5px;margin-top:15px;background-color: #8a6d3b;color: #efed40;">
									</div>
									
								</div>

						</form>
					</div>
				</div>

			</div>
			<script>
				function openNav() {
					document.getElementById("mySidenav").style.width = "250px";
					document.getElementById("main").style.marginLeft = "250px";
				}

				function closeNav() {
					document.getElementById("mySidenav").style.width = "0";
					document.getElementById("main").style.marginLeft= "auto";
					document.getElementById("main").style.marginRight= "auto";
				}
			</script>
		</body>
	</html>
