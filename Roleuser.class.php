<?php

class Roleuser
{
	private $iduser;
	private $idrole;
	private $nom;
	private $prenom;
	private $serialnumber;
	private $chiffres;
	private $lettres;
	private $motdepasse;
	private $confirmotdepasse;
	private $nbrerreurs;
	private $db;
	
	function __construct($db)
	{
		$this->setdb($db);
		$this->nbrerreurs=0;
	}
	/////////////    LES GETTERS  ////////////////////////////
	public function iduser(){return $this->iduser;}
	public function idrole(){return $this->idrole;}
	public function nom(){return $this->nom;}
	public function prenom(){return $this->prenom;}
	public function serialnumber(){return $this->serialnumber;}
	public function chiffres(){return $this->chiffres;}
	public function lettres() { return $this->lettres;}
	public function motdepasse(){return $this->motdepasse;}
	public function confirmotdepasse(){return $this->confirmotdepasse;}
	public function nbrerreurs(){return $this->nbrerreurs;}
	
	////////////////    LES SETTERS  ///////////////////////////////
	public function setiduser($iduser)
	{
		$this->iduser=$iduser;
	}
	
	public function setidrole($idrole)
	{
		$this->idrole=$idrole;
	}
	
	public function setnom($nom)
	{
		$this->nom=$nom;
	}
	
	public function setprenom($prenom)
	{
		$this->prenom=$prenom;
	}
	
	public function setserialnumber($serialnumber)
	{
		
		$this->serialnumber=$serialnumber;
	}
	
	public function setchiffres($typerole)
	{
		$lignes = $this->nbrenregistrement($typerole);
		
		if($lignes == 0)
		{
			$this->chiffres=1;
		}
		
//		$num = $this->dernierchiffres($typerole);
		
		
		if($lignes > 0)
		{
			$num = $this->dernierchiffres($typerole) + 1;
			$this->chiffres=$num;
		}
		elseif($lignes > 0 && $this->chiffres ==1000)
			$this->chiffres = 1;
		
	}
	
	public function setlettres($typerole)
	{
		$lignes = $this->nbrenregistrement($typerole);
		
		if($lignes == 0)
		{
			$lettres = "A";
			$this->lettres = $lettres ;
		}
		
		$annee_nombre_serie = substr($this->derniernombre_serie($typerole),4,2);
		$actual_year = substr(date('Y',strtotime('now')), 2,2) ;
		
		$difference_year = $actual_year - $annee_nombre_serie;
		
		if($lignes > 0 && $this->chiffres() <= 999 && $difference_year <= 0 )
		{
			$lettres = $this->dernierlettres($typerole);
			$this->lettres = $lettres;
		}
		
		
		elseif($lignes > 0 && $this->chiffres() >= 1000 && $difference_year <= 0 )
		{
			$lettres = $this->dernierlettres($typerole);
			
			if($this->chiffres() == 1000 )
			{
				$lettres++;
				$this->chiffres = 1;
			}
			$this->chiffres = $this->chiffres() ;
			$this->lettres =$lettres;
		}
		
		elseif($lignes > 0 &&  $difference_year > 0)
		{
			$this->chiffres =1;
			$this->lettres = "A";
		}
		
	}
	
	public function setmotdepasse($motdepasse)
	{
		
		$password=$this->searchmotdepasse($motdepasse);
		if($password==0 and !empty($motdepasse))
		{
			$this->motdepasse = $motdepasse;
		}
		else
		{
			if($this->nbrerreurs==0 and $password > 0)
			{
				$this->nbrerreurs++;
				echo('<script> alert("Failure of registration :This password already exists.Type an other");history.back();</script>');
			}
			
			if($this->nbrerreurs==0 and empty($motdepasse))
			{
				$this->nbrerreurs++;
				echo('<script> alert("Failure of registration :Fill the password");history.back();</script>');
			}
		}
	}
	
	public function setconfirmotdepasse($confirmotdepasse)
	{
		$password = $this->motdepasse();
		
		if( $confirmotdepasse == $password and ! empty($confirmotdepasse))
		{
			$this->confirmotdepasse = $confirmotdepasse;
			
		}
		else
		{
			if($this->nbrerreurs == 0 and $confirmotdepasse != $password)
			{
				$this->nbrerreurs++;
				echo('<script> alert("Failure of registration :The passwords do not  match");history.back();</script>');
			}
			
			if($this->nbrerreurs == 0 and empty($confirmotdepasse))
			{
				$this->nbrerreurs++;
				echo('<script> alert("Failure of registration :Fill the password confirm");history.back();</script>');
			}
		}
	}
	
	public  function setEditpassword($motdepasse)
	{
		$siExiste=$this->searchmotdepasse($motdepasse);
		if($siExiste==0 and !empty($motdepasse))
		{
			$this->motdepasse = $motdepasse;
		}
		else
		{
			if($this->nbrerreurs==0 and $siExiste > 0)
			{
				$this->nbrerreurs++;
				echo('<script> alert("Failure of registration :This password already exists.Type an other");history.back();</script>');
			}
			
		}
	}
	/// VERIFIER SI LE MOT DE PASSE N'EXIISTE PAS DANS LA BASE DE DONNEE ////////
	public function searchmotdepasse($identifiant)
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
	
	public function setdb(PDO $db)
	{
		$this->db=$db;
	}
	
