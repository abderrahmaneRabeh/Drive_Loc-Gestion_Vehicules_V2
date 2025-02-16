<?php
session_start();
require_once '../../middleware/Check_user_connexion.php';
require_once '../../Models/Article.php';
require_once '../../Models/Commentaire.php';
require_once '../../Models/Database.php';

$db = new Database();

checkBlogPage();

$articleObj = new Article($db->connect_Db());
$commentaireObj = new Commentaire($db->connect_Db());

if (isset($_GET['article_id'])) {
    $id = $_GET['article_id'];
    $article = $articleObj->get_One_Article($id);
    $tags = $articleObj->get_Articles_tags($id);
    $commentaires = $commentaireObj->getArticleCommentaires($id);

    // echo "<pre>";
    // // print_r($article);
    // print_r($commentaires);
    // echo "</pre>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DRIVE-LOC -- articles Details</title>
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
                            <a href="#" class="nav-link  dropdown-toggle" data-toggle="dropdown">
                                Blog
                            </a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="./List_Articles.php" class="dropdown-item ">
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
            <h3 class="display-5 text-uppercase text-center mb-5">Captivant de l'article</h3>
            <div class="row">
                <div class="col-12 mb-5">
                    <div style="text-align: center; margin-bottom: 30px;">
                        <img src="<?= $article['image_article']; ?>" alt="Image de l'article"
                            style="height: 250px; width: 50%; object-fit: cover;">
                    </div>
                    <h1 class="text-dark"
                        style="font-weight: 700; font-size: 2.5rem; text-align: center; margin-bottom: 20px;">
                        <?= $article['article_title']; ?>
                    </h1>
                    <p class="text-secondary" style="font-size: 1.2rem; line-height: 1.8; margin-bottom: 30px;">
                        <?= $article['article_description']; ?>
                    </p>
                    <div style="margin-top: 30px;">
                        <h5 class="text-dark" style="font-weight: 600; margin-bottom: 15px;">Détails supplémentaires
                        </h5>
                        <ul style="list-style: none; padding-left: 0; font-size: 1.2rem;">
                            <li><i class="fa fa-calendar text-primary mr-2"></i>Date de publication:
                                <?= $article['article_created_at']; ?>
                            </li>
                            <li><i class="fa fa-user text-primary mr-2"></i>Auteur: <?= $article['username']; ?></li>
                            <li><i class="fa fa-tags text-primary mr-2"></i>theme: <?= $article['theme_name']; ?></li>
                        </ul>
                    </div>
                    <div style="margin-top: 30px;">
                        <h5 class="text-dark" style="font-weight: 600; margin-bottom: 15px;">Tags</h5>
                        <div>

                            <?php
                            $colors = ['badge-primary', 'badge-secondary', 'badge-success', 'badge-danger', 'badge-warning', 'badge-info', 'badge-light', 'badge-dark'];
                            foreach ($tags as $index => $tag):
                                $color = $colors[$index % count($colors)];
                                ?>
                                <span class="badge <?= $color; ?>"
                                    style="font-size: 1rem; margin-right: 10px;"><?= $tag['tag_name']; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div style="text-align: center; margin-top: 40px;">
                        <a href="./List_Articles.php" class="btn btn-primary"
                            style="font-size: 1.2rem; padding: 5px 20px; border-radius: 5px;">Retour à la liste des
                            articles</a>
                    </div>
                </div>
            </div>
            <form action="../../Controllers/AjouterCommentaires.php" method="post">
                <input type="hidden" name="article_id" value="<?= $article['id_article']; ?>">
                <div class="row">
                    <div class="col-12 mt-5 mb-5">
                        <h4 class="text-dark" style="font-weight: 600; font-size: 2rem; margin-bottom: 20px;">Laisser
                            un commentaire</h4>
                        <div class="form-group">
                            <label for="comment">Commentaire</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3"
                            style="font-size: 1.2rem; padding: 5px 25px; border-radius: 5px;">Envoyer</button>
                    </div>
                </div>
            </form>
            <div class="alert-wrapper">
                <?php
                if (isset($_SESSION["success_commentaire"])) {
                    echo "<div class=\"alert alert-success\">" . $_SESSION["success_commentaire"] . "</div>";
                    unset($_SESSION["success_commentaire"]);
                }
                if (isset($_SESSION["error_commentaire"])) {
                    echo "<div class=\"alert alert-danger\">" . $_SESSION["error_commentaire"] . "</div>";
                    unset($_SESSION["error_commentaire"]);
                }
                ?>
            </div>
            <div class="row">
                <div class="col-12  mb-5">
                    <h4 class="text-dark" style="font-weight: 600; font-size: 2rem; margin-bottom: 20px;">Commentaires
                    </h4>
                    <?php foreach ($commentaires as $comment): ?>
                        <div class="media  shadow-sm p-3 bg-light rounded">
                            <div class="media-body">
                                <h5 class="mt-0"><?= $comment['utilisateur_nom']; ?></h5>
                                <p><?= $comment['commentaire']; ?></p>
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_utilisateur'] == $comment['id_utilisateur']): ?>
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-warning editCommentBtn"
                                            data-id="<?= $comment['id_comment']; ?>"
                                            data-content="<?= htmlspecialchars($comment['commentaire']); ?>" data-toggle="modal"
                                            data-target="#editCommentModal">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="../../Controllers/SupprimerCommentaire.php?comment_id=<?= $comment['id_comment']; ?>&article_id=<?= $article['id_article']; ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?')"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Rent A Car End -->

    <!-- Edit Comment Modal -->
    <div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editCommentForm" method="post" action="../../Controllers/ModifierCommentaire.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCommentModalLabel">Modifier le commentaire</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="commentId" name="comment_id">
                        <input type="hidden" name="article_id" value="<?= $article['id_article']; ?>">
                        <div class="form-group">
                            <label for="editCommentText">Commentaire</label>
                            <textarea class="form-control" id="editCommentText" name="comment" rows="3"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




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
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Liste des
                        voitures</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Category</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>S'inscrire</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Se connecter</a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editCommentButtons = document.querySelectorAll('.editCommentBtn');
            editCommentButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const commentId = this.getAttribute('data-id');
                    const commentContent = this.getAttribute('data-content');
                    document.getElementById('commentId').value = commentId;
                    document.getElementById('editCommentText').value = commentContent;
                });
            });
        });
    </script>

</body>

</html>