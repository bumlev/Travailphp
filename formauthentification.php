
<!DOCTYPE html>
<html>
<head>
	<title> LOG IN</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="faux.css">
    <link rel="icon" type="image/png" href="logo_400x400.png"/>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap1.css"/>
	<link rel="stylesheet" href="fontawesome-free-5.2.0-web/css/all.css">

	<!--
	<link rel="stylesheet"  type="text/css" href="css/ser06.css">
	<link rel="stylesheet"  type="text/css" href="css/form.css">-->

	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/dropdown.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/responsive-paginate.js"></script>
</head>

<body class="img-responsive">
<!--<div class="pull-left top" >
	<img src="logo_400x400.png" style="height:100px;width:90px;">
</div>-->
<div class="container-fluid bg">
     <div class="row ">
         <div class="col-md-4 col-sm-4 col-xs-12 "></div>

         <div class="col-md-4 col-sm-4 col-xs-12 " style="margin-top:50px;">
          <!-- <img src="auth.jpg" class="us">-->

             <form class="form-conatiner" method="post" action="user.class.php">
<!--                 <h2>Connectez-vous ici</h2>-->
                 <div class="form-group">
                     <p for="exampleInputEmail1">UserId</p>
                         <input type="text" class="form-control" name="no" id="exampleInputEmail1" placeholder="UserId" required="required">
                 </div>

                 <div class="form-group">
                     <p for="exampleInputPassword1">Password</p>
                         <input type="password" class="form-control" name="motdepa" id="exampleInputPassword1" placeholder="Password" required="required">
                 </div>

                 <button type="Submit" class="b btn-block" name="aut">Login</button>
             </form>
         </div>
        <div class="col-md-4 col-sm-4 col-xs-12 "></div>


     </div>
 </div>
