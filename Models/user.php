<?php

class User
{
    private $Conx_DataBase;
    public function __construct($db)
    {
        $this->Conx_DataBase = $db;
    }

    public function get_User($email)
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $User_Exist = $query->fetch();
        return $User_Exist;

    }

}