
 <?php include 'post.php';?>

<!Doctype html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale=1>
      <meta name="description" content="A basic Hello World example for bootstrap">
      <meta name="author"  content="Your name">
  <title class="after">Learning - bootstrap01 </title>
  <!--Bootstrap css-->
   
   <link rel="stylesheet" href="css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/ser06.css">
   <link rel="icon" href="favicon.ico" />
   <link rel="icon" type="image/png" href="logo_400x400.png" />
</head>

<!--testing bootstrap sites using device emulator -->
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
        <div class="collapse navbar-collapse" id="navbar-container">
            <ul class="nav navbar-nav navbar-right">
               <li class="active"><a href="#">Enregistrement des Membres</a></li>
               <li><a href="#">Liste des Membres</a></li>
               <li class="dropdown"><a href="#" class="dropdown-toggle">Deconnexion</a></li>

            </ul>

        </div>

        </div>

    </nav>


   
       <script type="text/javascript" src="jQuery.js"></script>  
       <script type="text/javascript">
       function showdistrict() 
        {
          
            
                  $.post(
                     'post.php', // Un script PHP que l'on va créer juste après
                  {
                       //username : $("#username").val(),  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
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

          function showsector() 
          {
          //var pro=document.getElementById('akarere').value;
          //alert(pro);
            
                  $.post(
                     'post.php', // Un script PHP que l'on va créer juste après
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
                 //alert($("#akarere").val());  
                 
            }  
       
                     /* $(document).ready(function(){

                              $('#akarere').change(function(){
                            // récupérer la valeur du champ pays
                              var pays =$(this).val();
                              alert(pays);
                              $.ajax({

                                url:"exer.class.php",
                                type:"POST",
                                dataType : 'html',
                                data:pays,    
                                success: function(code_html,statut) 
                                { 
                                   //alert(code_html); 
                                   //$('#umurenge').html();
                                 
                                },

                                 error : function(resultat, statut, erreur)
                                 {
                                       
                                 },

                                 complete : function(resultat, statut)
                                 {

                                 }

                              
                               });
    
                                }); 
                                 });*/
      </script>

        <!-- creation d'un div avec un class"container " qui reduit sa taille horizontale   a droite et a gauche    -->

      <div class="container ">
        <div class="row">
  <div class="panel panel-info br">
    <div class="panel-heading"><h3>Enregistrement des membres</h3>
    </div>
   
 
      <div class="panel-body" style="background: url('old_map_@2X.png');">
        
     <div class="container">
         <div class="row">
     <form  action="exer.class.php" method="post" class="form" >
      
          <div class="col-md-4" >
        

                       <div class="form-group">
                          <label name="identity">No d'identite:</label>
                             <input type="text" id="irangamuntu" name="id" class="form-control">
                       </div>

                       <div class="form-group">
                          <label name="amazina">Nom:</label>
                          
                             <input  type="text" id="idname" name="name"  class="form-control" required="required" >
                              <h6 style="color:red">*Required field</h6>
                       </div>
                       <div class="form-group">
                          <label name="igitsina">Sex</label>
                              <?php
                                  require_once 'objet.php';
                                  include_once 'Membremanager.class.php';

                                     $mb=new Membremanager($bd);
                                     $mb->selectionner();
                                   
                             ?>
                             
                            <h6 style="color:red">*Required field</h6>
                       </div>
                       <div class="form-group">
                          <label name="irangamirere">Nationalite:</label>
                             <input type="text" id="irangamirere" name="nationality" class="form-control " required="required" >
                              <h6 style="color:red">*Required field</h6>
                       </div>
                       <div class="form-group">
                          <label name="se">Pere:</label>
                             <input type="text" id="pere" name="se" class="form-control">
                       </div>
                       <div class="form-group">
                          <label name="nyina">Mere:</label>
                             <input type="text" id="mere" name="nyina" class="form-control">
                       </div>
                       <div class="form-group">
                          <label name="ivuka">Date de naissance:</label>
                             <input  id="kuvuka" type="date" name="datebirth" class="form-control" required="required">
                             <h6 style="color:red">*Required field</h6>
                       </div>
                       <div class="form-group">
                          <label name="yakirijwe">Date de nouvelle naissance:</label>
                             <input id="gukizwa" type="date" name="datebornagain" class="form-control" >
                       </div>
                       <div class="form-group">
                          <label name="bapteme">Date de bapteme:</label>
                             <input id="kubatizwa" type="date" name="datebaptiz" class="form-control" >
                       </div>
                        <div class="form-group">
                          <label name="akazi">Travail:</label>
                             <input type="text" id="akazi" name="akazi" class="form-control" >
                       </div>
                       <div class="form-group">
                          <label name="membre">Membre depuis?:</label>
                             <input id="membre" type="date" name="membre" class="form-control" >
                       </div>

                       
                       
                  
      </div>
       <div class="col-md-4" style="padding-right:46px;"></div>
       <div class="col-md-4"  style="padding-right:36px;">

                       <div class="form-group">
                          <label name="ishuri">Niveau d'etude:</label>
                             <input type="text" id="ishuri" name="ishuri" class="form-control">
                       </div>

                       <div class="form-group">
                          <label name="Ishami">Faculte ou section:</label>
                             <input type="text" id="subject" name="subject" class="form-control" >
                       </div>
                        <div class="form-group">
                          <label name="impano">Talent:</label>
                             <input type="text" id="impano" name="impano" class="form-control" >
                       </div>
                        <div class="form-group">
                          <label name="mobile">TEL.MOBILE:</label>
                             <input type="text" id="mobile" name="mobile" class="form-control" >
                       </div>
                        <div class="form-group">
                          <label name="mail">Email:</label>
                             <input type="text" id="mail" name="mail" class="form-control" >
                       </div>
                        <div class="form-group" id="aka">
                          <label name="akarere">Akarere:</label>
                             <?php
                                  //require_once 'objet.php';
                                  include_once 'exerca.php';

                                     $mb=new exerca($bd);
                                     $mb->selectakarere();
                                    
                                   
                             ?>
                             <h6 style="color:red">*Required field</h6>
                       </div>
                        <div class="form-group" >
                          <label >Umurenge</label>
                          <select class="form-control" name="umurenge" id="umurenge" onchange="showsector();">
                             <option selected="selected"><?php echo null;?> </option>
                           
                          </select>
                            <h6 style="color:red">*Required field</h6>
                       </div>
                        <div class="form-group">
                          <label>Akagari:</label>
                           <select class="form-control" name="akagari" id="akagari" required="required">
                               <option selected="selected"> </option>
                             </select>
                            <h6 style="color:red">*Required field</h6>
                       </div>
                        <div class="form-group">
                          <label name="umudugudu">umudugudu:</label>
                            <select class="form-control" name="umudugudu" id="umudugudu" required="required">
                               <option selected="selected"> </option>
                             </select>
                          <h6 style="color:red">*Required field</h6>
                       </div>
                        <div class="form-group">
                          <label name="umurimo">Umurimo mwitorero</label>
                             <input type="text" id="subject" name="subject" class="form-control" >
                       </div>
                       <div class="form-group">
                      <input type="file" name="fichier" class="form-control" placeholder="file">
                      </div>

                       <div class="form-group">
                               <input type="submit"  value="Save" name="save" class="btn btn-success">
                               <a href="affiche.php">Afficher la liste des membres</a> 
                       </div>

                                 

      </div>
     
  </form>
         </div>
         </div>  
       </div>
     </div>
    </div>      

      </div>

</body>
</html>