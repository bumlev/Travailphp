
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
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title class="after">Compte Administrateur</title>
			<link rel="icon" type="image/png" href="logo_400x400.png"/>
			<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
			<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
			<link rel="stylesheet" href="fontawesome-free-5.2.0-web/css/all.css">
			<meta name="viewport" content="width=device-width, initial-scale=1">
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
				font-size: 20px;
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
			
				<div id="mySidenav" class="sidenav ">
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
						<div class="line-separator"></div>
					
						<a href="listeutilisateurs.php"><span><i class="fa fa-users icons"></i></span>Users</a>
						<div class="line-separator"></div>
						<a href="creercompte.php" ><span><i class="fa fa-user icons"></i></span>Create Account</a>
						<div class="line-separator"></div>
						<a href="#"><span><i class="fa fa-user-plus icons"></i></span>Create Member</a>
						<div class="line-separator"></div>
						<a href="#"><span><i class="fa fa-edit icons"></i></span>Edit Profil</a>
						<div class="line-separator"></div>
						<a href="#"><span><i class="fa fa-sign-out-alt icons"></i></span>Logout</a>
						<div class="line-separator"></div>
					
					
				</div>
				<div id="main">
					<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open Menu</span>
			<!-- <nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
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
					<div class="collapse navbar-collapse" id="navbar-container">
						<ul class="nav navbar-nav navbar-right">
							<li><a>Levi</a></li>
						</ul>
					</div>
				
				</div>
			</nav> -->
		
		<!-- <div class="row" style="height:561px;"> -->
			 <!--<div class="col-lg-2 navbar-inverse" style="margin-top: 76px;height: 100%;">
				<ul class="list-group" style="background-color: unset;border:none;margin-top: 2px;">
					<div class="clearfix"><li class="list-group-item" style="background-color: unset; border-radius: 20px;"><a href="listeutilisateurs.php" style="height:75px; color: #fff;text-decoration:none;">User</a></li></div>
					
					<li class="list-group-item" style="background-color:unset; border-radius: 20px;"><a href="#" style="color: #fff;text-decoration:none;">Administrator</a></li>
					<li class="list-group-item active" style="background-color:unset; border-radius: 20px;"><a href="createaccount.php" style="color: #fff;text-decoration:none;">Create Account</a></li>
					<li class="list-group-item " style="background-color:unset; border-radius: 20px;"><a href="Church Member.php" style="color: #fff;text-decoration:none;">Create a Member</a></li>
					
					<li class="list-group-item" style="background-color:unset; border-radius: 20px; text-decoration:none;"><a style="color: #fff;text-decoration:none;">Edit Profil</a></li>
					
					<li class="list-group-item" style="background-color:unset; border-radius: 20px;"><a style="color: #fff;text-decoration: none;">Logout</a></li>
					
				</ul>
			</div>-->
			
			<form action="Roleuser.class.php" method="post" >
				<div class=" col-lg-2" style="margin-top: 176px;">
					<div class="form-group">
						<label>Profil</label>
						<?php
						$user=new user($bd);
						$user->selectgrpuser();
						?>
					</div>
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
					<div class="form-group">
						<label>Serialnumber</label>
						<input name="serialnumb" readonly="readonly"  type="text" id="serialnumb" class="form-control" style="width: 290px;border-radius: 20px;">
					</div>
				
					<div class="form-group">
						<label>Last Name</label>
						<input name="nom"  type="text" id="nom" class="form-control" style="width: 290px;border-radius: 20px;">
					</div>
				
					<div class="form-group">
						<label>First Name</label>
						<input name="prenom"  type="text" id="prenom" class="form-control" style="width: 290px;border-radius: 20px;">
					</div>
				
					<div class="form-group">
						<label>Password</label>
						<input name="pass"  type="password" id="motdepasse" class="form-control" style="width: 290px;border-radius: 20px;">
					</div>
					
					<div class="form-group">
						<label>Comfirm your Password</label>
						<input name="confirm"  type="password" id="confirmotdepasse" class="form-control" style="width: 290px;border-radius: 20px;">
					</div>
					
					<div class="form-group">
						<input type="submit" value="save" class="btn btn-success" name="save" style=" width: 290px;">
					</div>
					
				</div>
				
			</form>
		</div>
		
		<script>
				function openNav() {
					document.getElementById("mySidenav").style.width = "250px";
					document.getElementById("main").style.marginLeft = "250px";
				}
				
				function closeNav() {
					document.getElementById("mySidenav").style.width = "0";
					document.getElementById("main").style.marginLeft= "0";
				}
				</script>
		</body>
	</html>
