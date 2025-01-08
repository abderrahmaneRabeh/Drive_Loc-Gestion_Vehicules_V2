<?php
// require "Database.php";
class Commentaire extends Database
{

    private $Conx_DataBase;
    public function __construct()
    {
        $this->Conx_DataBase = $this->connect_Db();
    }

    public function AjouterCommentaire($commentaire, $article_id, $utilisateur_id, $utilisateur_nom)
    {
        $query = $this->Conx_DataBase->prepare("INSERT INTO `commentaires`(`commentaire`, `id_article`, `id_utilisateur`,`utilisateur_nom`) VALUES (:commentaire, :article_id, :utilisateur_id,:nom_utilisateur)");
        $query->bindParam(':commentaire', $commentaire);
        $query->bindParam(':article_id', $article_id);
        $query->bindParam(':utilisateur_id', $utilisateur_id);
        $query->bindParam(':nom_utilisateur', $utilisateur_nom);
        $query->execute();
        return $this->Conx_DataBase->lastInsertId();
    }

    public function getArticleCommentaires($article_id)
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM commentaires WHERE id_article = :article_id Order by id_comment DESC");
        $query->bindParam(':article_id', $article_id);
        $query->execute();
        $commentaires = $query->fetchAll();
        return $commentaires;
    }

    public function getALlCommentaires()
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM commentaires");
        $query->execute();
        $commentaires = $query->fetchAll();
        return $commentaires;
    }

    public function DeleteCommentaire($id)
    {
        $query = $this->Conx_DataBase->prepare("DELETE FROM commentaires WHERE id_comment = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->rowCount();
    }

    public function UpdateCommentaire($id, $commentaire)
    {
        $query = $this->Conx_DataBase->prepare("UPDATE commentaires SET commentaire = :commentaire WHERE id_comment = :id");
        $query->bindParam(':commentaire', $commentaire);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->rowCount();
    }

    public function DeleteCommentairesByArticle($id)
    {
        $query = $this->Conx_DataBase->prepare("DELETE FROM commentaires WHERE id_comment = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->rowCount();

    }


}