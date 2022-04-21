<?php
class Professor extends DB
{
    public $id;
    public $specialist;
    public $name;
    public $lastname;
    public $email;
    public $password;

    public static function all()
    {

        //SQL SERVER

        $conn = new DB();
        $query = "SELECT * FROM professor";
        $data = $conn->query($query);
        $records = $data->fetchAll(PDO::FETCH_CLASS, Professor::class);
        return $records;
    }


    public function getByRange($findByname, $findBylast, $findByemail, $offset, $cantrows)
    {
        $conn = new DB();
        $query = "SELECT * FROM professor WHERE name LIKE '%$findByname%' AND lastname LIKE'%$findBylast%'AND 
        email LIKE '%$findByemail%'  ORDER BY id OFFSET $offset ROWS FETCH NEXT $cantrows ROWS ONLY";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countProfessor($findByname, $findBylast, $findByemail)
    {
        $conn = new DB();
        $query = "SELECT COUNT(*) total FROM professor WHERE name LIKE '%$findByname%' AND lastname LIKE'%$findBylast%'AND 
        email LIKE '%$findByemail%'";
        $prepare = $conn->query($query);
        $prepare->execute();

        $row = $prepare->fetch(PDO::FETCH_ASSOC);

        return $row;
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
        $prepare = $this->prepare("SELECT * FROM professor WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchObject(Professor::class);
        return $records;
    }

    public function findById($id)
    {
        //SQL SERVER      
        $prepare = $this->prepare("SELECT * FROM professor WHERE id=$id");
        $prepare->execute();
        $records =  $prepare->fetchObject(Professor::class);
        return $records;
    }

    public function save()
    {

        if (empty($this->id)) {

            $prepare = $this->prepare("INSERT INTO professor(specialist,name,lastname,email,password) OUTPUT INSERTED.id VALUES(:specialist,:name,:lastname,:email,:password)");
            $prepare->bindParam(":specialist", $this->specialist, PDO::PARAM_STR);
            $prepare->bindParam(":name", $this->name, PDO::PARAM_STR);
            $prepare->bindParam(":lastname", $this->lastname, PDO::PARAM_STR);
            $prepare->bindParam(":email", $this->email, PDO::PARAM_STR);
            $prepare->bindParam(":password", $this->password, PDO::PARAM_STR);
            $prepare->execute();
            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            $id = $result['id'];
            return $id;
        } else {

            $prepare = $this->prepare("UPDATE professor SET specialist=:specialist,name=:name, lastname=:lastname, email=:email , password=:password WHERE id=:id");
            $prepare->bindParam(":specialist", $this->specialist, PDO::PARAM_STR);
            $prepare->bindParam(":name", $this->name, PDO::PARAM_STR);
            $prepare->bindParam(":lastname", $this->lastname, PDO::PARAM_STR);
            $prepare->bindParam(":email", $this->email, PDO::PARAM_STR);
            $prepare->bindParam(":password", $this->password, PDO::PARAM_STR);
            $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
            $prepare->execute();
        }
    }


    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM professor WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
    }
}
