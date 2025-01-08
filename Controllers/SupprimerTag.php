<?php
session_start();
require_once '../Models/Tag.php';
require_once '../Models/Database.php';


$db = new Database();
$tag = new Tag($db->connect_Db());

if (isset($_GET['tag_id'])) {
    $tag_id = $_GET['tag_id'];

    $result = $tag->DeleteTag($tag_id);

    if ($result) {
        $_SESSION["success"] = "Tag supprimer avec success";
        header("Location: ../dashboard/admin/Tags.php");
        exit();
    } else {
        $_SESSION["error"] = "Tag non supprimer";
        header("Location: ../dashboard/admin/Tags.php");
        exit();
    }
} else {
    $_SESSION["error"] = "Tag non supprimer | Id non valide";
    header("Location: ../dashboard/admin/Tags.php");
    exit();
}