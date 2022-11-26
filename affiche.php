<?php
include_once 'user.class.php';
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width", initial-scale="2">
			
			<title>List of Members</title>
			
			<!--link rel="icon" href="favicon.ico"/-->
			<link rel="icon" type="image/png" href="logo_400x400.png"/>
			
			<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
			<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
			<link rel="stylesheet" href="fontawesome-free-5.2.0-web/css/all.css">
			<link rel="stylesheet" type="text/css" href="css/chosen.min.css">
			
			
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
					z-index: 999;
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

				<?php
					if(isset($_SESSION['no']) And isset($_SESSION['motdepa']) And substr($_SESSION['no'],0,4) =='EVJA' or isset($_SESSION['no']) And isset($_SESSION['motdepa']) And substr($_SESSION['no'],0,4) =='EVJS')
					{
				?>
				<span style="font-size:30px;cursor:pointer;color:white;" onmouseover="openNav()">&#9776;</span>
						<?php
					}
				  ?>
				<a class="navbar-brand" href="#"><img src="eglisevivantelogo.png" style="width:229px;margin-top:-23px;"></a>
				
				<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon "></span>
				</button>
				<?php
				if (!isset($_SESSION['no']) And !isset($_SESSION['motdepa']))
					echo '<script>document.location.href="index.php"</script>';
				
				$nom='logout';
				?>
				<div class="collapse navbar-collapse " id="navbarNav">

					<ul class="navbar-nav navbar-right mr-auto">
						<li class="nav-item"><a class="nav-link"><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']?></a></li>
						<!--<li class="nav-item"><a href="Church Management.php" class="nav-link">Registration of members</a></li>-->
						<?php
						if(substr($_SESSION['no'],0,4)=='EVJU')
						{
						?>
						<li class="nav-item active table-active " style="height:60px;background-color: black"><a href="affiche.php" class="nav-link">List of Members</a></li>
							<?php
						}
						?>
						
						<?php
						   if(substr($_SESSION['no'],0,4)=='EVJU')
						   {
						?>
						<li class="nav-item" style="background-color:unset; border-radius: 20px; text-decoration:none;"><a href ="modifierprofil.php?nom=update&amp;id=<?=$_SESSION['id'] ?>" style="color: #fff;text-decoration:none;" class="nav-link">Edit Profil</a></li>
						<?php
						   }
						?>
						
						<?php
						if(substr($_SESSION['no'],0,4)=='EVJU')
						{
						?>
						<li class="nav-item"><a href="user.class.php?log=<?=$nom ?>" class="nav-link">Logout</a></li>
							
							<?php
						}
						?>
					</ul>
					
				</div>
				
			</nav>
			
			
			<?php
					if(substr($_SESSION['no'],0,4)=='EVJA' or substr($_SESSION['no'],0,4)=='EVJS')
					{
			
			?>

			<div id="mySidenav" class="sidenav ">
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
			<?php
					}
			?>
			
			
			
			
		
			<div class="container" onmouseover="closeNav()">
				<!--<form >-->
					
					<div class="form-group">
						<input type="text" autocomplete="off" class="form-control " style="width:170px;" name="name_search" id="name_search" placeholder="Search by Name...">
					</div>
					<div class="form-group" id="result_name" style="position:absolute; max-height:200px;overflow:auto;width: 230px;"></div>
				<!--</form>-->
				
				<form action="indexo.php" method="post">
					<div class="form-row">
						<div class="form-group" style="display:none;">
							<?php
							$user=new user($bd);
							$user->selectusers();
							?>
						</div>
						
						<div class="form-group gender"  style="margin-left:3px;width:170px;">
							<?php
								include 'Membremanager.class.php';
								$membre = new Membremanager($bd);
								$membre ->selectgender();
							?>
						</div>

						<div class="form-group" style="margin-left: 3px;width:170px;">
							<!--<input type="text" autocomplete="off" name="Cell" class="form-control" placeholder="Search by Cell..." id="cell_search">-->
							<?php
							$membre = new Membremanager($bd);
							$membre ->selectcell();
							?>
							<div class="form-group" id="result_cell" style="position: absolute; max-height:200px;overflow:auto;width: 175px;"></div>
						</div>

						<div class="form-group" style="margin-left: 3px;width:170px;">
							<?php
							$membre->selectdepart();
							?>
							<div class="form-group" id="result_department" style="position: absolute; max-height:200px;overflow:auto;width: 175px;"></div>
						</div>

						<div class="form-group" style="margin-left: 3px;width:170px;">
							<!--<input type="text" autocomplete="off" name="civilstatus" class="form-control" placeholder="Search by Civil status..." id="civilstatus_search">-->
							<?php
								$membre->selectetatcivil();
							?>
							<div class="form-group" id="result_civilstatus" style="position: absolute; max-height:200px;overflow:auto;width: 175px;"></div>
						</div>

						<div class="form-group" style="margin-left: 3px;">
							<!--<input type="text" autocomplete="off" name="level_study" class="form-control" placeholder="Search by Level of study..." id="level_study_search">-->
							<?php
								$membre->selectstudylevel();
							?>
							<div class="form-group" id="result_level_study" style="position: absolute; max-height:200px;overflow:auto;width: 175px;"></div>
						</div>
						
						<div class="form-group" style="margin-left: 3px;">
							<input type="submit" class="btn btn-info fa fa-search" name="cherch" value="Search" style="margin-left:4px;">
						</div>
					</div>

				</form>
			</div>
		
			<div class="table-responsive-md" style="margin-left:62px;margin-right:62px;" onmouseover="closeNav();">
				<?php
				require_once 'objet.php';
				include_once 'Membremanager.class.php';
				$mb=new Membremanager($bd);
				
				if (isset($_GET['id'])And isset($_GET['nom']) And $_GET['nom']=='delete')
				{
					$mb->deletemb($_GET['id']);
					$mb->affiche();
				}
				else
					$mb->affiche();
				
				?>
			</div>
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
					})
				});
				
				
				
				
				$('.select').chosen({width:"350px", search_contains: true, inherit_select_classes: true});
				$(document).ready(function(){
					$('#name_search').keyup(function(){
						var name=$(this).val();
						
						if(name !='')
						{
							$.post(
							'postmanage.php',
							{
								name:name
							},
							function(data)
							{
								$('#result_name').fadeIn();
								$('#result_name').html(data);

							});
							
						}
						else if(name =='')
						{
							$('#result_name').html('');
						}

					});

				});
				
				
