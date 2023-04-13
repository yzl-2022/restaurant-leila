<?php
/**
 * Manipulation des données des catégories du restaurant Leila
 */

/**
 * Cherche les catégories.
 * 
 * @return array : tableau de tableaux contenant les catégories
 */
function lireTout() {
  $bd = ouvrirConnexion();
  $sql = "SELECT * FROM plat ORDER BY id ";
  return lire($bd, $sql);
}

function lirePlatPrincipales() {
  $bd = ouvrirConnexion();
  $sql = "SELECT DISTINCT p.id_categorie, c.nom
          FROM plat p
          JOIN categorie c
          ON p.id_categorie = c.id; ";
  return lire($bd, $sql);
}

function ajouter($plat) {
  $bd = ouvrirConnexion();
  // Prévenir les injections SQL en assainissant les valeurs provenant 
  // de l'extérieur de mon code
  $nom = mysqli_real_escape_string($bd, $plat['nom']);
  $detail = mysqli_real_escape_string($bd, $plat['detail']);
  $portion = (int)$plat['portion'];
  $prix = (float)$plat['prix'];
  $id_categorie = (int)$plat['id_categorie'];

  $sql = "INSERT INTO plat VALUES (NULL, '$nom', '$detail', $portion, $prix, $id_categorie)";
  return creer($bd, $sql);
}

function changer($plat) {
  $bd = ouvrirConnexion();
  $id = (int)$plat['id'];
  $nom = mysqli_real_escape_string($bd, $plat['nom']);
  $detail = mysqli_real_escape_string($bd, $plat['detail']);
  $portion = (int)$plat['portion'];
  $prix = (int)$plat['prix'];
  $id_categorie = (int)$plat['id_categorie'];

  $sql = "UPDATE plat SET nom='$nom', detail='$detail', portion=$portion, prix=$prix, id_categorie=$id_categorie WHERE id=$id";
  return creer($bd, $sql);
}

/**
 * Enlève une plat.
 * @param {int} - $idPlat : identifiant de le plat à enlever
 * @return {int} - nombre d'enregistrements enlevés
 */
function enlever($idPlat) {
  $id = (int)$idPlat;
  $bd = ouvrirConnexion();
  return supprimer($bd, "DELETE FROM plat WHERE id=$id");
}