<?php
session_start();
require_once '../Models/Article.php';

$article = new Article();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = $article->Delete_Article($id);

    if ($result) {
        $_SESSION["success_article"] = "Article supprimée avec succès";

        if ($_SESSION["role"] == 1) {
            header("Location: ../dashboard/admin/articles.php");
            exit;
        } else {
            header("Location: ../dashboard/client/articles.php");
            exit;
        }
    } else {
        $_SESSION["error_article"] = "Article non supprimée";
        if ($_SESSION["role"] == 1) {
            header("Location: ../dashboard/admin/articles.php");
            exit;
        } else {
            header("Location: ../dashboard/client/articles.php");
            exit;
        }
    }
} else {
    $_SESSION["error_article"] = "Une erreur s'est produite lors de la suppression de l'article";
    if ($_SESSION["role"] == 1) {
        header("Location: ../dashboard/admin/articles.php");
        exit;
    } else {
        header("Location: ../dashboard/client/articles.php");
        exit;
    }
}