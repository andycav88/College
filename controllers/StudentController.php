<?php

class StudentController
{

    public function index()
    { {
            session_start();
            if (!$_SESSION['active']) {
                header("Location:http://" . $_SERVER['SERVER_NAME'] . "/college/");
                return;
            }
            $student = Student::all();
            view("listStudent", $student);
        }
    }

    public function create()
    {

        if (
            isset($_POST['name']) && $_POST['name'] && isset($_POST['lastname']) && $_POST['lastname'] &&
            isset($_POST['email']) && $_POST['email'] && isset($_POST['password']) && $_POST['password'] &&
            isset($_POST['id_level']) && $_POST['id_level']
        ) {
            $student = new Student();
            $student->name = $_POST['name'];
            $student->lastname = $_POST['lastname'];
            $student->email = $_POST['email'];
            $student->password = $_POST['password'];
            $student->id_level = $_POST['id_level'];
            $insertedID = $student->save();
            $student->id = $insertedID;
            echo json_encode($student);
        }
    }

    public function update()
    {
        if (
            isset($_POST['name']) && $_POST['name'] && isset($_POST['lastname']) && $_POST['lastname'] &&
            isset($_POST['email']) && $_POST['email'] && isset($_POST['password']) && $_POST['password'] &&
            isset($_POST['id_level']) && $_POST['id_level']
        ) {
            $student = new Student();
            $student->id = $_POST['id'];
            $student = $student->find();
            $student->name = $_POST['name'];
            $student->lastname = $_POST['lastname'];
            $student->email = $_POST['email'];
            $student->password = $_POST['password'];
            $student->id_level = $_POST['id_level'];
            $student->save();

            echo json_encode($student);
        }
    }

    public function delete()
    {
        //  try{
        $student = new Student();
        $student = $student->find($_POST['id']);
        $student->remove();
        //  echo json_encode(['status' => true]);
        // }catch(\Exception $e){
        //echo json_encode(['status' => false]);

        //  }

    }
    //PAGINADO
    public function pagstudent()
    {
        $jsondata = array();

        if ($_POST['param1'] == "cuantos") {

            $jsondata = Student::countStudents();
        } elseif ($_POST["param1"] == "dame") {
            $limit = $_POST['limit'];
            $offset = $_POST['offset'];
            $jsondata = Student::getByRange($offset, $limit);
        }
        echo json_encode($jsondata);
        exit();
    }
}
