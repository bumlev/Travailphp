<?php
   session_start();
  
   class user
   {
	private $nom;
	private $prenom;
	private $code;
	private $password;
	private $pseudo;
	private $identifiant;
	private $db;
	private $nbre;
	
	function __construct($db)
	{
		$this->setdb($db);
		$this->nbre=0;
	}
	//////  les getters ////////////
	public function nom(){return $this->nom;}
	public function prenom(){return $this->prenom;}
	public function code(){return $this->code;}
	public function password(){return $this->password;}
	public function pseudo(){return $this->pseudo;}
	public function identifiant(){return $this->identifiant;}
	public function db(){return $this->db;}
	public function nbre(){return $this->nbre;}

/////////// les setters ////////////////////////////////


	public function setnom($nom)
	{
		$this->nom=$nom;
	}
	
	public function setprenom($prenom)
	{
		$this->prenom=$prenom;
	}
	
	public function setcode($code)
	{
	  $this->code=$code;
	}
	
	public function setpassword($password)
	{
	  if ($this->searchpassword($password)==0)
			$this->password=$password;
		else
		{
		   if ($this->nbre==0 )
		   {
			  $this->nbre++;
			  echo('<script>alert("Ce code existe deja dans vos enregistrments.Proposer un autre ");</script>');
		   }
	
	
		}
		
	}
	public function setmodifpassword($password)
	{
		$this->password=$password;
	}
	
	///////////// initialisation d'un pseudonyme- fichier:comptuserconfirm.php////////////////
	public function setpseudo($pseudo)
	{
	 	$this->pseudo=$pseudo;
	}
	
	//////////// initialisation d'un code d'acces - fichier:comptuserconfirm.php///////////////
	public function setidentifiant($identifiant)
	{
		$id=$this->searchidentifiant($identifiant);
	  if($id==0)
			$this->identifiant=$identifiant;
		  else
		  {
			if($this->nbre==0)
			{
		  		$this->nbre++;
				echo('<script> alert("Echec d enregistrement :Ce mot de passe de confirmation existe deja.Proposer un autre");</script>');
			}
		  }
	
	}
	
	////////////////////////////  CONNEXION   A LA    BASE DE DONNEES ///////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	///////////////////////////////INSTANCIATION DE LA BASE DE DONNEES////////////////////////////////////////////////////
	
	public function setdb(PDO $db)
	{
		$this->db=$db;
	}
	
	
	/// verification d'un password a inserer s'il n'existe pas dans table "user"///////////////////
	public function searchpassword($password)
	{
	   $i=0;
	   $re=$this->db->prepare('SELECT * FROM user');
	   $re->execute();
	   while ($donnees=$re->fetch())
		{
			if ($donnees['password']==$password)
			{
				$i++;
			}
		}
		$re->closeCursor();
		return $i;
	}
	
	
	
	
	  // Verification d'un mot de passe a confirmer s'il n'existe pas dans la table user
	
	public function searchidentifiant($identifiant)
	{
	   $i=0;
	   $re=$this->db->prepare('SELECT * FROM user');
	   $re->execute();
	   while ($donnees=$re->fetch())
		{
			if ($donnees['Identifiant']==$identifiant)
			{
			  $i++;
			}
		}
		$re->closeCursor();
		return $i;
	}
	
	 ////////////  DEMANDE D'ACCEES AU SYSTEME------ fichier:comptuser.php ///////////////////////////////////////
	
	public function demandeacces()
	 {
	
		 try
		 {
			
			if ($this->nbre==0)
			  {
				 $re=$this->db->prepare('INSERT INTO user(nom,prenom,Code,password) VALUES (:nom,:prenom,:code,:password)');
				 $re->execute(array(
				 'nom'=>$this->nom(),
				 'prenom'=>$this->prenom(),
				 'code'=>$this->code(),
				 'password'=>$this->password()
	
	  ));      $this->nbre++;
			   header('location:Signup.php');
			   echo('<script>alert("La demande est enregistre");</script>');
			   }
		  }
	  catch (Exception $e)
	  {
		 die('Erreur:'. $e->getMessage());
	  }
	
	 }
	
	
	
	
	////////// ajout d'un utilisateur de l'application------- fichier:comptuser.php /////////////////////////////////////////////////////////
	
	public function validateacces($idn)
	{
	 
		try
	  {
		if($this->nbre==0)
		{
	
	
		   $req=$this->db->prepare('UPDATE user set nom=:nom,prenom=:prenom,Code=:code,password=:password,pseudo=:pseudo,Identifiant=:identifiant WHERE Id=:id LIMIT 1');
	
		  $req->execute(array(
			 
			 'id'=>$idn,
			 'nom'=>$this->nom(),
			 'prenom'=>$this->prenom(),
			 'code'=>$this->code(),
			 'password'=>$this->password(),
			 'pseudo'=>$this->pseudo(),
			 'identifiant'=>$this->identifiant()
	
		  ));
	
	   echo('<script>alert("saving succeded");</script>');
	   echo "<h2>Vous avez valide l' acces  </h2> </br> ";
	   echo " <a href='afficheutilisateur.php'>Afficher la liste des utilisateurs</a>";
		}
	  }
	  catch (Exception $e)
	  {
		die('Erreur:'. $e->getMessage());
	  }
		
	}
	
	///////// Page de confirmation d'acces au systeme et d'affichage des coordonnees--- fichier: Page de confirmation.php/////////
	
	public function pageconfirm($code,$password)
	{
		$req=$this->db->prepare('SELECT * FROM user');
		$req->execute();
	
		while($donnees=$req->fetch())
		{
	
		  if ($donnees['Code']==$code And $donnees['password']==$password And !empty($donnees['pseudo']) And !empty($donnees['Identifiant']))
		  {
			echo "<h2>Vous avez accès au System</h2> </br>";
			echo "Votre pseudonyme est:    ".$donnees['pseudo']."</br> ";
			echo "Votre mot de passe est:  ".$donnees['Identifiant']."</br>";
			echo " <a href='formauthentification.php'>Connectez-vous</a>";
			break;
		  }
		  if (empty($donnees['pseudo']) And empty($donnees['Identifiant']))
		  {
		   echo " </br>Attendez le message de confirmation </br>";
		   echo " <a href='formauthentification.php'>Page d'accueil </a>";
		   break;
		  }
		 
		}
	
	
	}
	  ///////////////// BLOQUER OU DEBLOQUER L'ACCES ///////////////////////////////////////////////////////////////
	
	public function acces($id,$acces)
	 {
	
		$req=$this->db->prepare('UPDATE user set Acces=:acces WHERE Id=:id LIMIT 1');
		$req->execute(array(
		 'id'=>$id,
		 'acces'=>$acces
		));
		   if ($acces=='Autorise')
		   {
			 
			 echo ('<script>alert("you allowed access");history.back();</script>');
			 header('afficheutilisateur.php');
		   }
		   if ($acces=='Refuse')
			 {
			   echo ('<script>alert("You refused access");history.back();</script>');
			   header('afficheutilisateur.php');
			 }
		   if (empty($acces))
		   {
			 echo ('<script>alert("What do you validate ?");history.back();</script>');
			 header('afficheutilisateur.php');
		   }
		   
	 }
	
	public function nbrenregistrement()
	{
		$req=$this->db->prepare('SELECT COUNT(*) AS nb from user');
		$req->execute();
		$lignes	=	$req->fetch();
		$row	=	$lignes['nb'];
		return $row;
	}
	
	////////////////////////////  AUTHENTIFICATION----- fichier:formauthentification.php   //////////////////////////////////
	
	
	public function authentification($name,$password)
	 {
		 $re=$this->db->prepare('SELECT * FROM user ');
		 $re->execute();
		 $a=0;
		 $e=0;
		 $lignes=$this->nbrenregistrement();
		 
		 while ($donnees=$re->fetch())
		 {
			
			if($donnees['pseudo'] == $name And $donnees['Identifiant'] == $password and $donnees['Acces'] =='Autorise')
			{
			
				if(substr($donnees['pseudo'], 0,4) == 'EVJU')
					header('location:affiche.php');

				if(substr($donnees['pseudo'], 0,4) == 'EVJA' or substr($donnees['pseudo'], 0,4) =='EVJS' )
					header('location:affiche.php');
			
			}
			else
			{
			  if($donnees['pseudo']==$name  And $donnees['Identifiant']==$password And ($donnees['Acces']=='Refuse' or $donnees['Acces']==''))
			  	$a++;
			  if( ($donnees['pseudo']!=$name  Or $donnees['Identifiant']!=$password) And $donnees['Acces']=='Autorise')
			  	$e++;
			}
			
			
		 }
	   
		  	if($e >0 And $a<1 or $lignes == 0)
			 {
				echo('<script>alert(" Your pseudonym or password is not correct");history.back();</script>');
				//$this->heeaders();
			 }
	
	
		 	if($a==1)
			 {
				echo('<script>alert(" You do not have access ");history.back();</script>');
				//$this->heeaders();
			 }
				$re->closeCursor();
	 }
	
	 /// INITIALISER LES VARIABLES DE  SESSIONS
	
	public function session($pseudo,$motdepa)
	 {
		$_SESSION['no']=$pseudo;
		$_SESSION['motdepa']=$motdepa;
		
		$req=$this->db->prepare('SELECT * FROM user WHERE Identifiant=:identifiant LIMIT 1');
		
		$req->execute(array(
	
		 'identifiant'=>$motdepa
		));
		
		$donnees=$req->fetch();
		$_SESSION['id']=$donnees['Id'];
		$_SESSION['nom']=$donnees['nom'];
		$_SESSION['prenom']=$donnees['prenom'];
	
	 }
	
	/// MODIFIER SEULEMENT VOTRE MOT DE PASSE SUR L'ENTETE DE TOUS LES PAGES ACCEDES PAR L'UTILISATEUR////////////
	
	
	public function Edituser($password)
	{
		if(!empty($password))
		{
			
			$id_user = $_SESSION['id'];
			$req=$this->db->prepare('UPDATE user set Identifiant=:identifiant where Id=:id ');
			$req->execute(array(
					
					'id' => $id_user,
					'identifiant' => $password
			));
			echo '<script>alert("Password is edited");history.back();</script>';
			
			}
			else
			{
				echo '<script>alert("Your field is not filled");history.back();</script>';
			}
	}
	
	
	public function heeaders()
	 {
	
	  header('location:formauthentification.php');
	 }
	 /// FERMETURE DE SESSION /////////////////////////////////////////
	
	public function fermersession()
	 {
		    session_destroy();
		    unset($_SESSION['no']);
		    unset($_SESSION['motdepa']);
		    //unset($_SESSION['id']);
		    header('location:formauthentification.php');
	 }
	
     //Afficher la liste des membres de l'egise
	public function affiche()
   {
   	include 'pagin.php';
       $requet=$this->db->prepare('SELECT * FROM user   ORDER BY ID DESC LIMIT'.' '.$firstofpage.','.$perpage.'');
       $requet->execute();
       ?>
			<table style="margin-top: 40px;background-color:white;" class="table table-striped" >
				
				<thead style="background-color: chocolate;color: white;">
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Serial Number</th>
						<th>Access</th>
						<th></th>
					</tr>
				</thead>
                <tbody id="mytable">
       <?php
         while ( $donnees=$requet->fetch() )
           {
             ?>
               <tr>
                    <th ><?php echo $donnees['nom'];?></th>
                    <th ><?php echo $donnees['prenom'];?></th>
                    <th ><?php echo $donnees['pseudo'];?></th>
                    <th><form method="post" action="user.class.php"><input type="hidden" name="dei" value="<?=$donnees['Id']?>"><select name="acc" class="form-control col-md-10" style="height:32px;"><option  selected="selected"><?php echo $donnees['Acces'];?></option><option>Refuse</option><option>Autorise</option></select><th><button class="btn btn-info" name="btnvalid">Valider</button></th></form></th>

                    <!--<th ><a href="comptuserconfirm.php?nom=update&amp;id=<?/*=$donnees['Id'] */?>" ><button class="br">Edit</button></a></th>-->

                </tr>


          <?php
           }
             
             $requet->closeCursor();
           
           ?>
          </tbody>
        </table>

	   <ul class="pagination" id="pagination" style="visibility:visible;">
		   <li class="<?php if($current=='1'){echo "disabled";} ?>"><a href="?p=<?php if($current !='1'){echo($current-1); } else{echo $current;}?>&&pp=<?php if(isset( $_GET['pp'])) echo $_GET['pp'];?>#app">&laquo;</a></li>
		   <?php
		   for($i=1;$i<=$nbpage;$i++)
		   {
			   if($i==$current)
			   {
				   ?>
				   <li class="active"><a href="?p=<?php echo $i;?>&&pp=<?php if(isset( $_GET['pp'])) echo $_GET['pp'];?>#app"><?php echo $i;?></a></li>
				
				   <?php
			   }
			   else
			   {
				
				   ?>
				   <li><a href="?p=<?php echo	$i;?>&&pp=<?php if(isset( $_GET['pp'])) echo $_GET['pp'];?>#app"><?php echo $i;?></a></li>
				   <?php
				
			   }
			
		   }
		   ?>

		   <li class="<?php if($current==$nbpage){echo "disabled";} ?>"><a href="?p=<?php if($current!=$nbpage){echo($current+1); } else{echo $current;} ?>&&pp=<?php if(isset($_GET['pp'])) echo $_GET['pp'];?>#app">&raquo;</a></li>

	   </ul>
	   
<?php
   }
	
	public function show_user($id)
	{
		$requet=$this->db->prepare('SELECT * FROM user where md5(Id)=:id LIMIT 1');
		$requet->execute(array(
				
				'id'=>$id
		));
		?>
		<table style="margin-top: 40px;background-color:white;" class="table " >

			<thead style="background-color: chocolate;color: white;">
				<tr>
					<th>id</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Serial Number</th>
					<th>Password</th>
					<th>Access</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="mytable">
				<?php
				while ( $donnees=$requet->fetch() )
				{
					?>
					<tr>
						
						<?php echo '<th>'. $donnees['Id'].'</th>'; ?>

						<th ><?php echo $donnees['nom'];?></th>
						<th ><?php echo $donnees['prenom'];?></th>
						<th ><?php echo $donnees['pseudo'];?></th>
						<th ><?php echo md5($donnees['Identifiant']);?></th>

						<th><form method="post" action="user.class.php"><input type="hidden" name="dei" value="<?=$donnees['Id']?>"><select name="acc" class="form-control col-md-10" style="height:32px;"><option  selected="selected"><?php echo $donnees['Acces'];?></option><option>Refuse</option><option>Autorise</option> </select><th><button class="btn btn-info" name="btnvalid">Valider</button></th></form></th>

						<!--<th ><a href="comptuserconfirm.php?nom=update&amp;id=<?/*=$donnees['Id'] */?>" ><button class="br">Edit</button></a></th>-->

					</tr>
					
					
					<?php
				}
				
				$requet->closeCursor();
				
				?>
			</tbody>
		</table>
		<?php
	}
	public function selectgrpuser()
	{
		$req=$this->db->prepare('SELECT * from role where type=:type OR type=:type1');
		$req->execute(array(
				'type' => 'EVJU',
				'type1' =>'EVJA'
		));
		?>
		<select name="profil" id="profil" class="custom-select" size="0" style="height:34px; border-radius: 5px;">
		<option selected="selected" value="<?php echo null; ?>"><?php echo htmlentities('Select a Profil...');?></option>
		<?php
		while($donnees=$req->fetch())
		{
		?>
		<option value="<?=$donnees['id']?>" style="border-radius: 20px;"><?php echo htmlentities($donnees['nom']);?></option>
		<?php
		}
		?>
		</select>
		<?php
	}
	
	public function select_users_admin_supervisors()
	{
		$req=$this->db->prepare('SELECT * from role ');
		$req->execute();
		?>
		<select name="profil" id="profil" class="custom-select" size="0" style="height:34px; border-radius: 5px;">
			<option selected="selected" value="<?php echo null; ?>"><?php echo htmlentities('Select a Profil...');?></option>
			<?php
			while($donnees=$req->fetch())
			{
				?>
				<option value="<?=$donnees['id']?>" style="border-radius: 20px;"><?php echo htmlentities($donnees['nom']);?></option>
				<?php
			}
			?>
		</select>
		<?php
	}
	
	
	public function selectusers()
	{
		$req=$this->db->prepare('SELECT * from user');
		$req->execute();
		?>
		
		<select name="user" id="user" class="select" style="height:34px;border-radius:5px;" placeholder="search by user...">
			<option selected="selected"><?php echo(null);?></option>
			<?php
			while($donnees=$req->fetch())
			{
				?>
				<option value="<?=$donnees['Id']?>" style="border-radius: 20px;"><?php echo htmlentities($donnees['nom']).' '.htmlentities($donnees['prenom']);?></option>
				<?php
			}
			?>
		</select>
		<?php
	}
	
   }

  
