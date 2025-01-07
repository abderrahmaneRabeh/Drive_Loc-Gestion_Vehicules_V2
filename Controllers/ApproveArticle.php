<?php
session_start();

require_once '../Models/Article.php';


if (isset($_POST['id_article']) && isset($_POST['active_article'])) {

    $id_article = $_POST['id_article'];
    $active_article = $_POST['active_article'];

    $article = new Article();
    $result = $article->UpdateActive_article($id_article, $active_article);

    if ($result) {
        $_SESSION["success_article"] = "Statut mis à jour avec succès";
        header("Location: ../dashboard/admin/articles.php");
        exit;
    } else {
        $_SESSION["error_article"] = "Statut non mis à jour";
        header("Location: ../dashboard/admin/articles.php");
        exit;
    }

} else {
    $_SESSION["error"] = "Les paramètres sont manquants";
    header("Location: ../dashboard/admin/articles.php");
    exit;
}