/////////////////////////     SEARCH USER    //////////////////////////
				
				
				$(document).ready(function(){
					/////// TYPE   //////////
					$('#user_search').keyup(function(){
						var user=$(this).val();
						if(user !='')
						{
							$.post(
								'postmanage.php',
								{
									user:user
								},
								function(data)
								{
									$('#result_user').fadeIn();
									$('#result_user').html(data);
	
								});
						}
						else if(user=='')
						{
							$('#result_user').html('');
						}
					});
					
					$('#result_user').on('click','li',function ()
					{
							$('#user_search').val($(this).text());
							$('#result_user').fadeOut();
						
					});
					
				});
				
/////////////////////////////   SEARCH  GENDER ///////////////////////////////////////////////

				$(document).ready(function(){
					/////// TYPE   //////////
					$('#gender_search').keyup(function(){
						var gender=$(this).val();
						if(gender !='')
						{
							$.post(
								'postmanage.php',
								{
									gender:gender
								},
								function(data)
								{
									$('#result_gender').fadeIn();
									$('#result_gender').html(data);

								});
						}
						else if(gender=='')
						{
							$('#result_gender').html('');
						}
					});

					$('#result_gender').on('click','li',function ()
					{
						$('#gender_search').val($(this).text());
						$('#result_gender').fadeOut();

					});

				});
////////////////////////////      SEARCH CELL //////////////////////

				$(document).ready(function(){
					/////// TYPE   //////////
					$('#cell_search').keyup(function(){
						var cell=$(this).val();
						if(cell !='')
						{
							$.post(
								'postmanage.php',
								{
									cell:cell
								},
								function(data)
								{
									$('#result_cell').fadeIn();
									$('#result_cell').html(data);

								});
						}
						else if(cell=='')
						{
							$('#result_cell').html('');
						}
					});

					$('#result_cell').on('click','li',function ()
					{
						$('#cell_search').val($(this).text());
						$('#result_cell').fadeOut();

					});

				});
				////////////////////////////      SEARCH DEPARTMENT  //////////////////////
				
				
				$(document).ready(function(){
					$('#department_search').keyup(function(){
						var department=$(this).val();
						if(department !='')
						{
							$.post(
								'postmanage.php',
								{
									department:department
								},
								function(data)
								{
									$('#result_department').fadeIn();
									$('#result_department').html(data);

								});
						}
						else if(department=='')
						{
							$('#result_department').html('');
						}
					});

					$('#result_department').on('click','li',function ()
					{
						$('#department_search').val($(this).text());
						$('#result_department').fadeOut();

					});

				});

				///////////          SEARCH CIVIL STATUS  ////////////////////////////

				$(document).ready(function(){
					
					$('#civilstatus_search').keyup(function(){
						var civilstatus=$(this).val();
						if(civilstatus !='')
						{
							$.post(
								'postmanage.php',
								{
									civilstatus:civilstatus
								},
								function(data)
								{
									$('#result_civilstatus').fadeIn();
									$('#result_civilstatus').html(data);

								});
						}
						else if(civilstatus=='')
						{
							$('#result_civilstatus').html('');
						}
					});

					$('#result_civilstatus').on('click','li',function ()
					{
						$('#civilstatus_search').val($(this).text());
						$('#result_civilstatus').fadeOut();

					});

				});



				///////////          SEARCH LEVEL OF STUDY  ////////////////////////////

				$(document).ready(function(){

					$('#level_study_search').keyup(function(){
						var level_study=$(this).val();
						if(level_study !='')
						{
							$.post(
								'postmanage.php',
								{
									level_study:level_study
								},
								function(data)
								{
									$('#result_level_study').fadeIn();
									$('#result_level_study').html(data);

								});
						}
						else if(level_study =='')
						{
							$('#result_level_study').html('');
						}
					});

					$('#result_level_study').on('click','li',function ()
					{
						$('#level_study_search').val($(this).text());
						$('#result_level_study').fadeOut();

					});

				});

				
				$('.pagination').rPage();

			</script>

			<script>
				function openNav() {
					document.getElementById("mySidenav").style.width = "250px";
				}

				function closeNav() {
					document.getElementById("mySidenav").style.width = "0";
				}
			</script>
		</body>

	</html>