?>



<?php
  require_once'objet.php';
   $us=new user($bd);

    ////////////////// DEMANDE D'ACCES ///////////////////////////

    if (isset($_POST['demander']) )
    {

      if (isset($_POST['name']))
        $us->setnom($_POST['name']);

      if (isset($_POST['prenom']))
        $us->setprenom($_POST['prenom']);

      if (isset($_POST['password']))
        $us->setpassword($_POST['password']);
  

      if(isset($_POST['code']))
        $us->setcode( $_POST['code']);

        $us->demandeacces();

       //header('location:Signup.php');
    }


   //////////////// VALIDER L'ACCES////////////////////////////////
   if (isset($_POST['validate']) )
   {
    if (isset($_POST['nam']))
      $us->setnom($_POST['nam']);

    if (isset($_POST['preno']))
      $us->setprenom($_POST['preno']);

    if(isset($_POST['cod']))
      $us->setcode( $_POST['cod']);

    if (isset($_POST['pass']))
      $us->setmodifpassword($_POST['pass']);

    if(isset($_POST['pseud']))
     $us->setpseudo( $_POST['pseud']);

    if(isset($_POST['passwor']))
     $us->setidentifiant( $_POST['passwor']);

     $us->validateacces($_POST['dim']);
	   
   }

   ////////// AUTORISE L'ACCES //////////////////////////////////
   if (isset($_POST['btnvalid']))
   {
		if (isset($_POST['dei']) And isset($_POST['acc']) )
		{
			$us->acces($_POST['dei'],$_POST['acc']);
		}
   }

   if( isset($_POST['aut'])  )
   {
		if( isset($_POST['no']) And isset($_POST['motdepa']) )
		{
			$us->session($_POST['no'],$_POST['motdepa']);
			$us->authentification($_POST['no'], $_POST['motdepa']);
	
		 }
   }
  
	if (isset($_GET['log']) And $_GET['log']=='logout')
       		$us->fermersession();
    
 	if(isset($_POST['motbutton']))
	{
		if(isset($_POST['motpass']))
			$us->Edituser($_POST['motpass']);
	}
?>




