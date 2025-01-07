<?php
session_start();
require_once '../Models/Article.php';
require_once '../Models/Commentaire.php';
$commentaireObj = new Commentaire();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article_id = $_POST['article_id'];
    $commentaire = $_POST['comment'];
    $utilisateur_id = $_SESSION['user']['id_utilisateur'];
    $utilisateur_nom = $_SESSION['user']['username'];

    $result = $commentaireObj->AjouterCommentaire($commentaire, $article_id, $utilisateur_id, $utilisateur_nom);

    if ($result) {
        $_SESSION["success_commentaire"] = "Commentaire ajouter avec success";
        header("Location: ../views/Blog/ArticleDetails.php?article_id=" . $article_id);
        exit;
    } else {
        echo "Erreur lors de l'ajout du commentaire";
        exit;
    }

} else {
    $_SESSION["error_commentaire"] = "Les paramètres sont manquants";
    header("Location: ../views/Blog/ArticleDetails.php?article_id=" . $article_id);
    exit;
}