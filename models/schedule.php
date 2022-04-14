<?php
class Schedule extends DB
{
    public $id;
    public $day;
    public $star;
    public $end;
    public $id_class;

    public function __construct($day, $star, $end, $id_class)
    {
        $this->day = $day;
        $this->star = $star;
        $this->end = $end;
        $this->id_class = $id_class;
    }

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
        $prepare = $this->prepare("SELECT FROM schedule WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchAll(PDO::FETCH_CLASS, Schedule::class);
        return $records;
    }

    public function findById($id)
    {
        //SQL SERVER      
        $prepare = $this->prepare("SELECT FROM schedule WHERE id=:id");
        $prepare->bindParam(":id", $this->$id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchAll(PDO::FETCH_CLASS, Administrator::class);
        return $records;
    }

    public function save()
    {
        if (empty($this->id)) {

            $prepare = $this->prepare("INSERT INTO schedule(day,star,end,id_class) OUTPUT INSERTED.id VALUES (:day,:star,:end,:id_clas)");
            $prepare->bindParam(":day", $this->day, PDO::PARAM_STR);
            $prepare->bindParam(":star", $this->star, PDO::PARAM_STR);
            $prepare->bindParam(":end", $this->end, PDO::PARAM_STR);
            $prepare->bindParam(":id_class", $this->id_class, PDO::PARAM_STR);
            $prepare->execute();

            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        } else {

            $prepare = $this->prepare("UPDATE schedule SET day=:day , star=:star , end=:end, id_class=:id_class WHERE id=:id");
            $prepare->bindParam(":day", $this->day, PDO::PARAM_STR);
            $prepare->bindParam(":star", $this->star, PDO::PARAM_STR);
            $prepare->bindParam(":end", $this->end, PDO::PARAM_STR);
            $prepare->bindParam(":id_class", $this->id_class, PDO::PARAM_STR);
            $prepare->execute();
        }
    }


    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM schedule WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
    }
}
