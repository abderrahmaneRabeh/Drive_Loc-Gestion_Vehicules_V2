<?php

session_start();
require_once '../Models/Theme.php';
require_once '../Models/Database.php';

$db = new Database();
$theme = new Theme($db->connect_Db());

$tout_est_effectuer = true;


if (isset($_POST['theme_name'])) {
    $theme_names = $_POST['theme_name'];


    foreach ($theme_names as $theme_name) {

        $result = $theme->AjouterTheme($theme_name);

        if ($result == 0) {
            $tout_est_effectuer = false;
        }
    }
} else {
    $tout_est_effectuer = false;
}

if ($tout_est_effectuer) {
    $_SESSION["success"] = "Theme ajouter avec success";
    header("Location: ../dashboard/admin/Theme.php");
    exit;
} else {
    $_SESSION["error"] = "Error";
    header("Location: ../dashboard/admin/Theme.php");
    exit;
}