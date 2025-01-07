<?php

require_once 'Database.php';

class Article extends Database
{
    private $Conx_DataBase;
    public function __construct()
    {
        $this->Conx_DataBase = $this->connect_Db();
    }

    public function All_Articles()
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM articles, themes, utilisateurs WHERE articles.id_theme = themes.id_theme AND articles.utilisateur_id = utilisateurs.id_utilisateur");
        $query->execute();
        $listArticles = $query->fetchAll();
        return $listArticles;
    }

    public function get_One_Article($id)
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM articles join themes on articles.id_theme = themes.id_theme join utilisateurs on articles.utilisateur_id = utilisateurs.id_utilisateur WHERE id_article = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $article = $query->fetch();
        return $article;
    }

    public function get_Articles_tags($id)
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM tag_article join tags on tag_article.id_tag = tags.id_tag WHERE id_article = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $tags = $query->fetchAll();
        return $tags;
    }


    public function Ajouter_Article($image_article, $title_article, $video_article, $theme_id, $utilisateur_id, $article_description)
    {
        $query = $this->Conx_DataBase->prepare("INSERT INTO `articles`(`article_title`, `image_article`, `video_article`, `id_theme`, `utilisateur_id`,`article_description`)
                                                                    VALUES (:article_title, :image_article, :video_article, :theme_id, :utilisateur_id,:article_description)");
        $query->bindParam(':article_title', $title_article);
        $query->bindParam(':image_article', $image_article);
        $query->bindParam(':video_article', $video_article);
        $query->bindParam(':theme_id', $theme_id);
        $query->bindParam(':utilisateur_id', $utilisateur_id);
        $query->bindParam(':article_description', $article_description);
        $query->execute();
        return $this->Conx_DataBase->lastInsertId();
    }

    public function Ajouter_Tag_Article($article_id, $tag_id)
    {
        $query = $this->Conx_DataBase->prepare("INSERT INTO `tag_article`(`id_article`, `id_tag`) VALUES (:article_id, :tag_id)");
        $query->bindParam(':article_id', $article_id);
        $query->bindParam(':tag_id', $tag_id);
        $query->execute();
        return $query->rowCount();
    }
}