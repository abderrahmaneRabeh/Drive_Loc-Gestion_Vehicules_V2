<?php
session_start();
require_once '../Models/Tag.php';
require_once '../Models/Database.php';


$db = new Database();
$tag = new Tag($db->connect_Db());

$tout_est_effectuer = true;

if (isset($_POST['tag_name'])) {

    $tag_names = $_POST['tag_name'];

    foreach ($tag_names as $tag_name) {

        $result = $tag->Ajouter_Tag($tag_name);

        if ($result == 0) {
            $tout_est_effectuer = false;
        }

    }

} else {
    $tout_est_effectuer = false;
}

if ($tout_est_effectuer) {
    $_SESSION["success"] = "Tag ajouter avec success";
    header("Location: ../dashboard/admin/Tags.php");
    exit();
} else {
    $_SESSION["error"] = "Tag non ajouter";
    header("Location: ../dashboard/admin/Tags.php");
    exit();
}