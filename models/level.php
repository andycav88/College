<?php
class Level extends DB
{
    public $id;
    public $level;
    public $course;
    public $classroom;



    /* public function __construct($level, $course, $classroom)
    {

        $this->level = $level;
        $this->course = $course;
        $this->classrom = $classroom;
    }
*/
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
        $prepare = $this->prepare("SELECT FROM level WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchObject(Student::class);
        return $records;
    }

    public static function findbyid($id)
    {
        //SQL SERVER 
        $level = new Level();
        $prepare = $level->prepare("SELECT * FROM level WHERE id=:id");
        $prepare->bindParam(":id", $id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetch(PDO::FETCH_CLASS, Level::class);
        return $records;
    }

    public function save()
    {

        if (empty($this->id)) {

            $prepare = $this->prepare("INSERT INTO level(level,course,classroom) OUTPUT INSERTED.id VALUES (:level,:course,:classroom)");
            $prepare->bindParam(":level", $this->level, PDO::PARAM_STR);
            $prepare->bindParam(":course", $this->course, PDO::PARAM_STR);
            $prepare->bindParam(":classroom", $this->classroom, PDO::PARAM_STR);
            $prepare->execute();

            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        } else {

            $prepare = $this->prepare("UPDATE level SET level=:level , course=:course , classroom=:classroom WHERE id=:id");
            $prepare->bindParam(":level", $this->level, PDO::PARAM_STR);
            $prepare->bindParam(":course", $this->course, PDO::PARAM_STR);
            $prepare->bindParam(":classroom", $this->classroom, PDO::PARAM_STR);
            $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
            $prepare->execute();
        }
    }


    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM level WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
    }
}
