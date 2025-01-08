<?php
session_start();

require_once '../Models/Reservation.php';
require_once '../Models/Database.php';

$db = new Database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $reservation = new Reservation($db->connect_Db());
    $result = $reservation->DeleteReservation($id);

    if ($result) {
        $_SESSION["success"] = "Reservation supprimée avec succès";
        header("Location: ../dashboard/admin/reservation.php");
        exit;
    } else {
        $_SESSION["error"] = "Une erreur s'est produite lors de la suppression de la reservation";
        header("Location: ../dashboard/admin/reservation.php");
        exit;
    }
} else {
    $_SESSION["error"] = "Une erreur s'est produite lors de la suppression de la reservation";
    header("Location: ../dashboard/admin/reservation.php");
    exit;
}