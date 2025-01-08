<?php

require_once '../Models/Database.php';
require_once '../Models/Seconnecter.php';
require_once '../Models/user.php';
$db = new Database();

class SeconnecterController extends Seconnecter
{
    public function LoginController($email, $pw)
    {
        $result = $this->Login($email, $pw);

        if ($result) {
            session_start();

            $user = new User($this->Conx_DataBase);
            $utilisateurSelectioner = $user->get_User($email);

            $_SESSION['user'] = $utilisateurSelectioner;
            $_SESSION['role'] = $utilisateurSelectioner['role_id'];
            header("Location: ../index.php");
            exit;
        } else {
            header("Location: ../views/Se_connecter.php?pw=Password Incorrect");
            exit;
        }

    }

}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pw = $_POST['motDePasse'];

    $AuthController = new SeconnecterController($db->connect_Db());
    $AuthController->LoginController($email, $pw);

}