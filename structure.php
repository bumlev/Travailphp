<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="fr">
 
   
    <head>   
        <meta charset="utf-8">   
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Internet Explorer Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=2">  <!-- Mobile Specific Metas -->
         
        <!-- Les librairies CSS avec Bootstrap ET styles dans laquelle je place le code CSS du lien -->      
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <!-- Les scripts avec Bootstrap, JQuery (comme dans le lien) ET scripts où j'insère le code JS du lien --> 
              
        <!--script src="js/bootstrap.js"></script>
        <script src="js/jquery.js"></script>       
        <script src="js/scripts.js"></script-->  
    </head>
     
   
    <body>
        <!-- Header -->
          
              <nav id="navbar-main" class="navbar ">
            <div class="container navbar-inverse navbar-fixed-top">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   <a class="navbar-brand" rel="home" href="#" title="Buy Sell Rent Everyting">
                  <img style="width: 149px;margin-top:-10px;" src="eglisevivantelogo.png" class="brand">
                   </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Enregistrer les Membres</a></li>
                        <li><a href="#about">Liste des Membres</a></li>
                        <li><a href="#contact">Deconnexion</a></li>
            
                    </ul>
                </div>
            </div>
        </nav>
                
      
        <!-- Navigation    -->
        
        <!-- Content  -->
             <div class="container">
    <div class="row">
  <div class="panel panel-info">
    <div class="panel-heading"><h3>Enregistrement des membres<a href="user.class.php?log=<?=$nom ?>"><button class="btn btn-default pull-right">Logout</button></a></h3>
    </div>
   
 
      <div class="panel-body">
        <div class="container">
     <form  action="affiche.php" method="post" class="form-horizontal">
          <div class="col-md-6" >
        

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
                          <label name="igitsina">Sex:</label>
                             <select class="form-control" name="sex" required="required">
                               <option selected="selected"> </option>
                               <option >Gabo</option>
                               <option>Gore</option>
                             </select>
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
      <div class="col-md-6">

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
                        <div class="form-group">
                          <label name="akarere">Akarere:</label>
                             <input type="text" id="subject" name="subject" class="form-control" required="required">
                             <h6 style="color:red">*Required field</h6>
                       </div>
                        <div class="form-group">
                          <label name="umurenge">Umurenge</label>
                             <input type="text" id="umurenge" name="umurenge" class="form-control" required="required">
                            <h6 style="color:red">*Required field</h6>
                       </div>
                        <div class="form-group">
                          <label name="akagari">Akagari:</label>
                             <input type="text" id="akagari" name="akagari" class="form-control" required="required">
                            <h6 style="color:red">*Required field</h6>
                       </div>
                        <div class="form-group">
                          <label name="umudugudu">umudugudu:</label>
                             <input type="text" id="umudugudu" name="umudugudu" class="form-control" required="required">
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

   










    </body>
 
</html>





