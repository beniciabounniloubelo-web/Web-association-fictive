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
 
  <p id="Debutrubrique"></p> <!-- comme ca on peut revenir au titre de la page sans que ca soit cacher par la barre de rubriques-->

    <section class="Partie1">

  <?php
require_once 'lib/common.php';
session_start();


$db = initDatabase();
if (!$db) {
    die("Erreur de connexion à la base de données.");
}

$id_commentaire = isset($_POST['id_commentaire']) ? (int)$_POST['id_commentaire'] : (int)$_GET['id_commentaire'];

if (empty($id_commentaire)) {
    header('Location: Page-event.php');
    exit();
}

if (!empty($_POST['content']) && !empty($_POST['csrf_token'])) {
    
    $content = strip_tags($_POST['content']);
    $id_user = $_SESSION['user'];
    $date = date('Y-m-d H:i:s');

    $stmt = $db->prepare("INSERT INTO COMMENTAIRE (id_utilisateur, contenu) VALUES (?,?)");
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $db->error);
    }

    $stmt->bind_param("iss", $id_user, $content);

    if ($stmt->execute()) {
        header('Location: Page-eventbis.php?id_evenement=' . $id_commentaire);
        exit();
    } else {
        die("Erreur SQL : " . $stmt->error);
    }
}
?>


<h1>Ajouter un commentaire</h1>
    <form action="" method="post">
    <fieldset>
        <input type="hidden" name="id_commentaire" value="<?= htmlspecialchars($id_commentaire) ?>">
        <label for="content">Contenu</label>
        <textarea id="content" name="content" required></textarea><br>
        <input type="submit" value="Envoyer">
    </fieldset>
</form>

</form>
    </section>


  <footer>
        Explorer l'amour pour mieux se retrouver 
  </footer>
</body>

</html>