<?php
require_once '../Models/Voiture.php';
require_once '../Models/Category.php';
require_once '../Models/Database.php';

$db = new Database();

$categoriesVoitures = new Category($db->connect_Db());


if (isset($_GET['category_id'])) {
    $categoriesVoituresList = $categoriesVoitures->All_VoituresByCategory($_GET['category_id']);
    echo json_encode($categoriesVoituresList);
}