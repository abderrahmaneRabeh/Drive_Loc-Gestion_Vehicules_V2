<?php
session_start();
require_once '../../middleware/Check_user_connexion.php';
require_once '../../Models/Theme.php';
require_once '../../Models/Database.php';
AjouterFormCheck();

$db = new Database();

if (isset($_GET['theme_id'])) {
    $id = $_GET['theme_id'];
    $theme = new Theme($db->connect_Db());
    $theme_name = $theme->getThemeById($id);
} else {
    $_SESSION["error"] = "Id non valide";
    header("Location: ../../dashboard/admin/theme.php");
}


// echo "<pre>";
// print_r($theme_name);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIVE-LOC -- Modifier Theme </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/ajouterVoiture.css">

    <link href="../../assets/img/vendor-7.png" rel="icon">
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>
    <div class="container">
        <div class="top-buttons">
            <a href="../../dashboard/admin/Theme.php" class="btn"><i class="fas fa-tachometer-alt"></i>
                Dashboard</a>
            <a href="../../index.php" class="btn"><i class="fas fa-home"></i> Home</a>
        </div>
        <h2>Modifier un Theme</h2>

        <form action="../../Controllers/Modifier_Theme.php" method="POST" id="carForm">
            <input type="hidden" name="theme_id" value="<?= $theme_name['id_theme']; ?>">
            <div id="carGroupContainer">
                <div class="car-card">
                    <h3>Theme</h3>
                    <div class="form-group">
                        <label for="theme_name">Nom du theme</label>
                        <input type="text" name="theme_name" value="<?= $theme_name['theme_name']; ?>"
                            placeholder="Enter theme name" required>
                    </div>
                </div>

            </div>
            <button type="submit" class="form-btn">Modifier Themes</button>
        </form>
    </div>
</body>

</html>