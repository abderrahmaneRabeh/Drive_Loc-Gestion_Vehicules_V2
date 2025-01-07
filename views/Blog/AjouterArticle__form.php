<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Article</title>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../assets/css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Rubik', sans-serif;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: 600;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-control {
            border-radius: 8px;
        }

        .form-control-file {
            padding: 10px;
        }

        .select2-container .select2-selection--multiple {
            height: 40px;
            padding: 5px 10px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Ajouter un Article</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Article Title -->
            <div class="form-group">
                <label for="article_title">Titre de l'Article</label>
                <input type="text" class="form-control" id="article_title" name="article_title"
                    placeholder="Entrez le titre de l'article" required>
            </div>

            <!-- Image Article -->
            <div class="form-group">
                <label for="image_article_url">Image de l'Article</label>
                <input type="file" class="form-control-file" id="image_article_url" name="image_article_url">
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
                    <option value="1">Thème 1</option>
                    <option value="2">Thème 2</option>
                    <option value="3">Thème 3</option>
                    <option value="4">Thème 4</option>
                </select>
            </div>

            <!-- Tags -->
            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control" id="tags" name="tags[]" multiple>
                    <option value="1">Tag 1</option>
                    <option value="2">Tag 2</option>
                    <option value="3">Tag 3</option>
                    <option value="4">Tag 4</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Ajouter Article</button>
        </form>
    </div>

</body>

</html>