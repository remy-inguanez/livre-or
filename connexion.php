
<!DOCTYPE html>
<html>

<head>
<link href="livreor.css" rel="stylesheet">
<title>Connexion</title>
<link rel="icon" href="one-piece-anime-monkey-d-luffy-monkey-wallpaper.jpg"/>
</head>

<body class="connexion">
<header>	
	<ul>
		<li><a href="index.php">Accueil</a></li>
		<li><a href="inscription.php">S'inscrire</a></li>
	</ul>
</header>

<article class="form">

<form class="connexionform" method="post" action="connexion.php"> 

<?php

session_start ();
if(isset($_SESSION['profil']))
{
unset($_SESSION['login']);
unset($_SESSION['password']);
echo "<br>";	
echo $_SESSION['profil'];
}
unset($_SESSION['profil']);

if((isset($_POST['connexion']))&&(isset($_POST['login']))&&(isset($_POST['password'])))
{

	$connexion= mysqli_connect("localhost", "root", "", "livreor"); 
	$login=$_POST['login'];
	$query="SELECT *from utilisateurs WHERE login='$login'";
	$result= mysqli_query($connexion, $query);
	$row = mysqli_fetch_array($result);
	
	if(password_verify($_POST['password'],$row['password'])) 
	{
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['password'] = $_POST['password'];
	header ('location: index.php');
	}
	else
	{	
	?>

	<div class="affichage">
	<?php
	echo "*Login ou Mot de Passe Incorrect(s)";	
	?>

	</div>
		<form action="connexion.php" method="post">
		<input type="text" required placeholder="Login" name="login">
		<input type="password" required placeholder="Password"  name="password">
		<input type="submit" value="Connexion" name="connexion">
		<input type="reset" value="Effacer" name="reset">
	</form>

	<?php
	}
	mysqli_close($connexion);	
}
else
{	
?>

<form action="connexion.php" method="post">
		<input type="text" required placeholder="Login" name="login">
		<input type="password" required placeholder="Password"  name="password">
		<input type="submit" value="Connexion" name="connexion">
		<input type="reset" value="Effacer" name="reset">
	</form>

</article>	
<?php

}



?>

<p class="page">
Livre d'or &emsp;
Remy.I ©  &emsp;  2020  &emsp; Tous droits réservés.  
</p>

</body>

</html>
