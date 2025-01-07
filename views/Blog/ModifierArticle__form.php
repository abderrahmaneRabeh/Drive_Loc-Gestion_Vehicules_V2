<?php
session_start();
require_once '../../middleware/Check_user_connexion.php';
require_once '../../Models/Article.php';
checkBlogAjouterPage();

$articleObj = new Article();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $article = $articleObj->get_One_Article($id);
    $listThemes = $articleObj->getThemes();
    $listTags = $articleObj->get_Tags($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIVE-LOC -- Modifier Article</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/ajouterVoiture.css">

    <link href="../../assets/img/vendor-7.png" rel="icon">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="top-buttons">
            <a href="../../dashboard/client/articles.php" class="btn"><i class="fas fa-tachometer-alt"></i>
                Dashboard</a>
            <a href="../../index.php" class="btn"><i class="fas fa-home"></i> Home</a>
        </div>
        <h2 class="text-center mb-4">Modifier un Article</h2>
        <form action="../../Controllers/ModifierArticle.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="article_id" value="<?php echo $article['id_article']; ?>">
            <!-- Article Title -->
            <div class="form-group">
                <label for="article_title">Titre de l'Article</label>
                <input type="text" value="<?php echo $article['article_title']; ?>" class="form-control"
                    id="article_title" name="article_title" placeholder="Entrez le titre de l'article" required>
            </div>

            <!-- Article Description -->
            <div class="form-group">
                <label for="article_description">Description de l'Article</label>
                <textarea class="form-control" id="article_description" name="article_description"
                    placeholder="Entrez la description de l'article" required
                    style="height: 150px; border-radius: 8px; padding: 10px;">
                    <?php echo $article['article_description']; ?>
                </textarea>
            </div>


            <!-- Image Article -->
            <div class="form-group">
                <label for="image_article_url">Image de l'Article</label>
                <input type="url" value="<?php echo $article['image_article']; ?>" class="form-control"
                    id="image_article_url" name="image_article_url" placeholder="Entrez l'URL de l'image">
            </div>

            <!-- Video Article -->
            <div class="form-group">
                <label for="video_article_url">Vidéo de l'Article (URL)</label>
                <input type="url" value="<?php echo $article['video_article']; ?>" class="form-control"
                    id="video_article_url" name="video_article_url" placeholder="Entrez l'URL de la vidéo">
            </div>

            <!-- Theme -->
            <div class="form-group">
                <label for="theme">Thème</label>
                <select class="form-control" id="theme" name="theme">
                    <option value="" selected>Sélectionnez un thème</option>
                    <?php foreach ($listThemes as $theme): ?>
                        <?php if ($article['id_theme'] == $theme['id_theme']): ?>
                            <option value="<?php echo $theme['id_theme']; ?>" selected>
                                <?php echo $theme['theme_name']; ?>
                            </option>
                        <?php else: ?>
                            <option value="<?php echo $theme['id_theme']; ?>">
                                <?php echo $theme['theme_name']; ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tags -->
            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control" id="tags" name="tags[]" multiple>
                    <?php foreach ($listTags as $tag): ?>
                        <option value="<?php echo $tag['id_tag']; ?>" selected>
                            <?php echo $tag['tag_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="form-btn">Modifier Article</button>
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