
<?php

session_start();
if(!empty($_POST['deco']))
{
	unset($_SESSION['login']);
	unset($_SESSION['password']);
	unset($_SESSION['profil']);
}
	$connexion= mysqli_connect("localhost", "root", "", "livreor"); 
	$query="SELECT login, date, id_utilisateur, commentaire FROM `utilisateurs` ,`commentaires` WHERE utilisateurs.id = id_utilisateur  ORDER BY `commentaires`.`id` ASC";
	$result= mysqli_query($connexion, $query);
	
	//Pour sélectioner l'id et pouvoir supprimer le com en fonction de l'id
	$query1="SELECT id, commentaire FROM `commentaires`";
	$result1= mysqli_query($connexion, $query1);
		
?>

<!DOCTYPE html>
<html>

<head>
<link href="livreor.css" rel="stylesheet">
<title>Livreor</title>
<link rel="icon" href="one-piece-anime-monkey-d-luffy-monkey-wallpaper.jpg"/>
</head>

<body class="livredor">

<?php

if((isset($_SESSION['login']))&&(isset($_SESSION['password'])))
{
?>

<header>	
	<ul class="ul2">
		<li><a href="index.php">Accueil</a></li>

<div class="boutondeco">
<form class="déconnexion" method="post" action="livre-or.php">
<input type="submit" name="deco" value="Déconnexion">
</form>
</div>
</ul>
<?php

}
else
{
?>

<ul class="ul2">	
<li><a href="index.php">Accueil</a></li>
<li><a href="connexion.php">Se connecter</a></li>
</ul>	
<?php	
}
if(!empty($_POST['deco']))
{
unset($_SESSION['login']);
unset($_SESSION['password']);
}
?>

</header>

<article class="espacecommentaire">
<table>
<tr>
<td> <center> <strong>Utilisateur(s)</strong> </center> </td>
<td> <center ><strong>Commentaires</strong> </center> </td>
</tr>
	
<?php

while(($row = mysqli_fetch_array($result))&& ($row1 = mysqli_fetch_array($result1))){

?>
	<tr>
		<td><?php echo "Posté par : ";echo "<strong>".$row['login']."</strong>"; echo " le "; echo $row['date'];?></td>
		<td><?php echo $row['commentaire'];?></td>
		
		<?php
		
		if(isset($_SESSION['login']))
		{
		if(($_SESSION['login'] == $row['login'])||($_SESSION['login']=="admin"))
		{
		?>

		<td>
		<form method="post">
		<input type="submit" name="effacer" value="Supprimer    ">
		<input type="hidden" name="moi" value="<?php echo $row1['id'] ?>">  
		</form>
		<?php
		}
		if(isset($_POST['effacer']))
		{
			$commentaire= $_POST['moi'];
			$connexion= mysqli_connect("localhost", "root", "", "livreor"); 
			$query2="DELETE FROM `commentaires` WHERE commentaires . id = '$commentaire'";
			$result2= mysqli_query($connexion, $query2);
			$_SESSION['delete']=true;
			header ('location: index.php');			
			
		}
		}
		?>

		</td>
	</tr>
		<?php
}

mysqli_close($connexion);
?>

</table>
</article>
<?php
if((isset($_SESSION['login']))&&(isset($_SESSION['password'])))
{
?>

<div class="button">
<a href="commentaire.php"><input class="favorite styled" type="button" value="Ajouter un commentaire"></a>
</div>
<?php

}

?>

<footer>

<p class="page">
Livre d'or &emsp;
Remy.I ©  &emsp;  2020  &emsp; Tous droits réservés.  
</p>

</footer>

</body>

</html>
