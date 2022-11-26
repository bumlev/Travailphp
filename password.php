<!DOCTYPE html >
<html >
<head>
<title>Page protégée par mot de passe</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
</head>
<body>

<p>Veuillez entrer le mot de passe pour obtenir les codes d'accès
au serveur central de la NASA :</p>
<form action="secret.php" method="post">
<p>
<input type="password" name="mot_de_passe"/>
<input type="submit" value="Valider" name="formular"  />
</p>
</form>
<p>Cette page est réservée au personnel de la NASA. Si vous ne
travaillez pas à la NASA, inutile d'insister vous ne trouverez
jamais le mot de passe ! ;-)</p>



<?php
/*
if (isset($_POST['mot_de_passe']) AND $_POST['mot_de_passe'] =="kangourou") // Si le mot de passe est bon
{
// On affiche les codes
?>
<h1>Voici les codes d'accès :</h1>
<p><strong>CRD5-GTFT-CK65-JOPM-V29N-24G1-HH28-LLFV</strong></p>
<p>
Partie 2 : Transmettre des données de page en page 132/361
www.siteduzero.com
Cette page est réservée au personnel de la NASA. N'oubliez pas de
la visiter régulièrement car les codes d'accès sont changés toutes
les semaines.<br />
La NASA vous remercie de votre visite.
</p>
<?php
}
else // Sinon, on affiche un message d'erreur
{
	if ($_POST['mot_de_passe'] !="kangourou" AND $_POST['mot_de_passe'] !="") 
	{
		echo '<p> Mot de passe incorrect </p>';
	}

}
*/
?>

<?php
/*
// 1 : on ouvre le fichier
$pages=0;
$monfichier = fopen('levy.txt', 'r+');
// 2 : on fera ici nos opérations sur le fichier...
// 3 : quand on a fini de l'utiliser, on ferme le fichier
$pages_vues = fgets($monfichier); // On lit la première ligne  (nombre de pages vues)

$pages++; // On augmente de 1 ce nombre de pages vues
fseek($monfichier, 0); // On remet le curseur au début du fichier
fputs($monfichier,'gisa'); // On écrit le nouveau nombre de pages vues

fclose($monfichier);
echo '<p> Cette page  '. $pages_vues . '   a été vue '. $pages. ' fois ! </p>';
*/
?>

</body>
</html>
