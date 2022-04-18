<?php
class DB extends PDO
{
    public function __construct()
    {
        $dbuser = "sa";
        $userpass = "asd123";
        $dsn = "sqlsrv:Server=DESKTOP-TF3KUJR;Database=collegedb";
        parent::__construct($dsn, $dbuser, $userpass);
    }
}
