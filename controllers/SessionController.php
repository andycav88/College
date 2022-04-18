<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'dist/phpmailer/Exception.php';
require 'dist/phpmailer/PHPMailer.php';
require 'dist/phpmailer/SMTP.php';

//Load Composer's autoloader
//require 'vendor/autoload.php';
class sessionController
{
    public function index()
    {
        //$pass = md5($_POST["inputPassword"]);
        view("homepage", "");
    }
    public function password()
    {
        view("password", "");
    }
    public function register()
    {
        view("register", "");
    }
    public function passwordreset($key)
    {
        view("passwordreset", "$key");
    }
    public function login()
    {
        try {
            session_start();

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

    public function passrecovery()
    {
        if (isset($_POST["email"]) && $_POST["email"] != "" && $_POST["email"] != NULL) {

            $query = "SELECT id, name, lastname, email, password FROM 
                      (SELECT id, name, lastname, email, password FROM student UNION SELECT id, name, lastname, email, password FROM professor ) AS tableresult 
                      WHERE tableresult.email LIKE :email";
            $conn = new DB();
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $key = $result["id"] . "-" . $result["password"];
                $key = $this->encode($key);
                $a = 3; //eliminar esta linea
                return $this->sendmail($result["email"], $result["name"] . " " . $result["lastname"], $key);
            } else {
                echo json_encode("false");
                return;
            }
        }
        echo json_encode("false");
        return;
    }
    protected function sendmail($address, $name, $key)
    {
        try {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = 0;                                       //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'andycav88@gmail.com';                  //SMTP username
            $mail->Password   = 'D@ndy2617';                            //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('andycav88@gmail.com', 'Admin');
            $mail->addAddress($address, 'USUARIO');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'College Account Recovery Link';
            $mail->Body    = '<!DOCTYPE html>
                                <body>
                                Hello, ' . $name . '.</br>
                                <li>Please use the following link to complete password reset:</br>
                                http://localhost/college/session/passwordreset/' . $key . '/   </br></br></li>
                                If you did not ask for, dont follow this link.</b> 
                                We recommend changing your password on other non-College websites if you use the same password.
                                If you have additional questions about account security, please visit http://localhost/dashboard/.
                                Thanks for visiting US!</b>
                                </body>
                                </html>';
            $mail->send();
            echo json_encode('true');
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo json_encode('false');;
        }
    }
    public function setpassword($encodekey)
    {

        if (isset($encodekey) && $encodekey != "" && isset($_POST["pass"]) && $_POST["pass"] != "") {
            $newPass = $_POST["pass"];
            $decodedKey = $this->decode($encodekey);

            $param = explode("-", $decodedKey);
            $id = $param[0];
            $oldpass = $param[1];

            $query = "SELECT id, password FROM 
                      (SELECT id, password FROM student UNION SELECT id, password FROM professor ) AS tableresult 
                      WHERE tableresult.id LIKE :id";
            $conn = new DB();
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && $result['password'] == $oldpass) {

                $conn = new DB();
                $query = "UPDATE student SET password = :newPass WHERE id=:id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":id", $id, PDO::PARAM_STR);
                $stmt->bindParam(":newPass", $newPass, PDO::PARAM_STR);
                $stmt->execute();

                $query = "UPDATE professor SET password = :newPass WHERE id=:id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":id", $id, PDO::PARAM_STR);
                $stmt->bindParam(":newPass", $newPass, PDO::PARAM_STR);
                $stmt->execute();

                echo json_encode("true");
            }
        }
        echo json_encode("false");
    }
    protected function encode($data)
    {
        $result = $data;
        $arrayLetters = array('C', 'A', 'R', 'X', 'O', 'S');
        $limit = count($arrayLetters) - 1;
        $num = mt_rand(0, $limit);
        for ($i = 1; $i <= $num; $i++) {
            $result = base64_encode($result);
        }
        $result = $result . '+' . $result[$num];
        $result = base64_encode($result);
        return $result;
    }
    protected function decode($data)
    {
        $result = base64_decode($data);
        list($result, $letter) = explode('+', $result);
        $arrayLetters = array('C', 'A', 'R', 'X', 'O', 'S');
        for ($i = 0; $i < count($arrayLetters); $i++) {
            if ($arrayLetters[$i] == $letter) {
                for ($j = 1; $j <= $i; $j++) {
                    $result = base64_decode($result);
                }
                break;
            }
        }
        return $result;
    }
}
