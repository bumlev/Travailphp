<?php
  include 'objet.php';


  $criteres='';
  
if(isset($_POST['depart']) And !empty($_POST['depart']))
	$criteres.=" AND departement.iddepart LIKE '".$_POST['depart']."'";


if(isset($_POST['nationality']) And !empty($_POST['nationality']))
	$criteres.=" AND membre.nationality = '".$_POST['nationality']."'";

if(isset($_POST['sex']) And !empty($_POST['sex']))
	$criteres.=" AND membre.sex = '".$_POST['sex']."'";

if(isset($_POST['studylevel']) And !empty($_POST['studylevel']))
	$criteres.=" AND membre.studylevel LIKE '".$_POST['studylevel']."'";

if(isset($_POST['cellule']) And !empty($_POST['cellule']))
	$criteres.=" AND membre.cellule = '".$_POST['cellule']."'";








/*if(isset($_POST['idnumb']) And !empty($_POST['idnumb']) )
   $criteres.=" AND idnumb LIKE '".$_POST['idnumb']."'";

if(isset($_POST['name'])And !empty($_POST['name']))
   $criteres.=" AND name LIKE '".$_POST['name']."'";


if(isset($_POST['Se']) And !empty($_POST['Se']) )
   $criteres.=" AND Se LIKE '".$_POST['Se']."'";


if(isset($_POST['user']) And !empty($_POST['user']))
  $criteres.=" AND Iduser LIKE '".$_POST['user']."'";

if(isset($_POST['Nyina']) And !empty($_POST['Nyina']))
   $criteres.=" AND Nyina LIKE '".$_POST['Nyina']."'";



if(isset($_POST['fonction']) And !empty($_POST['fonction']))
	$criteres.=" AND fonction LIKE '".$_POST['fonction']."'";

if(isset($_POST['faculty']) And !empty($_POST['faculty']))
   $criteres.=" AND faculty LIKE '".$_POST['faculty']."'";


if(isset($_POST['talent']) And !empty($_POST['talent']))
   $criteres.=" AND talent LIKE '".$_POST['talent']."'";

if(isset($_POST['intara']) And !empty($_POST['intara']))
   $criteres.=" AND intara LIKE '".$_POST['intara']."'";

if(isset($_POST['akarere']) And !empty($_POST['akarere']))
   $criteres.=" AND akarere LIKE '".$_POST['akarere']."'";

if(isset($_POST['umurenge']) And  !empty($_POST['umurenge']))
   $criteres.=" AND umurenge LIKE '".$_POST['umurenge']."'";

if(isset($_POST['akagari']) And !empty($_POST['akagari']))
   $criteres.=" AND akagari LIKE '".$_POST['akagari']."'";

if(isset($_POST['member']) And !empty($_POST['member']))
   $criteres.=" AND member LIKE '".$_POST['member']."'";*/


       ?>
       