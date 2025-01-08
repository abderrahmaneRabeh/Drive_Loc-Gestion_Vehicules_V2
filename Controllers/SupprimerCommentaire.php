<?php
session_start();
require_once '../Models/Article.php';
require_once '../Models/Commentaire.php';

$commentaireObj = new Commentaire();


if (isset($_GET['comment_id'])) {

    $id = $_GET['comment_id'];
    $result = $commentaireObj->DeleteCommentaire($id);
    $current_Article_id = $_GET['article_id'];

    if ($result) {
        $_SESSION["success_commentaire"] = "Commentaire supprimer  avec success";
        header("Location: ../views/Blog/ArticleDetails.php?article_id=" . $current_Article_id);
    } else {
        $_SESSION["error_commentaire"] = "La suppression du commentaire a échou";
        header("Location: ../views/Blog/ArticleDetails.php?article_id=" . $current_Article_id);
    }


} else {
    $_SESSION['error_commentaire'] = "error de traitement de commentaire";
    header("Location: ../views/Blog/ArticleDetails.php?article_id=" . $current_Article_id);
}


// echo "<pre>";
// print_r($_GET);
// echo "</pre>";
