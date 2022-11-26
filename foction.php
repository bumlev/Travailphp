<?php


   function afficher($page,$perpage, $criteres,$department)
  {

  	 include 'objet.php';
	  
	$perpage=intval($perpage);
	$debut=intval($page-1)*$perpage;
	$results=array();
	 
		if(empty($department))
		{
			$requet=$bd->prepare('SELECT * FROM  membre
			INNER JOIN niveauetude ON membre.studylevel = niveauetude.idniveau
			INNER JOIN cellulepri ON membre.cellule = cellulepri.Idcell
			INNER JOIN etatcivil ON membre.nationality = etatcivil.Idetatcivil
			INNER JOIN genre ON membre.sex = genre.Idgenre
			INNER JOIN user ON membre.Iduser=user.Id
			WHERE true '.$criteres.' LIMIT '.$debut.','.$perpage);
		
		}
		elseif(!empty($department))
		{
			$requet=$bd->prepare('SELECT * FROM  membre
			INNER JOIN niveauetude ON membre.studylevel = niveauetude.idniveau
			INNER JOIN cellulepri ON membre.cellule = cellulepri.Idcell
			INNER JOIN etatcivil ON membre.nationality = etatcivil.Idetatcivil
			INNER JOIN genre ON membre.sex = genre.Idgenre
			INNER JOIN member_department ON ID = id_member
			INNER JOIN departement ON iddepart = id_department
			INNER JOIN user ON membre.Iduser=user.Id
			WHERE true '.$criteres.' LIMIT '.$debut.','.$perpage);
			
		}
	
  
  
	$requet->execute();
	
    while($donnees=$requet->fetch())
    {
       $results[] = $donnees;
    }
    return $results;
  }


  function nbrepays($criteres,$department)
  {
  	include 'objet.php';
  	
  	    if(empty($department))
        {
			$requet=$bd->prepare('SELECT count(*) as nb from membre
			INNER JOIN niveauetude ON membre.studylevel = niveauetude.idniveau
			INNER JOIN cellulepri ON membre.cellule = cellulepri.Idcell
			INNER JOIN etatcivil ON membre.nationality = etatcivil.Idetatcivil
			INNER JOIN genre ON membre.sex = genre.Idgenre
			INNER JOIN user ON membre.Iduser=user.Id
			WHERE true '.$criteres);
	       
        }
		elseif(!empty($department))
		{
			$requet=$bd->prepare('SELECT count(*) as nb from membre
			INNER JOIN niveauetude ON membre.studylevel = niveauetude.idniveau
			INNER JOIN cellulepri ON membre.cellule = cellulepri.Idcell
			INNER JOIN etatcivil ON membre.nationality = etatcivil.Idetatcivil
			INNER JOIN genre ON membre.sex = genre.Idgenre
			INNER JOIN member_department ON ID =id_member
			INNER JOIN departement ON id_department =iddepart
			INNER JOIN user ON membre.Iduser=user.Id
			WHERE true '.$criteres);
			
		}
  	
       $requet->execute();
       $result=$requet->fetch();
       $total=$result['nb'];
       return $total;
  }
?>