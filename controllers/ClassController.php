<?php

class ClassController
{
    public function index()
    {

        view("listClass", "");
    }

    public function pagination()
    {
        $start = $_POST['start'];
        $end = $_POST['end'];
        $nameC = $_POST['nameC'];
        $newstart = ($start - 1) * $end;
        $allclass = class1::limite('', '', '');
        $allnameC = class1::allValor($nameC);
        $class = class1::limite($nameC, $newstart, $end);
        if ($nameC == "%") {
            $cant = count($allnameC);
        } else {
            $cant = count($allclass);
        }

        echo json_encode($class) . "*" . $cant;
    }

    public function search()
    {

        $class = new class1();
        $class->id = $_POST['id'];
        $results = $class->find();
        echo json_encode($results);
    }

    public function create()
    {
        if (
            isset($_POST['name']) && $_POST['name']
        ) {
            $class = new Class1();
            $id = $_POST['id'];
            $class->id = $_POST['id'];
            $class->name = $_POST['name'];
            if ($id == "" || $id == null) {
                $insertedID = $class->save();
                $class->id = $insertedID;
                $results = $class;
            } else {
                $class->save();
                $results = $class;
            }
            echo json_encode($results);
        }
    }


    public function update()
    {
        if (
            isset($_POST['name']) && $_POST['name'] && isset($_POST['id_professor']) && $_POST['id_professor'] &&
            isset($_POST['id_level']) && $_POST['id_level']
        ) {
            $class = new Class1();
            $class->id = $_POST['id'];
            $class = $class->find();
            $class->name = $_POST['name'];
            $class->id_professor = $_POST['id_professor'];
            $class->id_level = $_POST['id_level'];
            $class->save();

            echo json_encode($class);
        }
    }

    public function delete()
    {
        try {
            $class = new class1();
            $class->id = $_POST['id'];
            $class->remove();
            echo json_encode(true);
        } catch (\Exception $e) {
            echo json_encode(false);
        }
    }




    /* Metodos NUEVOS */

    public function searchbyprofid()
    {
        if (isset($_POST['idProf'])) {
            $class = new class1();
            $result = $class->getbyprofid($_POST['idProf']);
        }
        echo json_encode($result);
        return;
    }
}
