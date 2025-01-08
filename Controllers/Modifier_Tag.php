<?php
session_start();
require_once '../Models/Tag.php';
require_once '../Models/Database.php';


$db = new Database();
$tag = new Tag($db->connect_Db());

if (isset($_POST['tag_name'])) {

    $tag_name = $_POST['tag_name'];
    $id = $_POST['tag_id'];


    $result = $tag->ModifierTag($id, $tag_name);

    if ($result) {
        $_SESSION["success"] = "Tag modifier avec success";
        header("Location: ../dashboard/admin/Tags.php");
        exit();
    } else {
        $_SESSION["error"] = "Tag non modifier";
        header("Location: ../dashboard/admin/Tags.php");
        exit();
    }


} else {
    $_SESSION["error"] = "Tag non modifier | Erreur dans le traitement de la requete";
    header("Location: ../dashboard/admin/Tags.php");
    exit();
}