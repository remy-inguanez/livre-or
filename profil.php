
<?php
session_start();
if(isset($_SESSION['login']))
{
?>
<html>

<head>
<link href="livreor.css" rel="stylesheet">
<title>Profil</title>
<link rel="icon" href="one-piece-anime-monkey-d-luffy-monkey-wallpaper.jpg"/>
</head>

<body class="profil">
<header>	
	<ul>
		<li> <a href="index.php">Accueil</a> </li>
	</ul>
</header>


<article class="form">
	<form class="connexionform2" method="post" action="profil.php"> 

<?php


	$login=$_SESSION['login'];
	$password=$_SESSION['password'];
	$connexion= mysqli_connect("localhost", "root", "", "livreor"); 	
	$query="SELECT *from utilisateurs WHERE login='$login'";
	$result= mysqli_query($connexion, $query);
	$row = mysqli_fetch_array($result);
?>

<?php


if(!empty($_POST['modifier']))
{
$loginexistant=false;
$modif=false;
$connexion= mysqli_connect("localhost", "root", "", "livreor"); 
$login=$_POST['login'];
$checkdups="SELECT  *from utilisateurs WHERE login='$login'";
$checkdups2=mysqli_query($connexion, $checkdups) or die(mysqli_error($connexion));
$checkdups3=mysqli_num_rows($checkdups2);

	
if (($_POST['login'] !=  $row['login'])&&($checkdups3 == 0)&&(strlen($_POST['password']) > 5))
{
	$query="UPDATE `utilisateurs` SET `login` = '".$_POST['login']."' WHERE `utilisateurs`.`login`='".$row['login']."'";
	$result= mysqli_query($connexion, $query);
	$_SESSION['login']=$_POST['login'];
	$modif=true;
	mysqli_close($connexion);	
}
else if (($checkdups3 > 0)&&($_POST['login'] !=  $row['login']))
{ 	
	$loginexistant=true;
	$modif=false;
	?>

	<div class="affichage">
	<?php
	echo "Login déjà existant !";
	?>

	</div>
	<?php
}
else if (strlen($_POST['password']) < 5)
{
	$modif=false;
	?>
    
	<div class="affichage">
	<?php
	echo "Mot de passe trop court !";
	?>
	</div>
	<?php	
	
}


if (($_POST['password'] !=  $password)&&($loginexistant==false)&&(strlen($_POST['password']) > 5))
{
	$hash = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]);	
	$connexion= mysqli_connect("localhost", "root", "", "livreor"); 	
	$query="UPDATE `utilisateurs` SET `password` = '".$hash."' WHERE `utilisateurs`.`password`='".$row['password']."'";
	$result= mysqli_query($connexion, $query);
    $_SESSION['password']=$_POST['password'];
	$modif=true;
	mysqli_close($connexion);
}

if(($loginexistant==false)&&($modif==true))
{
	$_SESSION['profil']="Profil modifié avec succès !";
	header ('location: connexion.php');
}
else if ($modif==false)
{
	?>
	<div class="affichage">
	<?php
	echo "Aucune modification n'a été faite";
	?>
	</div>
	<?php
}
}


?>


		<input type="text" required placeholder="Login" name="login" value="<?php echo $row['login'] ?>"> 
		<input type="text"  placeholder="Nouveau mot de passe (5 caractères minimum)"  name="password" value="<?php echo $password ?>">
		<input type="submit" value="Modifier" name="modifier">
	</form>
</article>



<?php




?>

<footer>

<p class="page">
Livre d'or &emsp;
Remy.I ©  &emsp;  2020  &emsp; Tous droits réservés.  
</p>

</footer>

</body>

</html>

<?php
}
else
{
header ('location: 404.html');	
}	
?>
