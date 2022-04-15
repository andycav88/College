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
        try {
            session_start();
            $log = [];
            $userLogged = ""; //Tipo de usuario logueado (admin, studen o profesor)

            if (!empty($_SESSION['active'])) {
                header("Location: session/index");
            }

            if (isset($_POST["email"]) && isset($_POST["pass"])) { //verificamos que no este vacio las variables que mandamos por el POST
                $email = $_POST["email"];
                $pass = $_POST["pass"];

                if (!empty($email) && $email != "" && !empty($pass) && $pass != "") { //verificamos los campos
                    $query = "SELECT email,password FROM administrator WHERE email = :email AND password = :password";
                    $result = $this->login_query($query, $email, $pass);
                    if ($result) {
                        //Aquí creamos sesion ANDMIN
                        $userLogged = "admin";
                    } else {
                        $query = "SELECT name,email,password FROM student WHERE email = :email AND password = :password";
                        $result = $this->login_query($query, $email, $pass);
                        if ($result) {
                            //Aquí creamos sesion STUDENT
                            $userLogged = "student";
                        } else {
                            $query = "SELECT name,email,password FROM professor WHERE email = :email AND password = :password";
                            $result = $this->login_query($query, $email, $pass);
                            if ($result) {
                                //Aquí creamos sesion PROFESSOR
                                $userLogged = "professor";
                            } else {
                                echo json_encode("false");
                                return;
                            }
                        }
                    }
                    $_SESSION['active'] = true;
                    $_SESSION['user'] = $userLogged;
                    $_SESSION['email'] = $result['email'];
                    $_SESSION['name'] = ($userLogged == "admin" ?  "Admin" : $result['name']);

                    echo json_encode("true");
                    return;
                }
            }
            echo json_encode("false");
            return;
        } catch (\Exception $ex) {
            echo 'Exception catched: ',  $ex->getMessage();
        }
    }
    protected function login_query($query, $email, $pass)
    {
        // $query = "SELECT email,password FROM administrator WHERE email = :email AND password = :password";
        $conn = new DB();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $pass, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
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
