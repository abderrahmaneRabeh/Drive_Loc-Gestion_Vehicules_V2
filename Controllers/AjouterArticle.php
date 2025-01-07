<?php
session_start();
require_once '../Models/Article.php';


$Ajouter_Article_Controller = new Article();
$tout_est_effectuer = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tags = $_POST['tags'];
    $theme_id = $_POST['theme'];
    $video_article_url = $_POST['video_article_url'];
    $image_article_url = $_POST['image_article_url'];
    $title_article = $_POST['article_title'];
    $utilisateur_id = $_SESSION['user']['id_utilisateur'];
    $article_description = $_POST['article_description'];
    $current_Article_id = $Ajouter_Article_Controller->Ajouter_Article($image_article_url, $title_article, $video_article_url, $theme_id, $utilisateur_id, $article_description);

    foreach ($tags as $key => $value) {

        $tag_value = $tags[$key];
        $result = $Ajouter_Article_Controller->Ajouter_Tag_Article($current_Article_id, $tag_value);

        if (!$result) {
            $tout_est_effectuer = false;
        }
    }

} else {
    $tout_est_effectuer = false;
}

if ($tout_est_effectuer) {
    $_SESSION["success"] = "Article ajouter avec success";
    header("Location: ../views/Blog/ArticleDetails.php?article_id=" . $current_Article_id);
    exit;
} else {
    $_SESSION["error"] = "Article non ajouter";
    exit;
}