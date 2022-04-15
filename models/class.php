<?php
class Classe extends DB
{
    public $id;
    public $name;
    public $id_professor;
    public $id_level;


    /*  public function __construct($name, $id_professor, $id_level)
    {

        $this->name = $name;
        $this->id_professor = $id_professor;
        $this->id_level = $id_level;
    }*/

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $valor)
    {
        if (property_exists($this, $property)) {
            $this->$property = $valor;
        }
        return $this;
    }

    public function find()
    {

        //SQL SERVER      
        $prepare = $this->prepare("SELECT FROM class WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchObject(Classe::class);
        return $records;
    }

    public function findById($id)
    {

        //SQL SERVER      
        $prepare = $this->prepare("SELECT FROM class WHERE id=:id");
        $prepare->bindParam(":id", $this->$id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchAll(PDO::FETCH_CLASS, Classe::class);
        return $records;
    }

    public function save()
    {

        if (empty($this->id)) {

            $prepare = $this->prepare("INSERT INTO class(name,id_professor,id_level) OUTPUT INSERTED.id VALUES (:name,:id_professor,:id_level)");
            $prepare->bindParam(":name", $this->name, PDO::PARAM_STR);
            $prepare->bindParam(":id_professor", $this->id_professor, PDO::PARAM_STR);
            $prepare->bindParam(":id_level", $this->id_level, PDO::PARAM_STR);
            $prepare->execute();

            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        } else {

            $prepare = $this->prepare("UPDATE class SET name=:name , id_professor=:id_professor , id_level=:id_level  WHERE id=:id");
            $prepare->bindParam(":name", $this->name, PDO::PARAM_STR);
            $prepare->bindParam(":id_professor", $this->id_professor, PDO::PARAM_STR);
            $prepare->bindParam(":id_level", $this->id_level, PDO::PARAM_STR);
            $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
            $prepare->execute();
        }
    }


    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM class WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
    }
}
