<?php

function initDatabasemysqli() {
  $mysqli = mysqli_connect("dwarves.iut-fbleau.fr", "bounnilo","YOYOYO","bounnilo");

if (!$mysqli) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
return $mysqli;
}

