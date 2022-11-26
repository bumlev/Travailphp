<!DOCTYPE html>
<html>
<head>
<title>Codes d'accès au serveur central de la NASA</title>
<meta charset="utf-8" />
</head>
<body>
	<?php
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
echo '<p>Mot de passe incorrect</p>';
}
?>
</body>
</html>