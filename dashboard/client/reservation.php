<?php
session_start();
require_once '../../middleware/Check_user_connexion.php';
require_once '../../Models/Reservation.php';
require_once '../../Models/Database.php';

$db = new Database();

Dashboard_client_check_roleConnect();
$id = $_SESSION['user']['id_utilisateur'];

$Reservation = new Reservation($db->connect_Db());

$listReservation = $Reservation->getUserReservation($id);


?>

<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Reservation</title>

    <link rel="stylesheet" href="../css/style.css">
    <script defer src="../js/main.js"></script>
    <link href="/assets/img/vendor-7.png" rel="icon">


    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/Reservation.css">

</head>

<body>

    <div class="app-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="app-icon">
                    <div class="app-icon-title app-icon-title-a-tag">
                        <a href="../../index.php">
                            DRIVE-<span class="text-primary">LOC</span>
                        </a>
                    </div>
                </div>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="../../index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span>Acceuil</span>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="./reservation.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-calendar">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                        <span>Reservations</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="./avis.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-calendar">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                        <span>Avis</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="./articles.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-file-text">
                            <path
                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h10z" />
                        </svg>
                        <span>Articles</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="./Commentaire.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-message-square">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                        <span>Commentaire</span>
                    </a>
                </li>
            </ul>
            <div class="account-info">
                <?php
                if (isset($_SESSION["user"])) {
                    echo "<div class=\"account-info-name\">" . $_SESSION["user"]["username"] . "</div>";

                } else {
                    echo '<li class="scroll-to-section"><a href="./pages/login.php" id="login">S\'inscrire</a></li>';
                }

                ?>
                <a href="../../Controllers/Lougout.php" class="account-info-more lougout-btn">
                    <button class="account-info-more"
                        style="display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-log-out">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>
                    </button>
                </a>
            </div>
        </div>
        <div class="app-content">
            <div class="app-content-header">
                <h1 class="app-content-headerText">Reservation</h1>
                <button class="mode-switch" title="Switch Theme">
                    <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                        <defs></defs>
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                    </svg>
                </button>
            </div>
            <div class="app-content-actions">
                <div class="app-content-actions-wrapper">
                    <div class="filter-button-wrapper">
                        <button class="action-button d-none filter jsFilter"></button>
                    </div>
                    <button class="action-button d-none list active" title="List View">
                    </button>
                    <button class="action-button d-none grid" title="Grid View">
                    </button>
                </div>
            </div>
            <div class="alert-wrapper">
                <?php
                if (isset($_SESSION["success"])) {
                    echo "<div class=\"alert alert-success\">" . $_SESSION["success"] . "</div>";
                    unset($_SESSION["success"]);
                }
                if (isset($_SESSION["error"])) {
                    echo "<div class=\"alert alert-danger\">" . $_SESSION["error"] . "</div>";
                    unset($_SESSION["error"]);
                }
                ?>
            </div>
            <div class="products-area-wrapper tableView">
                <!-- start Table -->
                <table class="table table-dark table-bordered table-hover" style="font-size: 13px">
                    <thead class="thead-light">
                        <tr>
                            <th>Client</th>
                            <th>vehicule</th>
                            <th>dateDebut</th>
                            <th>dateFin</th>
                            <th>lieuPriseCharge</th>
                            <th>lieuRetour</th>
                            <th>Date de Reservation</th>
                            <th class="text-center">statut</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listReservation as $reservation): ?>
                            <tr>
                                <td><?= $reservation['username'] ?></td>
                                <td><?= $reservation['marque']; ?>     <?= $reservation['modele']; ?></td>
                                <td><?= $reservation['dateDebut']; ?></td>
                                <td><?= $reservation['dateFin']; ?></td>
                                <td><?= $reservation['lieuPriseCharge']; ?></td>
                                <td><?= $reservation['lieuRetour']; ?></td>
                                <td class="text-center"><?= $reservation['dateCreation']; ?></td>
                                <td>
                                    <?php if ($reservation['statut'] == "Confirmee"): ?>
                                        <span class="badge badge-success p-2">Confirmé</span>

                                    <?php elseif ($reservation['statut'] == "Annulee"): ?>
                                        <span class="badge badge-danger p-2">Annulé</span>
                                    <?php else: ?>
                                        <span class="badge badge-warning p-2">En attente</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($reservation['statut'] == "En attente"): ?>
                                        <a href="../../views/Update_Reservation__form.php?id=<?= $reservation['id_reservation']; ?>"
                                            class="btn btn-primary btn-sm">Modifier</a>
                                    <?php endif; ?>
                                    <a href="../../Controllers/Delete_ReservationClient.php?id=<?= $reservation['id_reservation']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Voulez-vous supprimer ce Reservation ?')">Annuler</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- end Table -->
            </div>
        </div>
    </div>

</body>

</html>