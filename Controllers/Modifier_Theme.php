<?php
session_start();
require_once '../Models/Theme.php';
require_once '../Models/Database.php';

$db = new Database();
$theme = new Theme($db->connect_Db());


if (isset($_POST['theme_name'])) {
    $theme_name = $_POST['theme_name'];
    $id = $_POST['theme_id'];

    $result = $theme->ModifierTheme($id, $theme_name);

    if ($result) {
        $_SESSION["success"] = "Theme modifier avec success";
        header("Location: ../dashboard/admin/theme.php");
    } else {
        $_SESSION["error"] = "Theme non modifier";
        header("Location: ../dashboard/admin/theme.php");
    }


} else {
    $_SESSION["error"] = "Theme non modifier";
    header("Location: ../dashboard/admin/theme.php");
}

