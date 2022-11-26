<!Doctype html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="2">
  <title class="after">Church Management</title>
  <!--Bootstrap css-->
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
   <link rel="stylesheet" type="text/css" href="css/affi.css"/>
   
</head>
<body>
  <div class="container">
  <div class="row">
     <form method="post" action="asse.php">
        <div class="col-md-3"> 
     
        </br>
              <?php

    include_once 'exerca.php';
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

           $mb=new exerca($bd);
           $mb->affichnumb();

            ?>   


     <div class="form-group">         
        <button type="submit" class="btn btn-success" name="chercher" >search</button> 
     </div> 
     </div>
       
       <script type="text/javascript">
        
         
           function showform(elt) 
           {
             // $('#champ').attr({name:document.getElementById(elt.id).value});
               //alert(document.getElementById("champ " + elt.id).name);
               document.getElementById("champ " + elt.id).name=document.getElementById(elt.id).value;
               document.getElementById("lab " + elt.id).innerHTML=document.getElementById(elt.id).value;
               var form=document.getElementById(elt.id);
               var userinput=form.options[form.selectedIndex].value;
              if (userinput!='') 
              {
                 document.getElementById("champ " + elt.id).style.visibility='visible'; 
              }
              else
              {
                   if(userinput=='')
                     document.getElementById("champ " + elt.id).style.visibility='hidden';

                 return false;
              }
           }
        

       </script>

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
             
         
          
    
           
          
        
    </div> 
    
     </form> 

  </div>
  </div>
</body>
</html>