	public function createuser()
	{
		
		try
		{
			
			if($this->nbrerreurs == 0)
			{
				$requet=$this->db->prepare('INSERT INTO user(nom,prenom,pseudo,password,Identifiant,chiffre,lettre) VALUES (:nom,:prenom,:serialnumber,:motdepasse,:confirmotdepasse,:chiffre,:lettre)');
				$requet->execute(array(
				
					'nom' => $this->nom(),
					'prenom' => $this->prenom(),
					'serialnumber' => $this->serialnumber(),
					'motdepasse' => $this->motdepasse(),
					'confirmotdepasse' => $this->confirmotdepasse(),
				    'chiffre' => $this->chiffres(),
				    'lettre' => $this->lettres()
				));
				
				$requet=$this->db->prepare('SELECT Id from user ORDER BY Id  DESC LIMIT 1 ');
				$requet->execute();
				$row=$requet->fetch();
				$iduser=$row['Id'];
				$this->setiduser($iduser);
				
				$requet=$this->db->prepare('INSERT INTO roleuser(idrole,iduser) VALUES (:idrole,:iduser) ');
				$requet->execute(array(
				'idrole'=>  $this->idrole(),
				'iduser'=>  $this->iduser()
				
				));
				
				echo '<script>alert("the User '.$this->nom().' is Saved ");history.back(); </script>   ';
			}
			else
			{
			
			}
		}
		catch (Exception $e)
		{
			die('Erreur:'.$e->getMessage());
		}
		
	}
	
	public function Edituser($userid)
	{
		if($this->nbrerreurs() == 0)
		{
			
			if(!empty($this->motdepasse()))
			{
				$req=$this->db->prepare('UPDATE user set nom=:nom,prenom=:prenom,Identifiant=:identifiant where Id=:id ');
				$req->execute(array(
					
					'id' => $userid,
					'nom' => $this->nom(),
					'prenom' => $this->prenom(),
					'identifiant' => $this->motdepasse()
				));
			}
			elseif(empty($this->motdepasse()))
			{
				$req=$this->db->prepare('UPDATE user set nom=:nom,prenom=:prenom where Id=:id ');
				$req->execute(array(
					
					'id' => $userid,
					'nom' => $this->nom(),
					'prenom' => $this->prenom(),
				));
			}
			
			echo '<script>alert("The user  is edited");history.back();</script>';
			
		}
		else
		{
			echo '<script>alert("The user is not edited");history.back();</script>';
		}
	}
	
	public function nbrenregistrement($typerole)
	{
		$req=$this->db->prepare('SELECT COUNT(*) AS nb  FROM user where substring(pseudo,1,4)=:pseudo ');
		$req->execute(array(
			'pseudo' => $typerole
		));
		$row = $req->fetch();
		$lignes=$row['nb'];
		return $lignes;
	}
	
	public function dernierchiffres($typerole)
	{
		$req=$this->db->prepare('SELECT chiffre FROM user where substring(pseudo,1,4)=:pseudo ORDER BY Id DESC LIMIT 1');
		$req->execute(array(
			'pseudo' => $typerole
		));
		$row=$req->fetch();
		$chiffres=$row['chiffre'];
		return $chiffres;
	}
	
	public function dernierlettres($typerole)
	{
		$req=$this->db->prepare('SELECT lettre FROM user where substring(pseudo,1,4)=:pseudo ORDER BY Id DESC LIMIT 1');
		$req->execute(array(
			'pseudo' => $typerole
		));
		$row=$req->fetch();
		$lettres=$row['lettre'];
		return $lettres;
	}
	
	public function derniernombre_serie($typerole)
	{
		$req=$this->db->prepare('SELECT pseudo FROM user where substring(pseudo,1,4)=:pseudo ORDER BY Id DESC LIMIT 1');
		$req->execute(array(
			'pseudo' => $typerole
		));
		$row=$req->fetch();
		$nombre_serie = $row['pseudo'];
		return $nombre_serie;
	}
}

?>
<?php
	require_once 'objet.php';
	
	$role=new Roleuser($bd);
	
	////////////     CREATE A USER ///////////////////////////////
	if(isset($_POST['save']))
	{
		
		/*$i = 1;
		while($i <=30)
		{*/
			if(isset($_POST['profil']))
				$role->setidrole($_POST['profil']);
			
			if(isset($_POST['nom']))
				$role->setnom($_POST['nom']);
			
			if(isset($_POST['prenom']))
				$role->setprenom($_POST['prenom']);
			
			if(isset($_POST['serialnumb']))
			{
				$serialnumb=trim($_POST['serialnumb']);
				$role->setserialnumber($serialnumb);
			}
			
			if(isset($_POST['pass']))
			{
				$role->setmotdepasse($_POST['pass']);
			}
		
			if(isset($_POST['confirm']))
				$role->setconfirmotdepasse($_POST['confirm']);
			
			
			$typerole = substr($serialnumb,0, 4);
			$role->setchiffres($typerole);
			$role->setlettres($typerole);
			$role->createuser();
	}

	///////////////////////////////  EDIT USER ////////////////////////////////////////////

	if(isset($_POST['Edituser']))
	{
		if(isset($_POST['nom']))
			$role->setnom($_POST['nom']);
		
		if(isset($_POST['prenom']))
			$role->setprenom($_POST['prenom']);
		
		if(isset($_POST['changepassword']))
			$role->setEditpassword($_POST['changepassword']);
		
		if(isset($_POST['Iduser']))
			$role->Edituser($_POST['Iduser']);
	}
?>
