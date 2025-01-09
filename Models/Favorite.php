<?php


class Favorite
{


    private $Conx_database;

    public function __construct($db)
    {
        $this->Conx_database = $db;
    }


    public function ajouterFavorite($id_user, $id_vehicule)
    {
        $query = $this->Conx_database->prepare("INSERT INTO favorites (id_utilisateur, id_article) VALUES (:id_utilisateur, :id_article)");
        $query->bindParam(':id_utilisateur', $id_user);
        $query->bindParam(':id_article', $id_vehicule);
        $query->execute();
        return $query->rowCount();
    }
}