<?php
session_start();
require_once '../../middleware/Check_user_connexion.php';
require_once '../../Models/Article.php';
require_once '../../Models/Theme.php';
require_once '../../Models/Database.php';
checkBlogPage();


if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}



$db = new Database();
$article = new Article($db->connect_Db());
$theme = new Theme($db->connect_Db());

if (isset($_GET['nbr_article'])) {
    $nbr_article = $_GET['nbr_article'];
} else {
    $nbr_article = 6;
}
$article->setLinesParPage(lignes_par_page: $nbr_article);

$listThemes = $theme->getThemes();
$listArticles = $article->All_Articles($page);


// pagination
$nbrArticles = $article->Nbr_Articles();
$lignesParPage = $article->getLinesParPage();
$nbrePages = ceil($nbrArticles / $lignesParPage);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DRIVE-LOC -- List articles</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="../../assets/img/vendor-7.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../assets/css/style.css" rel="stylesheet">

    <style>
        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">
        <div class="row">
            <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body pr-3" href=""><i class="fa fa-phone-alt mr-2"></i>+212679997258</a>
                    <span class="text-body">|</span>
                    <a class="text-body px-3" href=""><i class="fa fa-envelope mr-2"></i>rabehlife144@gmail.com</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body px-3" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-body px-3" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-body px-3" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-body px-3" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-body pl-3" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative px-lg-5" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="../../index.php" class="navbar-brand">
                    <h1 class="text-uppercase text-primary mb-1"><span class="text-white">DRIVE-</span>LOC</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="../../index.php" class="nav-item nav-link">Accueil</a>
                        <a href="../List_Voitures.php" class="nav-item nav-link">List Voitures</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown">
                                Blog
                            </a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="../List_Articles.php" class="dropdown-item active">
                                    List Articles
                                </a>
                                <a href="./List_Themes.php" class="dropdown-item">List Thèmes</a>
                            </div>
                        </div>
                        <a href="../List_VoituresCategory.php" class="nav-item nav-link">Categories</a>
                        <?php if (isset($_SESSION['user']) && $_SESSION['role'] == 2): ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <?= $_SESSION['user']['username']; ?>
                                </a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="../../Controllers/Lougout.php" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                    <a href="../../dashboard/client/reservation.php" class="dropdown-item">client
                                        Dashboard</a>
                                </div>
                            </div>
                        <?php elseif (isset($_SESSION['user']) && $_SESSION['role'] == 1): ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <?= $_SESSION['user']['username']; ?>
                                </a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="../../Controllers/Lougout.php" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                    <a href="../../dashboard/admin/voiture.php" class="dropdown-item">admin Dashboard</a>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <div class="fas fa-user"></div>
                                </a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="../views/Sinscrire.php" class="dropdown-item">S'inscrire</a>
                                    <a href="../views/Se_connecter.php" class="dropdown-item">Se connecter</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Rent A Car Start -->
    <div class="container-fluid mt-5">
        <div class="container">
            <!-- <h1 class="display-5 text-uppercase text-center mb-5">Explorer les differents articles</h1> -->
            <div class="row mb-5">
                <div class="col-md-6 text-left">
                    <form action="./List_Articles.php" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher un article">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-inline-block mr-3">
                        <select class="form-control" name="theme_filter" id="theme_filter">
                            <option value="">Filtrer par thème</option>
                            <?php foreach ($listThemes as $theme): ?>
                                <option value="<?php echo $theme['id_theme']; ?>"><?php echo $theme['theme_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <a href="AjouterArticle__form.php" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Ajouter un article
                    </a>
                </div>
            </div>
            <div class="row">
                <?php foreach ($listArticles as $article): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0"
                            style="overflow: hidden; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img class="card-img-top" src="<?= $article['image_article']; ?>" alt="Image de l'article"
                                style="height: 180px; object-fit: cover;">
                            <div class="card-body" style="padding: 20px;">
                                <h5 class="card-title text-dark" style="font-weight: 600; font-size: 1.2rem;">
                                    <?= substr($article['article_title'], 0, 40) . '...'; ?>
                                </h5>
                                <p class="card-text text-secondary" style="font-size: 0.95rem; line-height: 1.5;">
                                    <?= substr($article['article_description'], 0, 70) . '...'; ?>
                                </p>
                                <a href="./ArticleDetails.php?article_id=<?= $article['id_article']; ?>"
                                    class="btn btn-primary"
                                    style="font-size: 0.9rem; padding: 10px 20px; border-radius: 5px;">En savoir plus</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 pb-3">
        <div class="container">
            <div class="row align-items-center">
                <!-- Pagination (left-aligned) -->
                <div class="col-md-10 order-md-1">
                    <nav>
                        <ul class="pagination justify-content-start mb-0">
                            <li class="page-item">
                                <?php
                                if ($page > 1) {
                                    $previous = $page - 1;
                                    echo "<a class='page-link' href='?page=$previous'><i class='fa fa-angle-double-left'></i></a>";
                                } else {
                                    echo "<a class='page-link' href='?page=1'><i class='fa fa-angle-double-left'></i></a>";
                                }
                                ?>
                            </li>
                            <?php
                            for ($i = 1; $i <= $nbrePages; $i++) {
                                if ($page == $i) {
                                    echo "<li class='page-item active'><a class='page-link' href='#'>$i<span class='sr-only'></span></a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                                }
                            }
                            ?>
                            <li class="page-item">
                                <?php
                                if ($page < $nbrePages) {
                                    $suivant = $page + 1;
                                    echo "<a class='page-link' href='?page=$suivant'><i class='fa fa-angle-double-right'></i></a>";
                                } else {
                                    echo "<a class='page-link' href='?page=$nbrePages'><i class='fa fa-angle-double-right'></i></a>";
                                }
                                ?>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Select Dropdown (right-aligned) -->
                <div class="col-md-2 order-md-2 text-md-end">
                    <form action="./List_Articles.php" method="get">
                        <select class="form-control" name="nbr_article" onchange="this.form.submit()">
                            <option value="" selected>Choisissez Nombre d'article à afficher</option>
                            <?php if ($nbr_article == 3): ?>
                                <option value="3" selected>3</option>
                            <?php else: ?>
                                <option value="3">3</option>
                            <?php endif; ?>
                            <?php if ($nbr_article == 6): ?>
                                <option value="6" selected>6</option>
                            <?php else: ?>
                                <option value="6">6</option>
                            <?php endif; ?>
                            <?php if ($nbr_article == 9): ?>
                                <option value="9" selected>9</option>
                            <?php else: ?>
                                <option value="9">9</option>
                            <?php endif; ?>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Rent A Car End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-4 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Contact Nous</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i>Safi, Nouvelle ville</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i>+212 345 67890</p>
                <p><i class="fa fa-envelope text-white mr-3"></i>rabehlife144@gmail.com</p>
                <h6 class="text-uppercase text-white py-2">Follow Us</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-dark btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Liens vers Autres</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Acceuil</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Liste
                        des
                        voitures</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Category</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>S'inscrire</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Se
                        connecter</a>
                    <a class="text-body" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Contact</a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Donner Message</h4>
                <p class="mb-4">Envoyez-nous un message et nous vous contacterons dans les plus bref delai</p>
                <div class="w-100 mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control bg-dark border-dark" style="padding: 25px;"
                            placeholder="Your Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary text-uppercase px-3">S'inscrire</button>
                        </div>
                    </div>
                </div>
                <i>Restez connecter</i>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
        <p class="mb-2 text-center text-body">&copy; <a href="#">CodeChogun</a>. Tout les droits reserve.</p>
        <p class="m-0 text-center text-body">Crée par <a href="https://htmlcodex.com">Abderrahmane Rabeh</a></p>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/lib/easing/easing.min.js"></script>
    <script src="../../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../../assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../../assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../../assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../assets/js/main.js"></script>
</body>

</html>