<?php

require_once 'Database.php';

class Theme extends Database
{
    private $Conx_DataBase;
    public function __construct()
    {
        $this->Conx_DataBase = $this->connect_Db();
    }

    public function getThemes()
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM themes");
        $query->execute();
        $themes = $query->fetchAll();
        return $themes;
    }

    public function get_Tags()
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM tags");
        $query->execute();
        $tags = $query->fetchAll();
        return $tags;
    }

    public function getThemeArticles($id)
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM articles WHERE id_theme = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $articles = $query->fetchAll();
        return $articles;
    }
}