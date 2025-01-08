<?php
session_start();

require_once '../Models/Reservation.php';
require_once '../Models/Database.php';

$db = new Database();


if (isset($_POST['id_vehivule']) && isset($_POST['statut'])) {

    $id_vehivule = $_POST['id_vehivule'];
    $statut = $_POST['statut'];

    $reservation = new Reservation($db->connect_Db());
    $result = $reservation->UpdateSatutReservation($id_vehivule, $statut);

    if ($result) {
        $_SESSION["success"] = "Statut mis à jour avec succès";
        header("Location: ../dashboard/admin/reservation.php");
        exit;
    } else {
        $_SESSION["error"] = "Statut non mis à jour";
        header("Location: ../dashboard/admin/reservation.php");
        exit;
    }

} else {
    $_SESSION["error"] = "Les paramètres sont manquants";
    header("Location: ../dashboard/admin/reservation.php");
    exit;
}