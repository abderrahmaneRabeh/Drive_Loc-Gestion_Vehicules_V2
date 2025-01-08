<?php
session_start();
require_once '../Models/Theme.php';
require_once '../Models/Database.php';

$db = new Database();
$theme = new Theme($db->connect_Db());

if (isset($_GET['theme_id'])) {

    $id = $_GET['theme_id'];
    $result = $theme->DeleteTheme($id);
    if ($result) {
        $_SESSION["success"] = "Theme supprimer avec success";
        header("Location: ../dashboard/admin/theme.php");
    } else {
        $_SESSION["error"] = "Theme non supprimer";
        header("Location: ../dashboard/admin/theme.php");
    }
} else {
    $_SESSION["error"] = "Theme non supprimer";
    header("Location: ../dashboard/admin/theme.php");
}

