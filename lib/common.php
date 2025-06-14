<?php

function initDatabase() {
  $db = mysqli_connect("dwarves.iut-fbleau.fr", "bounnilo","YOYOYO","bounnilo");
  if(!$db){
  	echo "Erreur de connexion";
  }
	return $db;
}

