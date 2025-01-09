<?php
session_start();
require_once '../Models/Database.php';
require_once '../Models/Favorite.php';

$db = new Database();
$favorite = new Favorite($db->connect_Db());

if (isset($_GET['article_id'])) {
    $id_article = $_GET['article_id'];
    $user_id = $_SESSION['user']['id_utilisateur'];
    $result = $favorite->deleteFavorite($user_id, $id_article);

    if ($result) {
        $_SESSION["success"] = "Article supprimer aux favoris avec success";
        header("Location: ../views/Blog/List_Articles.php");
    } else {
        $_SESSION["error"] = "Article non supprimer aux favoris";
        header("Location: ../views/Blog/List_Articles.php");
    }
} else {
    $_SESSION["error"] = "Id non valide";
    header("Location: ../views/Blog/List_Articles.php");
}