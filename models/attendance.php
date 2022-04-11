<?php
class Attendance extends DB
{

    public $id;
    public $date;
    public $justified;
    public $id_class;
    public $id_student;

 /*   public function __construct($date, $justified, $id_class, $id_student)
    {

        $this->date = $date;
        $this->justified = $justified;
        $this->id_class = $id_class;
        $this->id_student = $id_student;
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
        $prepare = $this->prepare("SELECT FROM attendance WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchObject(Student::class);
        return $records;
    }

    public function findById($id)
    {

        //SQL SERVER      
        $prepare = $this->prepare("SELECT FROM attendance WHERE id=:id");
        $prepare->bindParam(":id", $this->$id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchAll(PDO::FETCH_CLASS, Attendance::class);
        return $records;
    }

    public function save()
    {

        if (empty($this->id)) {

            $prepare = $this->prepare("INSERT INTO attendance(date,justified,id_class,id_student) OUTPUT INSERTED.id VALUES (:date,:justified,:id_class,:id_student)");
            $prepare->bindParam(":date", $this->date, PDO::PARAM_STR);
            $prepare->bindParam(":justified", $this->justified, PDO::PARAM_STR);
            $prepare->bindParam(":id_class", $this->id_class, PDO::PARAM_STR);
            $prepare->bindParam(":id_student", $this->id_student, PDO::PARAM_STR);
            $prepare->execute();

            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        } else {

            $prepare = $this->prepare("UPDATE attendance SET date=:date , justified=:justified , id_class=:id_class, id_student=:id_student WHERE id=:id");
            $prepare->bindParam(":date", $this->date, PDO::PARAM_STR);
            $prepare->bindParam(":justified", $this->justified, PDO::PARAM_STR);
            $prepare->bindParam(":id_class", $this->id_class, PDO::PARAM_STR);
            $prepare->bindParam(":id_student", $this->id_student, PDO::PARAM_STR);
            $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
            $prepare->execute();
        }
    }


    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM attendance WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
    }
}
