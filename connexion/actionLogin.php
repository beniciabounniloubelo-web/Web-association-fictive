<?php

$conn = mysqli_connect("dwarves.iut-fbleau.fr", "bounnilo","YOYOYO","bounnilo");

if(!$conn) {
	die("Erreur de connexion :" . mysqli_connect_error());
}


$login = $_POST['login'];
$mdp = $_POST['mdp'];


$sql = "SELECT mdp , role FROM UTILISATEUR WHERE login =?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $login);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$mdp_hash, $role );


if (mysqli_stmt_fetch($stmt)) {
	if(password_verify($mdp, $mdp_hash)){
		$_SESSION['login'] = $login;
		$_SESSION['role'] = $role;
		header('location:./Page-acc.php');
	}else{
	   echo "<script>alert('Échec de l\\'authentification : mot de passe incorrect.'); window.location.href ='./login.html'; </script>";
	} 
 } else {
	 echo "<script>alert('Échec de l\\'authentification : identifiant incorrect.'); window.location.href ='./login.html'; </script>";
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);
?>