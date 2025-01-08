<?php

require_once '../Models/Article.php';
require_once '../Models/Commentaire.php';

$commentaireObj = new Commentaire();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['comment_id'];
    $commentaire = $_POST['comment'];
    $result = $commentaireObj->UpdateCommentaire($id, $commentaire);
    $current_Article_id = $_POST['article_id'];

    if ($result) {
        $_SESSION["success_commentaire"] = "Commentaire Modifier Avec Success";
        header("Location: ../views/Blog/ArticleDetails.php?article_id=" . $current_Article_id);
    } else {
        $_SESSION["error_commentaire"] = "modification de commentaire est echou";
        header("Location: ../views/Blog/ArticleDetails.php?article_id=" . $current_Article_id);
    }
} else {
    $_SESSION["error_commentaire"] = "error de traitement de commentaire";
    header("Location: ../views/Blog/ArticleDetails.php?article_id=" . $current_Article_id);
}


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
