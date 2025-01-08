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

    public function AjouterTheme($theme)
    {
        $query = $this->Conx_DataBase->prepare("INSERT INTO themes (theme_name) VALUES (:theme)");
        $query->bindValue(':theme', $theme);
        $query->execute();
        return $query->rowCount();
    }

    public function DeleteTheme($id)
    {
        $query = $this->Conx_DataBase->prepare("DELETE FROM themes WHERE id_theme = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->rowCount();
    }

    public function ModifierTheme($id, $theme_name)
    {
        $query = $this->Conx_DataBase->prepare("UPDATE themes SET theme_name = :theme_name WHERE id_theme = :id");
        $query->bindValue(':id', $id);
        $query->bindValue(':theme_name', $theme_name);
        $query->execute();
        return $query->rowCount();
    }

    public function getThemeById($id)
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM themes WHERE id_theme = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $theme = $query->fetch();
        return $theme;
    }
}