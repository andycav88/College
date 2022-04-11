<?php
class Administrator extends DB
{
    public $id;
    public $email;
    public $passwrod;


    public function __construct($email, $password)
    {

        $this->email = $email;
        $this->password = $password;
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
        $prepare = $this->prepare("SELECT FROM administrator WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchAll(PDO::FETCH_CLASS, Administrator::class);
        return $records;
    }

    public function findById($id)
    {

        //SQL SERVER      
        $prepare = $this->prepare("SELECT FROM administrator WHERE id=:id");
        $prepare->bindParam(":id", $this->$id, PDO::PARAM_STR);
        $prepare->execute();
        $records = $prepare->fetchAll(PDO::FETCH_CLASS, Administrator::class);
        return $records;
    }

    public function save()
    {

        if (empty($this->id)) {

            $prepare = $this->prepare("INSERT INTO administrator(email,password) OUTPUT INSERTED.id VALUES (:email,:password)");
            $prepare->bindParam(":email", $this->email, PDO::PARAM_STR);
            $prepare->bindParam(":password", $this->password, PDO::PARAM_STR);
            $prepare->execute();

            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        } else {

            $prepare = $this->prepare("UPDATE administrator SET email=:email , password=:password WHERE id=:id");
            $prepare->bindParam(":email", $this->email, PDO::PARAM_STR);
            $prepare->bindParam(":password", $this->password, PDO::PARAM_STR);
            $prepare->execute();
        }
    }


    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM administrator WHERE id=:id");
        $prepare->bindParam(":id", $this->id, PDO::PARAM_STR);
        $prepare->execute();
    }
}
