<?php
session_start();
require_once '../../middleware/Check_user_connexion.php';
require_once '../../Models/Theme.php';
require_once '../../Models/Database.php';
checkBlogAjouterPage();

$db = new Database;

$theme = new Theme($db->connect_Db());

$listTags = $theme->get_Tags();
$listThemes = $theme->getThemes();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIVE-LOC -- Ajouter Article</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/ajouterVoiture.css">

    <link href="../../assets/img/vendor-7.png" rel="icon">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="top-buttons">
            <a href="../../dashboard/admin/categories.php" class="btn"><i class="fas fa-tachometer-alt"></i>
                Dashboard</a>
            <a href="../../index.php" class="btn"><i class="fas fa-home"></i> Home</a>
        </div>
        <h2 class="text-center mb-4">Ajouter un Article</h2>
        <form action="../../Controllers/AjouterArticle.php" method="POST" enctype="multipart/form-data">
            <!-- Article Title -->
            <div class="form-group">
                <label for="article_title">Titre de l'Article</label>
                <input type="text" class="form-control" id="article_title" name="article_title"
                    placeholder="Entrez le titre de l'article" required>
            </div>

            <!-- Article Description -->
            <div class="form-group">
                <label for="article_description">Description de l'Article</label>
                <textarea class="form-control" id="article_description" name="article_description"
                    placeholder="Entrez la description de l'article" required
                    style="height: 150px; border-radius: 8px; padding: 10px;"></textarea>
            </div>


            <!-- Image Article -->
            <div class="form-group">
                <label for="image_article_url">Image de l'Article</label>
                <input type="url" class="form-control" id="image_article_url" name="image_article_url"
                    placeholder="Entrez l'URL de l'image">
            </div>

            <!-- Video Article -->
            <div class="form-group">
                <label for="video_article_url">Vidéo de l'Article (URL)</label>
                <input type="url" class="form-control" id="video_article_url" name="video_article_url"
                    placeholder="Entrez l'URL de la vidéo">
            </div>

            <!-- Theme -->
            <div class="form-group">
                <label for="theme">Thème</label>
                <select class="form-control" id="theme" name="theme">
                    <option value="" selected>Sélectionnez un thème</option>
                    <?php foreach ($listThemes as $theme): ?>
                        <option value="<?php echo $theme['id_theme']; ?>"><?php echo $theme['theme_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tags -->
            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control" id="tags" name="tags[]" multiple>
                    <?php foreach ($listTags as $tag): ?>
                        <option value="<?php echo $tag['id_tag']; ?>">
                            <?php echo $tag['tag_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="form-btn">Ajouter Article</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize Select2 on the Tags dropdown
            $('#tags').select2({
                placeholder: "Sélectionnez des tags",
                allowClear: true,
                width: '90%'
            });
        });
    </script>
</body>

</html>