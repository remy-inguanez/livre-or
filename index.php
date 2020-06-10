
<!DOCTYPE html>
<html>

<head>
<title>Accueil</title>
<link href="livreor.css" rel="stylesheet">
<meta charset= "utf-8">
<link rel="icon" href="one-piece-anime-monkey-d-luffy-monkey-wallpaper.jpg"/>
</head>

<body class="accueil">

<h1> Bienvenue sur la page! </h1>

<header>
    <ul> 
	
<?php
session_start();
if(!empty($_POST['deco']))
{
	unset($_SESSION['login']);
	unset($_SESSION['password']);
	unset($_SESSION['profil']);
}


if((isset($_SESSION['login']))&&(isset($_SESSION['password'])))
{
?>

<li><a href="profil.php">Modifier Profil </a></li>
<li><a href="commentaire.php">Commentaires</a></li>
<li><a href="livre-or.php">Livre d'Or</a></li>

<?php

}       
?>			
		
<?php
if((isset($_SESSION['login']))&&(isset($_SESSION['password'])))
{
?>

<div class="bouton">
<form class="déconnexion" method="post" action="index.php">
<input type="submit" name="deco" value="Déconnexion">
</form>
</div>
<?php
}

else
{
?>

	<li><a href="connexion.php">Se connecter</a></li>	
    <li><a href="inscription.php">S'inscrire</a></li>
    <li><a href="profil.php">Modifier Profil </a></li>
	<li><a href="commentaire.php">Commentaires</a></li>
	<li><a href="livre-or.php">Livre d'Or</a></li>
	
	</ul>
<?php	
}	

?>

</header>

<?php
if(isset($_SESSION['delete']))
{	
?>

<div class="commentairedelete">
<?php
	echo "Commentaire bien supprimé !";	
?>

</div>
<?php
	unset($_SESSION['delete']);	
	header('Refresh: 2;URL=index.php');	
}
?>

</div>

<footer>

<p class="page">
Livre d'or &emsp;
Remy.I ©  &emsp;  2020  &emsp; Tous droits réservés.  
</p>

</footer>

</body>

</html>
