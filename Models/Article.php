<?php

require_once 'Database.php';

class Article extends Database
{
    private $Conx_DataBase;
    public function __construct()
    {
        $this->Conx_DataBase = $this->connect_Db();
    }


    public function Ajouter_Article($image_article, $title_article, $active_article, $video_article, $theme_id, $utilisateur_id)
    {

        $query = $this->Conx_DataBase->prepare("INSERT INTO `articles`(`article_title`, `active_article`, `image_article`, `video_article`, `id_theme`, `utilisateur_id`)
                                                                    VALUES (:article_title, :active_article, :image_article, :video_article, :theme_id, :utilisateur_id)");

        $query->bindParam(':article_title', $title_article);
        $query->bindParam(':active_article', $active_article);
        $query->bindParam(':image_article', $image_article);
        $query->bindParam(':video_article', $video_article);
        $query->bindParam(':theme_id', $theme_id);
        $query->bindParam(':utilisateur_id', $utilisateur_id);
        $query->execute();
        return $query->rowCount();
    }
}