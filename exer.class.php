<?php
    /**
    *
    */

    

    class exer
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
       $req = $this->db->prepare("SELECT * from colonne");
       $req->execute();
   ?>
       
        <div class="form-group">
        <select class="form-control" name="colonne">
           <option selected="selected"><?php echo null;?> </option>
       
      
      <?php
      $i=0;
      while($fetch=$req->fetch())
       {

      ?>
            <option ><?php $i++; echo $i;?></option>
            <?php
      }

      ?>
      </select>
        <h6 style="color:red">*Required field</h6>
      </div>
	   
	<?php
      // print_r($champs);
      //echo "</br>";
 
   }

   public function affichchamp($i)
   {

		$champs=null;
		$req=$this->db->prepare("SELECT * from colonne");
		$req->execute();
	?>
		<div class="col-md-3">
		</br>
		
		<div class="form-group">
		 <select class="form-control" name="<?php echo"colon $i"; ?>" id="<?php echo"$i"; ?>" onchange="javascript:showform(this)">
		   <option selected="selected"><?php echo null;?> </option>
		
		
		<?php
		
		while($fetch=$req->fetch())
		{
		
		?>
			<option ><?php echo $fetch['namecolonne'];?></option>
			<?php
		}
		
		?>
		
		 </select>
		</div>
		
				<div class="form-group">
					<label id="<?php echo 'lab'.$i;?>"></label>
					<select class="form-control" type="text" name="<?php echo 'colo'.$i; ?>" id="<?php echo 'champ'.$i;?>" style="visibility:hidden;">
					<option selected="selected"><?php echo null;?> </option>
					</select>
			  
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

      <select class="form-control" name="akarere" id="akarere" onchange="showprovince()">
           <option selected="selected"><?php echo null;?> </option>
       <?php
       while ($donnees=$req->fetch())
       {
        
        ?>
           <option><?php echo $donnees['nomprovince'];?></option>
      <?php
       }
        ?>
      </select>
      <?php
    }
    
    public function selectidakarere()
    {
           
           $akare=" ";
           if(isset($_POST['akarere']))
            $akare=$_POST['akarere'];
           $req=$this->db->prepare("SELECT id_province FROM province WHERE nomprovince=:nom");
           $req->execute(array(
           'nom'=>$akare
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