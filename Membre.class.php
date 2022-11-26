	<?php
	
	 /**
	 *
	 */
	 class  Membre
	   {
	    private $id;
	    private $first_name;
	    private $last_name;
	    private $serial_number;
	    private $chiffre;
	    private $lettre;
	    private $sex;
	    private $nationality;
	    private $se_firstname;
	    private $se_lastname;
	    private $nyina_firstname;
	    private $nyina_lastname;
	    private $datebirth;
	    private $datebornagain;
	
	
	    private $datebaptiz;
	    private $fonction;
	    private $member;
	    private $cellule;
	    private $departement;
	    private $studylevel;
	    private $faculty;
	    private $talent;
	    private $tel;
	
	
        private $email;
	    private $intara;
	    private $akarere;
	    private $umurenge;
	    private $akagari;
	    private $umurimo;
	    private $nbrenull;
	    private $img;
	
	    public function __construct()
	 {
	      $this->nbrenull=0;
	 }
	 // les getters
	    public function id(){return $this->id; }
	    public function first_name(){return $this->first_name; }
	    public function last_name(){return $this->last_name; }
		public function serial_number(){return $this->serial_number;}
	    public function sex(){return $this->sex; }
	    public function nationality(){return $this->nationality; }
	    public function se_firstname(){return $this->se_firstname; }
	    public function se_lastname(){return $this->se_lastname; }
        public function nyina_firstname(){return $this->nyina_firstname; }
        public function nyina_lastname(){return $this->nyina_lastname; }
	    public function datebirth(){return $this->datebirth; }
	    public function datebornagain(){return $this->datebornagain; }
	    public function datebaptiz(){return $this->datebaptiz; }
	    public function fonction(){return $this->fonction; }
	    public function member(){return $this->member; }
	    public function cellule(){return $this->cellule; }
	    public function departement(){return $this->departement;}
	    public function studylevel(){return $this->studylevel; }
	    public function faculty(){return $this->faculty; }
	    public function talent(){return $this->talent; }
	    public function tel(){return $this->tel; }
	    public function email(){return $this->email; }
	    public function intara(){return $this->intara; }
	    public function akarere(){return $this->akarere; }
	    public function umurenge(){return $this->umurenge; }
	    public function akagari(){return $this->akagari; }
	    public function umurimo(){return $this->umurimo; }
	    public function nbrenull(){return $this->nbrenull; }
	    public function img(){return $this->img;}
	
	  /////////////les setters///////////////////////////////
	
	    public function setId($id, Membremanager $mbn)
	   {
	        //$id=(int)$id;
	        if ($mbn->searchid($id)==0)
	                $this->id=$id;
	          else
	          {
	            if ($this->nbrenull==0)
	            {
	              $this->nbrenull++;
	              echo('<script>alert("failure of registration:the idnumber already exits");history.back();</script>');
	            }
	          }
	   }
		 
		 
		 
        public function setIdmodif($id, Membremanager $mbn,$idnumb)
	   {
	        //$idnumb=(int)$idnumb;
	        if ( $mbn->rechercheID($id)==$idnumb Or $idnumb==0 Or $mbn->searchid($idnumb)==0)
	              $this->id=$idnumb;
	        else
	          {
	            if ($this->nbrenull==0)
	            {
	              $this->nbrenull++;
	              echo('<script> alert("failure of registration:the idnumber already exits.But you can keep your idnumber");history.back();</script>');
	            }
	          }
	   }
	    public function setfirst_name($first_name)
	   {
	      if (!empty($first_name))
	           $this->first_name=$first_name;
	        else
	        {
	           if ($this->nbrenull==0)
	            {
	             $this->nbrenull++;
	             echo('<script> alert("failure of registration:fill your name ");history.back();</script>');
	           }
	          
	        }
	   }
		  public function setlast_name($last_name)
		  {
			  if (!empty($last_name))
				  $this->last_name=$last_name;
			  else
			  {
				  if ($this->nbrenull==0)
				  {
					  $this->nbrenull++;
					  echo('<script> alert("failure of registration:fill your name ");history.back();</script>');
				  }
				
			  }
		  }
	    public function setSex($sex)
	   {
	      if (!empty($sex))
	         $this->sex=$sex;
	      else
	      {
	         if ($this->nbrenull==0)
	         {
	           $this->nbrenull++;
	           echo('<script> alert("failure of registration:fill your gender");history.back();</script>');
	         }
	      }
	   }
	    public function setNationality($nationality)
	   {
	      if(!empty($nationality))
	           $this->nationality=$nationality;
	      else
	      {
	         if ($this->nbrenull==0)
	         {
	           $this->nbrenull++;
	           echo('<script> alert("failure of registration:fill your Civil Status");history.back();</script>');
	         }
	      }
	   }
	    public function setse_firstname($se_firstname){$this->se_firstname=$se_firstname; }
	    public function setse_lastname($se_lastname){$this->se_lastname=$se_lastname; }
	    public function setnyina_firstname($nyina_firstname){$this->nyina_firstname=$nyina_firstname; }
	    public function setnyina_lastname($nyina_lastname){$this->nyina_lastname=$nyina_lastname; }
	    public function setDatebirth($datebirth){$this->datebirth=$datebirth; }
	
	    public function setDatebornagain($datebornagain)
	   {
	               $date1=new DateTime($this->datebirth);
	               $date2=new DateTime($datebornagain);
	                 if( $date1 < $date2 )
	                  $this->datebornagain=$datebornagain;
	                 else
	                     if ($this->nbrenull==0)
	                      {
	                      echo('<script> alert("amatariki yawe ntabwo ariyo: igihe yakirijwe ,igihe yabatirijwe");history.back();</script>');
	                      $this->nbrenull++;
	                      }
	                     if (empty($this->datebornagain) and $this->nbrenull==0)
	                     {
	                      //echo('<script> alert("itariki wakirijweko ntabwo yujujwe");</script>');
	                      $this->datebornagain = 0000;
	                     }
	   }
	
	
	
	
	    public function setDatebaptiz($datebaptiz){$this->datebaptiz=$datebaptiz; }
	    public function setFonction($fonction){$this->fonction=$fonction; }
	    public function setMember($member){$this->member=$member; }
	    public function setcellule($cellule){$this->cellule=$cellule;}
	    public function setdepartement($departement){$this->departement=$departement;}
	    public function setStudylevel($studylevel){$this->studylevel=$studylevel; }
	    public function setFaculty($faculty){$this->faculty=$faculty; }
	    public function setTalent($talent){$this->talent=$talent; }
	
	    public function setTel($tel){$this->tel=$tel; }
	    public function setEmail($email){$this->email=$email; }
	
	    public function setIntara($intara)
	   {
	        include 'objet.php';
	       if(!empty($intara))
	       {
	         
	         $requet=$bd->prepare('SELECT * from province where id_province=:id LIMIT 1');
	         $requet->execute(array(
	          'id'=>$intara
	         ));
	
	         $donnees=$requet->fetch();
	         if(!empty($donnees['nomprovince']))
                $this->intara=$donnees['nomprovince'];
	           else
                $this->intara=$intara;
		       
	       }
	         else
	         {
	            if ($this->nbrenull==0)
	            {
	              $this->nbrenull++;
	              echo('<script> alert("failure of registration:fill your province");history.back();</script>');
	            }
	            
	         }
	   }
	    public function setAkarere($akarere)
	   {
	       include'objet.php';
	       if(!empty($akarere))
	       {
	        $requet=$bd->prepare('SELECT * from district where id_district=:id LIMIT 1');
	         $requet->execute(array(
	          'id'=>$akarere
	         ));
	
	         $donnees=$requet->fetch();
	         if(!empty($donnees['nomdistrict']))
	          $this->akarere=$donnees['nomdistrict'];
	           else
	             $this->akarere=$akarere;
	       }
	      else
	      {
	         if ($this->nbrenull==0)
	         {
	          $this->nbrenull++;
	          echo('<script> alert("failure of registration:fill your district");history.back();</script>');
	         }
	         
	      }
	   }
        public function setUmurenge($umurenge)
	   {
	       include 'objet.php';
	       if(!empty($umurenge))
	       {
	        $requet=$bd->prepare('SELECT * from sectors where id_sector=:id LIMIT 1');
	         $requet->execute(array(
	          'id'=>$umurenge
	         ));
	
	         $donnees=$requet->fetch();
	         if(!empty($donnees['nomsector']))
	            $this->umurenge=$donnees['nomsector'];
	             else
	              $this->umurenge=$umurenge;
	       }
	       /*else
	       {
	          if ($this->nbrenull==0)
	          {
	            $this->nbrenull++;
	            echo('<script> alert("failure of registration:fill your sector");</script>');
	          }
	          
	       }*/
	   }
        public function setAkagari($akagari)
	   {
	
	       include'objet.php';
	       if(!empty($akagari))
	       {
	          $requet=$bd->prepare('SELECT * from cellule where id_cellule=:id LIMIT 1');
	         $requet->execute(array(
	          'id'=>$akagari
	         ));
	
	         $donnees=$requet->fetch();
	          if(!empty($donnees['nomcellule']))
	            $this->akagari=$donnees['nomcellule'];
	             else
	                $this->akagari=$akagari;
	       }
	      /* else
	       {
	          if ($this->nbrenull==0)
	          {
	            $this->nbrenull++;
	            echo('<script> alert("failure of registration:fill your cell");</script>');
	          }
	          
	       }*/
	   }
	    public function setUmurimo($umurimo){$this->umurimo=$umurimo; }
	
	    public function setimg($img)
	   {
	     if(!empty($img))
	     {
	       $this->img=$img;
	     }
	       else
	       {
	          if ( $this->nbrenull==0)
	            {
	              $this->nbrenull++;
	              echo('<script> alert("upload your image please!");history.back();</script>');
	            }
	
	       }
	  }
        public function setimgmodif($img)
        {
            if (!empty($img))
                $this->img=$img;
  
        }
		 
	}
	
	
	