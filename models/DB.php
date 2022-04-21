<?php
class DB extends PDO
{
    public function __construct()
    {
        $dbuser = "sa";
        $userpass = "sqlserver";
        $dsn = "sqlsrv:Server=localhost;Database=collegedb";
        parent::__construct($dsn, $dbuser, $userpass);
    }
}
