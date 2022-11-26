<?php 
     
     require_once 'objet.php';
     $district='';
if(isset($_POST['akarere']))
{

	$id_prov=$_POST['akarere'];    

	//$id_prov=1;
	$req=$bd->prepare('SELECT * FROM district WHERE id_province=:prov'); 
	$req->execute(array(
		'prov'=>$id_prov
	));

	
	if($_POST['akarere']!=6)
	{

		$district.="<select name='umurenge' id='umurenge'><option value=''>Select district...</option>"; 
		while($reponse=$req->fetch())
		{
			
			// $id_departement=$reponse['id_departement'];
				$district.="<option value=".$reponse['id_district'].">".htmlentities($reponse['nomdistrict'])."</option>";
		}
		
		$district.="</select>";
	}
	
	//return $district;
	echo $district;
	$req->closeCursor();

}
else{ 

	if(isset($_POST['umurenge']))
	{
		$id_dist=$_POST['umurenge'];
		
		// echo $id_dist;
		
		$req=$bd->prepare('SELECT * FROM sectors WHERE id_district=:distri ORDER BY id_sector');
		$req->execute(array(
		'distri'=>$id_dist
		));

		$secteur.="<select id='akagari' name='akagari'><option value=''>Select sector...</option>";
			while($reponse=$req->fetch())
			{
				// $id_sport=$reponse['id_sport'];
				$secteur.="<option value=".$reponse['id_sector'].">".htmlentities($reponse['nomsector'])."</option>";
			}
		$secteur.="</select>";
		echo $secteur;
		//return $secteur;
		$req->closeCursor();
	}
}




/////////////////////////////    PARTIE DES RECHERCHE DES MEMBRES ///////////////////////////////////////////////////