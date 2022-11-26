
<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="1">
      <title>Liste des Membres</title>

        <link rel="stylesheet" type="text/css"  href="css/bootstrap.min.css"/>
        <link rel="stylesheet"  type="text/css"  href="css/ser06.css">
        <link rel="stylesheet"  type="text/css"  href="css/form.css">
        <link rel="icon" href="favicon.ico" />
        <link rel="icon" type="image/png" href="logo_400x400.png" />

       <script type="text/javascript" src="js/bootstrap.min.js"></script>
       <script type="text/javascript" src="js/jquery.min.js"></script>  
</head>
<body style="background: url('old_map_@2X.png');">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
        <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-container">
                 <span class="sr-only"> Show and Hide the navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
              </button>
              <a href="#" class="navbar-brand">
                <img src="eglisevivantelogo.png" style="width: 149px;margin-top:-10px;">
              </a>
        </div>
            <?php
      if (!isset($_SESSION['no']) And !isset($_SESSION['motdepa'])) 
          header('location:formauthentification.php');

      $nom='logout';
    ?>

        <div class="collapse navbar-collapse" id="navbar-container">
            <ul class="nav navbar-nav navbar-right">
               <li><a href="Church Management.php">Enregistrement des Membres</a></li>
               <li class="active"><a href="affiche.php">Liste des Membres</a></li>
               <li class="dropdown"><a href="user.class.php?log=<?=$nom ?>">Deconnexion</a></li> 

            </ul>

        </div>

        </div>

    </nav>

<div class="container">
<div class="row ">
<div class="col-md-3 searc">
          <div class="form-group">
             <input type="text" class="form-control" placeholder="Search" id="myin">
          </div>
  
  <form action="exer.php" method="post">
    <div class="form-group">
         <?php
            
            if (!isset($_SESSION['no']) And !isset($_SESSION['motdepa'])) 
            {
               header('location:formauthentification.php');
            }

       include_once 'exer.class.php';
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

        $mb=new exer($bd);

         $mb->affichnumb();  
            ?>               
     </div>

     <div class="form-group">         
        <button type="submit" class="btn btn-success" name="chercher" id="app">create</button> 
     </div>
   </form>
   
   <script type="text/javascript">
        
        
           function showform(elt) 
           {
               //$('#champ').attr({name:document.getElementById(elt.id).value});
               //alert(document.getElementById("champ " + elt.id).name);
               //executer();
               var form=document.getElementById(elt.id);
               var userinput=form.options[form.selectedIndex].value; 
                
               if (userinput!='')  
                {
                 
                 //alert(document.getElementById(elt.id).value);
                 document.getElementById("champ" + elt.id).name=document.getElementById(elt.id).value;
                 document.getElementById("champ" + elt.id).style.visibility='visible';   
                 document.getElementById("lab" + elt.id).innerHTML=document.getElementById(elt.id).value;
                 //document.getElementById("champ" + elt.id).id=document.getElementById(elt.id).value;
                 //var sd='#' +document.getElementById(elt.id).value;
                 //alert(document.getElementById("champ" + elt.id).name);
                   var conv=elt.id;
                   var sd= "#champ" + conv;



                 //alert(sd);
                 $.post(
                     'postmanage.php', // Un script PHP que l'on va créer juste après
                   {
                       //username : $("#username").val(),  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                       search:document.getElementById(elt.id).value,
                       ident:elt.id
                   },
                    
                   function (data)
                   {
                      //alert(data);
                      $(sd).html(data); 
                   }

                  );  
               
                }

              else
              {
                   
                 
                   if(userinput=='')
                   {
                     document.getElementById("champ" + elt.id).style.visibility='hidden';
                     document.getElementById("lab" + elt.id).innerHTML='';
                    }
                 return false;
              }
           }

           function executer()
           {
               //window.location.replace('exer.php');
               //seTimeOut(5); 

           }



       </script>
      
         
 </div>
</div>

 <div  class="container">
  <div class="row">
	   <form action="indexo.php" method="post">
      
     <?php

        $i=1;
        if(isset($_POST['colonne'])) 
           {

            while ($i <= $_POST['colonne']) 
            {
              $mb->affichchamp($i);          
              $i++;
            }

            }
            ?>
             
              </br>
              <div class="form-group">         
                 <button type="submit" class="btn btn-success" name="cherch" >search</button> 
              </div> 

      </form> 

</div>
</div>
<div class="row">

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

         if (isset($_POST['id']) And isset($_POST['save'])) 
           $membre->setId($_POST['id'],$mb);

         if (isset($_POST['id']) And isset($_POST['update'])) 
           $membre->setIdmodif($_POST['telnum'],$mb, $_POST['id']);

         if (isset($_POST['name'])) 
           $membre->setName($_POST['name']);

        if (isset($_POST['sex'])) 
          $membre->setSex($_POST['sex']);

        if (isset($_POST['nationality'])) 
          $membre->setNationality($_POST['nationality']);

        if (isset($_POST['se'])) 
          $membre->setSe($_POST['se']);

        if (isset($_POST['nyina'])) 
          $membre->setNyina($_POST['nyina']);

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

        if (isset($_POST['fichier'])) 
          $membre->setimg($_POST['fichier']);

          /////////// ajout d'un membre/////////////////////////////////////////////////////////////////////
         if (isset($_POST['save'])) 
         {
            $mb->addmembre($membre);
            $mb->affiche();
         }
          ///////////////////////// Modifier un membre ///////////////////////////////////////////////
         if (isset($_POST['update'])) 
         {
             $mb->update($_POST['telnum'],$membre);
             $mb->affiche();
            
         }
        
        //////////////////////supprimer un membre//////////////////////////////////////////////////////

     if (isset($_GET['id'])And isset($_GET['nom']) And $_GET['nom']=='delete') 
      {
         $mb->deletemb($_GET['id']);
         $mb->affiche();
      }

      if (!isset($_POST['save']) And !isset($_POST['update']) And !isset($_GET['id']) And !isset($_POST['search'])) 
      {
        $mb->affiche(); 
      }/*
        if (isset($_POST['search']) And isset($_POST['recherche']) And !empty($_POST['recherche'])) 
        {
          $mb->selection( $_POST['recherche'] );
        }*/
       
     /* $stri='levy';   
      $mo=" $stri Bumwe"; 
      echo($mo);*/




?>

<script>
$(document).ready(function(){
  $("#myin").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#mytable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
 

</div>
</div>
</body>
</html>



