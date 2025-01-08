<?php
session_start();
require_once '../../middleware/Check_user_connexion.php';
require_once '../../Models/Tag.php';
require_once '../../Models/Database.php';
AjouterFormCheck();


$db = new Database();
$tag = new Tag($db->connect_Db());

if (isset($_GET['tag_id'])) {
    $tag_id = $_GET['tag_id'];
    $tag_name = $tag->getOneTag($tag_id);
} else {
    $_SESSION["error"] = "Tag non modifier | Id non valide";
    header("Location: ../dashboard/admin/Tags.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIVE-LOC -- Modifier Tag</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/ajouterVoiture.css">

    <link href="../../assets/img/vendor-7.png" rel="icon">
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>
    <div class="container">
        <div class="top-buttons">
            <a href="../../dashboard/admin/Tags.php" class="btn"><i class="fas fa-tachometer-alt"></i>
                Dashboard</a>
            <a href="../../index.php" class="btn"><i class="fas fa-home"></i> Home</a>
        </div>
        <h2>Modifier Un Tags</h2>

        <form action="../../Controllers/Modifier_Tag.php" method="POST" id="carForm">
            <input type="hidden" name="tag_id" value="<?= $tag_name['id_tag']; ?>">
            <div id="carGroupContainer">
                <div class="car-card">
                    <h3>Tag</h3>
                    <div class="form-group">
                        <label for="tag_name">Nom du tag</label>
                        <input type="text" value="<?= $tag_name['tag_name']; ?>" name="tag_name"
                            placeholder="Enter tag name" required>
                    </div>
                </div>

            </div>
            <button type="submit" class="form-btn">Modifier Tag</button>
        </form>
    </div>
</body>

</html>