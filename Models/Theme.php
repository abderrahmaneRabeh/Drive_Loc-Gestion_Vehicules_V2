<?php

class Theme
{
    private $Conx_DataBase;
    public function __construct($db)
    {
        $this->Conx_DataBase = $db;
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