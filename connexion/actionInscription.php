<?php
require_once 'lib/common.php'; 
session_start();


$conn = initDatabase();

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

$login = isset($_POST['login']) ? $_POST['login'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';


if (empty($login) || empty($email) || empty($mdp)) {
    echo "<script>alert('Tous les champs doivent être remplis.'); window.location.href ='./notif.php';</script>";
    exit();
}

$mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);


$sql_verif = "SELECT login FROM UTILISATEUR WHERE login = ?";
$stmt_verif = mysqli_prepare($conn, $sql_verif);
mysqli_stmt_bind_param($stmt_verif, "s", $login);
mysqli_stmt_execute($stmt_verif);
mysqli_stmt_store_result($stmt_verif);

if (mysqli_stmt_num_rows($stmt_verif) > 0) {
    echo "<script>alert('Ce login est déjà utilisé. Veuillez en choisir un autre.'); window.location.href ='./notif.php';</script>";
    mysqli_stmt_close($stmt_verif);
    mysqli_close($conn);
    exit();
}
mysqli_stmt_close($stmt_verif);


$sql = "INSERT INTO UTILISATEUR (login, email, mdp) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sss", $login, $email, $mdp_hash);

if (mysqli_stmt_execute($stmt)) {
    
    $_SESSION['login'] = $login;
    header('Location: actionLogin.php');
    exit();
} else {
    echo "Erreur lors de l'inscription : " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
