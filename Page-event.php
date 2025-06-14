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

  </header>

  <p id="Debutrubrique"></p> 
  <h2>Evenements</h2> 
  <h3>Vous souhaitez participer a un de nos evenements ?</h3>
      Découvrez ci-dessous une présentation de nos deux types d'événements phares, pensés pour explorer l’amour sous toutes ses facettes. Juste après, retrouvez la liste complète des prochains rendez-vous.
Cliquez simplement sur “Voir la fiche” de l’événement qui vous intéresse pour en savoir plus et vous inscrire.
Ne manquez pas nos prochaines rencontres !

  <p><h4>- HeartTalks</h4>
    Format : une fois par mois, en ligne (Zoom ou YouTube Live). <br>
Invitée régulière : une psychologue spécialisée en relations amoureuses. <br>
Thèmes : <br>
"Pourquoi l'amour fait si mal ?" <br>
"Apprendre à aimer sans se perdre" <br>
"Guérir après une rupture" <br>
"Comment sortir des schémas toxiques ?" <br>
Q&R en fin de session pour encourager les échanges. <br>
Possibilité de poser les questions anonymement à l'avance.

  <h4>- Behind the Series</h4>
    Des soirées interactives autour de notre web-série, mêlant projections exclusives et débats participatifs.<br>
    Projections d’un épisode en avant-première suivies d’un débat.<br>
Débats/discussions sur les choix des personnages, ce qu’ils nous apprennent.<br>
“Que feriez-vous à leur place ?” → activité interactive.
</p>

    <section class="Partie1">

        <?php

require_once './lib/commonbis.php';
$mysqli = initDatabasemysqli();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$sql = "SELECT EVENEMENT.id_evenement, EVENEMENT.theme, EVENEMENT.date, EVENEMENT.type, EVENEMENT.intervenant, EVENEMENT.description
        FROM EVENEMENT 
        LIMIT ? OFFSET ?";

$stmt = mysqli_prepare($mysqli, $sql);
if (!$stmt) {
    die("Erreur lors de la préparation : " . mysqli_error($mysqli));
}

mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
if (!$result) {
    die("Erreur lors de l'exécution : " . mysqli_error($mysqli));
}

echo "<table border='1'><tr><th>Theme</th><th>Date</th><th>Type</th><th>Intervenant</th><th>Description</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>" . $row['theme'] . "</td>
            <td>" . $row['date'] . "</td>
            <td>" . $row['type'] . "</td>
            <td>" . $row['intervenant'] . "</td>
            <td>" . $row['description'] . "</td>
            <td><a href='Page-eventbis.php?id_evenement=" . $row['id_evenement'] . "'>Voir</a></td>
          </tr>";
}
echo "</table>";

for ($i = 1; $i <= 5; $i++) {
    echo "<a href='Page-event.php?page=$i'>$i</a> ";
}

mysqli_stmt_close($stmt);
mysqli_close($mysqli);
?>


    </section>


  <footer>
        Explorer l'amour pour mieux se retrouver 
  </footer>
</body>

</html>