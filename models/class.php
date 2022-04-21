<?php
class class1 extends DB
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

    public static function limite($nameC, $newstart, $end)
    {
        if ($newstart != '' && $end != '') {
            $query = "SELECT * FROM class WHERE name LIKE '%$nameC%' ORDER BY id 
        OFFSET $newstart ROWS FETCH NEXT $end ROWS ONLY;";
        } else {
            $query = "SELECT * FROM class";
        }
        $conn = new DB();
        $data = $conn->query($query);
        $records = $data->fetchAll(PDO::FETCH_CLASS, class1::class);
        return $records;
    }

    public static function allValor($nameC)
    {
        $query = "SELECT * FROM class WHERE name LIKE '%$nameC%' ORDER BY id;";
        $conn = new DB();
        $data = $conn->query($query);
        $records = $data->fetchAll(PDO::FETCH_CLASS, class1::class);
        return $records;
    }


    public function find()
    {

        //SQL SERVER      
        $prepare = $this->prepare("SELECT * FROM class WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchObject(class1::class);
        return $records;
    }

    public function findById($id)
    {

        //SQL SERVER      
        $prepare = $this->prepare("SELECT * FROM class WHERE id=:id");
        $prepare->bindParam(":id", $this->$id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchAll(PDO::FETCH_CLASS, class1::class);
        return $records;
    }

    public function save()
    {

        if (empty($this->id)) {

            $prepare = $this->prepare("INSERT INTO class(name) OUTPUT INSERTED.id VALUES (:name)");
            $prepare->bindParam(":name", $this->name, PDO::PARAM_STR);
            $prepare->execute();

            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        } else {

            $prepare = $this->prepare("UPDATE class SET name=:name WHERE id=:id");
            $prepare->bindParam(":name", $this->name, PDO::PARAM_STR);
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

    public function getbyprofid($profId)
    {
        $prepare = $this->prepare("SELECT * FROM class WHERE id_professor=:id");
        $prepare->bindParam(":id", $profId, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }
}
