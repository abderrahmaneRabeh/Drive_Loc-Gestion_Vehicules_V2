<?php
session_start();
require_once '../Models/Article.php';


$Ajouter_Article_Controller = new Article();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $theme_id = $_POST['theme'];
    $video_article_url = $_POST['video_article_url'];
    $image_article_url = $_POST['image_article_url'];
    $title_article = $_POST['article_title'];
    $article_description = $_POST['article_description'];

    $result = $Ajouter_Article_Controller->Modifier_Article($_POST['article_id'], $image_article_url, $title_article, $video_article_url, $theme_id, $article_description);

    if ($result) {
        $_SESSION["success_article"] = "Article ajouter avec success";
        header("Location: ../views/Blog/ArticleDetails.php?article_id=" . $_POST['article_id']);
        exit;
    } else {
        echo "Erreur lors de l'ajout de l'article";
        exit;
    }
} else {
    $_SESSION["error_article"] = "Les paramètres sont manquants";
}

