<?php
class Student extends DB
{
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $id_level;

    public static function all()
    {
        //SQL SERVER
        $conn = new DB();
        $query = "SELECT * FROM student";
        $data = $conn->query($query);
        $records = $data->fetchAll(PDO::FETCH_CLASS, Student::class);
        return $records;
    }
    /*  public function __construct($name, $lastname, $email, $password, $id_level)
    {

        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
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
        $prepare = $this->prepare("SELECT FROM student WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchObject(Student::class);
        return $records;
    }

    public function findById($id)
    {

        //SQL SERVER      
        $prepare = $this->prepare("SELECT FROM student WHERE id=:id");
        $prepare->bindParam(":id", $this->$id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchAll(PDO::FETCH_CLASS, Student::class);
        return $records;
    }

    public function save()
    {

        if (empty($this->id)) {
            $prepare = $this->prepare("INSERT INTO student(name,lastname,email,password,id_level) OUTPUT INSERTED.id VALUES (:name,:lastname,:email,:password,:id_level)");
            $prepare->bindParam(":name", $this->name, PDO::PARAM_STR);
            $prepare->bindParam(":lastname", $this->lastname, PDO::PARAM_STR);
            $prepare->bindParam(":email", $this->email, PDO::PARAM_STR);
            $prepare->bindParam(":password", $this->password, PDO::PARAM_STR);
            $prepare->bindParam(":id_level", $this->id_level, PDO::PARAM_STR);
            $prepare->execute();

            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        } else {
            $prepare = $this->prepare("UPDATE student SET name=:name, lastname=:lastname, email=:email , password=:password,id_level=:id_level WHERE id=:id");
            $prepare->bindParam(":name", $this->name, PDO::PARAM_STR);
            $prepare->bindParam(":lastname", $this->lastname, PDO::PARAM_STR);
            $prepare->bindParam(":email", $this->email, PDO::PARAM_STR);
            $prepare->bindParam(":password", $this->password, PDO::PARAM_STR);
            $prepare->bindParam(":id_level", $this->id_level, PDO::PARAM_STR);
            $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
            $prepare->execute();
        }
    }

    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM student WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
    }
    public function getByRange($offset, $cantrows)
    {
        $conn = new DB();
        $query = "SELECT id, name, lastname, email FROM student ORDER BY id OFFSET $offset ROWS FETCH NEXT $cantrows ROWS ONLY";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countStudents()
    {
        $conn = new DB();
        $query = "SELECT COUNT(*) total FROM student";
        $prepare = $conn->query($query);
        $prepare->execute();

        $row = $prepare->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
}
