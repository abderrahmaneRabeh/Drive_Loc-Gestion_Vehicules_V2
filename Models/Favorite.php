<?php


class Favorite
{


    private $Conx_database;

    public function __construct($db)
    {
        $this->Conx_database = $db;
    }


    public function ajouterFavorite($id_user, $id_article)
    {
        $query = $this->Conx_database->prepare("INSERT INTO favorites (id_utilisateur, id_article) VALUES (:id_utilisateur, :id_article)");
        $query->bindParam(':id_utilisateur', $id_user);
        $query->bindParam(':id_article', $id_article);
        $query->execute();
        return $query->rowCount();
    }

    public function getFavorites($user_id)
    {
        $query = $this->Conx_database->prepare("SELECT id_article FROM favorites WHERE id_utilisateur = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteFavorite($user_id, $article_id)
    {
        $query = $this->Conx_database->prepare("DELETE FROM favorites WHERE id_utilisateur = :user_id AND id_article = :article_id");
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':article_id', $article_id);
        $query->execute();
        return $query->rowCount();
    }

    public function UserFavoriteArticle($user_id)
    {
        $query = $this->Conx_database->prepare("SELECT * FROM favorites, articles WHERE favorites.id_article = articles.id_article  AND id_utilisateur = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        return $query->fetchAll();
    }
}