<?php
session_start();
require_once '../Models/Database.php';
require_once '../Models/Favorite.php';

$db = new Database();
$favorite = new Favorite($db->connect_Db());

if (isset($_GET['id_article'])) {
    $id_article = $_GET['id_article'];
    $user_id = $_SESSION['user']['id_utilisateur'];
    $result = $favorite->ajouterFavorite($user_id, $id_article);

    if ($result) {
        $_SESSION["success"] = "Article ajouter aux favoris avec success";
    } else {
        $_SESSION["error"] = "Article non ajouter aux favoris";
    }
}