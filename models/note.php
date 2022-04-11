<?php
class Note extends DB
{
    public $id;
    public $note;
    public $trimester;
    public $student_id;
    public $class_id;


  /*  public function __construct($note, $trimester, $student_id, $class_id)
    {

        $this->note = $note;
        $this->trimester = $trimester;
        $this->student_id = $student_id;
        $this->class_id = $class_id;
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
        $prepare = $this->prepare("SELECT FROM note WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchObject(Student::class);
        return $records;
    }

    public function findById($id)
    {

        //SQL SERVER      
        $prepare = $this->prepare("SELECT FROM note WHERE id=:id");
        $prepare->bindParam(":id", $this->$id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchAll(PDO::FETCH_CLASS, Note::class);
        return $records;
    }

    public function save()
    {

        if (empty($this->id)) {

            $prepare = $this->prepare("INSERT INTO note(note,trimester,student_id,class_id) OUTPUT INSERTED.id VALUES (:note,:trimester,:student_id,:class_id)");
            $prepare->bindParam(":note", $this->note, PDO::PARAM_STR);
            $prepare->bindParam(":trimester", $this->trimester, PDO::PARAM_STR);
            $prepare->bindParam(":student_id", $this->student_id, PDO::PARAM_STR);
            $prepare->bindParam(":class_id", $this->class_id, PDO::PARAM_STR);
            $prepare->execute();

            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        } else {

            $prepare = $this->prepare("UPDATE note SET note=:note , trimester=:trimester , student_id=:student_id, class_id=:class_id WHERE id=:id");
            $prepare->bindParam(":note", $this->note, PDO::PARAM_STR);
            $prepare->bindParam(":trimester", $this->trimester, PDO::PARAM_STR);
            $prepare->bindParam(":student_id", $this->student_id, PDO::PARAM_STR);
            $prepare->bindParam(":class_id", $this->class_id, PDO::PARAM_STR);
            $prepare->execute();
        }
    }


    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM note WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
    }
}
