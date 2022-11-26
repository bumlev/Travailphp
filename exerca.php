<?php
    /**
    *
    */

     //include'post.php';


    
     

    class exerca
    {
      
      private $db;
     
     
      function __construct($db)
      {
         $this->setdb($db);
      }

    // Instancier une classe de la base de donnees
      public function setdb(PDO $db)
      {
       $this->db=$db;
      }
      

     public function affichnumb()
   {
       $champs=null;
       $req = $this->db->prepare("SELECT column_name FROM information_schema.columns WHERE table_schema= 'blog' AND table_name='membre'");
       $req->execute();
  ?>
       
        <div class="form-group">
        <select class="form-control" name="colonne">
        <option selected="selected"><?php echo null;?> </option>
       
      
        <h6 style="color:red">*Required field</h6>
    <?php
      $i=0;
      while($fetch = $req->fetch())
       {
       
       ?>
      
            <option ><?php /*echo $fetch['column_name'];*/ $i++; echo $i;?></option>

            <?php //$champs[] .=$fetch['column_name'];
 
      }

      ?>
      </select>
      </div>
      <?php
      // print_r($champs);
      //echo "</br>";
 
   }

   public function affichchamp($i)
   {

       $champs=null;
       $req=$this->db->prepare("SELECT column_name FROM information_schema.columns WHERE table_schema= 'blog' AND table_name='membre'");
       $req->execute();
    ?>
      <div class="col-md-3">
       </br>
       
       <div class="form-group">
         <select class="form-control" name="<?php echo"colon $i"; ?>" id="<?php echo"$i"; ?>" onchange="javascript:showform(this)">
         <option selected="selected"><?php echo null;?> </option>
       
      
    <?php
  
      while($fetch = $req->fetch())
       {
       
       ?>
            <option ><?php echo $fetch['column_name'];?></option>
            <?php //$champs[] .=$fetch['column_name'];
 
       }

      ?>
     
         </select>
         </div>
             <div class="form-group">
               <label id="<?php echo "lab $i";?>"></label>

               <input class="form-control" name="<?php echo"colo $i"; ?>" id="<?php echo"champ $i"; ?>" style="visibility:hidden;">
             </div>
      </div>
      <?php
      // print_r($champs);
      //echo "</br>";
 
   }


////// affiche Select avec province
    


    public function selectakarere()
    {
       $req=$this->db->prepare("SELECT * FROM province");
       $req->execute();
       ?>
      <select class="custom-select" style="border-radius:5px;height:34px;" name="intara" id="intara" size="0" onchange=" showdistrict();">
           <option selected="selected" value="<?php echo(null) ;?>"><?php echo htmlentities('Select Province...'); ?></option>
       <?php
       while ($donnees=$req->fetch())
       {
        
        ?>
           <option  value="<?php echo $donnees['id_province'];?>"><?php echo $donnees['nomprovince'];?></option>
      <?php
       }
        ?>
      </select>
      <?php
    }
         public function selectakareremodif($intara)
       {

       $req=$this->db->prepare("SELECT * FROM province");
       $req->execute();
       ?>

      <select class="form-control" name="intara" id="intara" size="0" onchange="showdistrict();">
           <option selected="selected" value="<?=$intara?>"><?php echo $intara ;?></option>
       <?php
       while ($donnees=$req->fetch())
       {
        
        ?>
           <option  value="<?php echo $donnees['id_province'];?>"><?php echo $donnees['nomprovince'];?></option>
      <?php
       }
        ?>
      </select>
      <?php

      }
 

    public function selectidakarere($akarere)
    {
           $req=$this->db->prepare("SELECT id_province FROM province WHERE nomprovince=:nom");
           $req->execute(array(
           'nom'=>$akarere
              ));
           
       ?>
         <select class="form-control" name="umurenge" id="umurenge">
          <option selected="selected"><?php echo null;?> </option>
       <?php

       while($donnees=$req->fetch())
       {
       ?>
           
           <option><?php echo $donnees['id_province'];?></option>
          
      <?php
         }
     ?>
       </select>
  <?php
    
    }

    }
    





?>