<?php

class ProfessorController
{
     public function index(){
        
        view("listProfessor","");


     }

    public function pagination()
    {   
        $start = $_POST['start'];
        $end = $_POST['end'];
        $nameP = $_POST['nameP'];
        $emailP = $_POST['emailP'];
        $newstart = ($start -1)* $end;
        $allprofe = Professor::limite('','','','');
        $allnameP = Professor::allValor($nameP, $emailP);
        $professor = Professor::limite($nameP,$emailP,$newstart,$end);
        if($nameP == "%"){
            $cant = count($allprofe);
        }
        else{
            $cant = count($allnameP);
        }
    
        echo json_encode($professor)."*".$cant;
    }


    public function search(){
        
        $professor = new Professor();
        $professor->id = $_POST['id'];
        $results = $professor->find();
        echo json_encode($results);

    }

    public function create()
    {
        if (
            isset($_POST['specialist']) && $_POST['specialist'] && isset($_POST['name']) && $_POST['name'] &&
            isset($_POST['lastname']) && $_POST['lastname'] && isset($_POST['email']) && $_POST['email'] &&
            isset($_POST['password']) && $_POST['password']
        ) {
            $professor = new Professor();
            $id = $_POST['id'];
            $professor->id = $_POST['id'];
            $professor->specialist = $_POST['specialist'];
            $professor->name = $_POST['name'];
            $professor->lastname = $_POST['lastname'];
            $professor->email = $_POST['email'];
            $professor->password = $_POST['password'];
            if($id == "" || $id == null){
                $insertedID = $professor->save();
                $professor->id = $insertedID;
                $results = $professor;
            }else{
                $professor->save();
                $results = $professor; 
            }
            echo json_encode($results);
            
        }
    }

    public function update()
    {
        if (
            isset($_POST['specialist']) && $_POST['specialist'] && isset($_POST['name']) && $_POST['name'] &&
            isset($_POST['lastname']) && $_POST['lastname'] && isset($_POST['email']) && $_POST['email'] &&
            isset($_POST['password']) && $_POST['password']
        ) {
            $professor = new Professor();
            $professor->id = $_POST['id'];
            $professor = $professor->find();
            $professor->specialist = $_POST['specialist'];
            $professor->name = $_POST['name'];
            $professor->lastname = $_POST['lastname'];
            $professor->email = $_POST['email'];
            $professor->password = $_POST['password'];
            $professor->save();

            echo json_encode($professor);
        }
    }

    public function delete()
    {
        try {
            $professor = new Professor();
            $professor = $professor->findById($_POST['id']);
            $professor->remove();
            echo json_encode(true);
        } catch (\Exception $e) {
            echo json_encode(false);
        }
    }
}
