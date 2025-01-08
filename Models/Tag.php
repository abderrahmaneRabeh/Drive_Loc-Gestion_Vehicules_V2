<?php


class Tag
{

    private $Conx_DataBase;
    public function __construct($db)
    {
        $this->Conx_DataBase = $db;
    }


    public function get_Tags()
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM tags");
        $query->execute();
        $tags = $query->fetchAll();
        return $tags;
    }

    public function getOneTag($id)
    {
        $query = $this->Conx_DataBase->prepare("SELECT * FROM tags WHERE id_tag = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $tag = $query->fetch();
        return $tag;
    }

    public function Ajouter_Tag($tag)
    {
        $query = $this->Conx_DataBase->prepare("INSERT INTO tags (tag_name) VALUES (:tag)");
        $query->bindValue(':tag', $tag);
        $query->execute();
        return $query->rowCount();
    }

    public function DeleteTag($id)
    {
        $query = $this->Conx_DataBase->prepare("DELETE FROM tags WHERE id_tag = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->rowCount();
    }

    public function ModifierTag($id, $tag_name)
    {
        $query = $this->Conx_DataBase->prepare("UPDATE tags SET tag_name = :tag_name WHERE id_tag = :id");
        $query->bindValue(':id', $id);
        $query->bindValue(':tag_name', $tag_name);
        $query->execute();
        return $query->rowCount();
    }



}