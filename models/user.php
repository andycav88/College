<?php
class User extends DB
{

    public $email;
    public $password;

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
}
