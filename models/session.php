<?php

class Session extends DB
{
    public $id;
    public $name;
    public $lastname;
    public $email;

    public function logindata($email, $pass, $table)
    {
        $query = "SELECT name,email,password FROM :table WHERE email = :email AND password = :password";
        $stmt = $this->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $pass, PDO::PARAM_STR);
        $stmt->bindParam(":table", $table, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function __construct()
    {
    }
}
