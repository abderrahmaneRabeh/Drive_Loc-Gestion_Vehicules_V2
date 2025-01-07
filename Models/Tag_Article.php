<?php

require_once 'Database.php';

class Tag_Article extends Database
{
    private $Conx_DataBase;
    public function __construct()
    {
        $this->Conx_DataBase = $this->connect_Db();
    }

    public function Ajouter_Tag_Article($article_id, $tag_id)
    {
        $query = $this->Conx_DataBase->prepare("INSERT INTO `tag_article`(`article_id`, `tag_id`) VALUES (:article_id, :tag_id)");
        $query->bindParam(':article_id', $article_id);
        $query->bindParam(':tag_id', $tag_id);
        $query->execute();
        return $query->rowCount();
    }

}