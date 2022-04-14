<?php

class sessionController
{
    public function index()
    {
        //$pass = md5($_POST["inputPassword"]);
        view("homepage", "");
    }
    public function login()
    {
        session_start();

        //Validamos si la sesión está activa

        //if(session_status() !== PHP_SESSION_ACTIVE) //Estas son la forma correcta de ver si no esta activa la sesion
        //if(session_status() === PHP_SESSION_NONE) session_start();
        if (!empty($_SESSION['active'])) {
            header("Location: session/index");
        }
        if (isset($_POST["email"]) && isset($_POST["pass"])) {
            $email = $_POST["email"];
            $pass = $_POST["pass"];


            if (!empty($email) && $email != "" && !empty($pass) && $pass != "") {
                $query = "SELECT email,password FROM administrator WHERE email = :email AND password = :password";
                $conn = new DB();
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                $stmt->bindParam(":password", $pass, PDO::PARAM_STR);
                $stmt->execute();

                $registro = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$registro) {
                    echo json_encode("false");
                    return;
                } else {
                    //Aquí creamos sesiones
                    $_SESSION['active'] = true;
                    //$_SESSION['cedula'] = $registro['cedula'];
                    $_SESSION['user'] = "admin";
                    $_SESSION['email'] = $registro['email'];
                    $_SESSION['name'] = "Admin";


                    //Despues de crear las sesiones
                    //Redirigir al panel.php
                    //header("Location:views/homepage.php");

                    echo json_encode("true");
                    return;
                }
            }
            echo json_encode("false");
            return;
        }
        echo json_encode("false");
    }
    public function logout()
    {
        session_start();
        session_unset();
        //  unset($_SESSION["nombre_usuario"]);
        //  unset($_SESSION["nombre_cliente"]);
        session_destroy();
        header("Location:http://localhost/college/");
        exit;
    }
}
