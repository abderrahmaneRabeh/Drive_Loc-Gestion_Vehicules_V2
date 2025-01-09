<?php


require_once '../../Models/Article.php';
require_once '../../Models/Database.php';


$db = new Database();
$article = new Article($db->connect_Db());

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $articles = $article->Rechercher_Article($search);
    echo json_encode($articles);
}