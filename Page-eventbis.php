<!DOCTYPE html>

<html>
  <html lang="fr">

<head>
    <link rel="stylesheet" href="notrestyle.css">
    <title>5ThingsIHateAboutLove</title>

    <style>
        section {
            height: 70vh; /* pleine hauteur d'écran */
            padding: 10px;
        }
    </style>
    
</head>

<body>
  <header style="gap: 40px;" >
   <div class="centragedansleheader">

    <!-- bouton vers l'accueil-->
    <a href="./Page-acc.html"> 
      <img class="imageenbloc1" src="./home.jpg" alt="image not found" style="width:60px; height:60px; cursor: pointer; border-radius: 40px;">
    </a>
    
    <!-- logo-->
    <img class="imageenbloc2" src="./LOGO.jpg" alt="image not found" width="400">
    
    <!-- bouton connexion-->
    <a href="./connexion/login.html" style="margin-left: auto;"> 
      <img class="loginbutton" src="./usericon.jpg" alt="image not found"  style="width:60px; height:60px; cursor: pointer; border-radius: 30px;">
    </a>

   </div>

  </header>

  <div class="menu">  <!-- pour acceder aux autres rubriques-->
    <ul>
        <li class="personnage"><a> Personnages </a>
            <ul class="perso">
              <li> <a href="./Page-coco.html">Coco</a></li>
              <li> <a href="./Page-moon.html">Moon</a></li>
              <li> <a href="./Page-dove.html">Dove</a></li>
              <li> <a href="./Page-rachel.html">Rachel</a></li>
              <li> <a href="./Page-jinsley.html">Jinsley</a></li>
            </ul>
        </li>
        
        <li><a href="./Page-event.php"> Evenements </a></li>
        <li><a href="./Page-ress.html"> Ressources psychologiques </a></li>
        <li><a href="./Page-lettre.html"> Lettre a soi </a></li>
    </ul>
  </div>
 
  <p id="Debutrubrique"></p> 
  <h2>Evenements</h2> 
  <h3>Vous souhaitez participer a un de nos evenements ?</h3>

    <section class="Partie1">

        <?php
require_once './lib/commonbis.php';
$mysqli = initDatabasemysqli();
$id = isset($_GET['id_evenement']) ? (int) $_GET['id_evenement'] : 1;

$sql = "SELECT EVENEMENT.id_evenement, EVENEMENT.theme, EVENEMENT.date, EVENEMENT.type, EVENEMENT.intervenant, EVENEMENT.description
        FROM EVENEMENT 
        WHERE id_evenement=?";
$stmt = mysqli_prepare($mysqli, $sql);
if (!$stmt) {
    die("Erreur lors de la préparation : " . mysqli_error($mysqli));
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
if (!$result) {
    die("Erreur lors de l'exécution : " . mysqli_error($mysqli));
}

if ($row = mysqli_fetch_assoc($result)) {
    echo "<h1>" . $row['theme'] . "</h1>";
    echo "<p>Date: " . $row['date'] . "</p>";
    echo "<p>Type: " . $row['type'] . "</p>";
    echo "<p>Intervenant: " . $row['intervenant'] . "</p>";
    echo "<p>Description: " . $row['description'] . "</p>";
} else {
    echo "Film introuvable.";
}

mysqli_stmt_close($stmt);
mysqli_close($mysqli);
?>

    <form method="GET">
        <button type="submit">S'inscrire</button>
    </form>

     <?php
require_once './lib/common.php';
session_start();

$db = initDatabase();
$id = isset($_GET['id_evenement']) ? (int)$_GET['id_evenement'] : 0;
$id_commentaire = $id;

$req = mysqli_query($db, "SELECT * FROM COMMENTAIRE WHERE id=" . $id_commentaire);
$commentaire = mysqli_fetch_assoc($req);

$req = mysqli_query($db, "SELECT COMMENTAIRE.*, UTILISATEUR.id_utilisateur 
                          FROM COMMENTAIRE 
                          JOIN UTILISATEUR ON COMMENTAIRE.id_utilisateur = UTILISATEUR.id_utilisateur
                          WHERE COMMENTAIRE.id = " . $id_commentaire);
$comments = mysqli_fetch_all($req, MYSQLI_ASSOC);
?>

<p>Partagez ce que vous en pensez</p>

<h3>Commentaires</h3>

<?php if (empty($comments)): ?>
    <p>Aucun commentaire.</p>
<?php endif; ?>
<?php if (isset($_SESSION['user'])): ?>
    <form action="Page-event-com.php" method="GET">
        <input type="hidden" name="id_commentaire" value="<?= $id ?>">
        <button type="submit">Laisser un commentaire</button>
    </form>
<?php else: ?>
    <form action="login.html" method="GET">
        <button style='width: 400px; height: 200px' type="submit">Connecte-toi pour commenter</button>
    </form>
<?php endif; ?>

    <br>
    <br>
    <br>
    </section>


  <footer>
        Explorer l'amour pour mieux se retrouver 
  </footer>
</body>

</html>