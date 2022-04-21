<?php

class LevelController
{
    public function index()
    {
        // view("", "");
        // $level = new Level();
        // $level->level = "PRE-UNIV";
        // $level->course = "2";
        // $level->classroom = "456";
        // $level->id = 1;
        // //  $level->save();
        // $level->remove();
        // echo $level;
        view("listClass", "");
    }

    public function create()
    {

        if (
            isset($_POST['level']) && $_POST['level'] && isset($_POST['course']) && $_POST['course'] &&
            isset($_POST['classromm']) && $_POST['classroom']
        ) {
            $level = new Level();
            $level->level = $_POST['level'];
            $level->course = $_POST['course'];
            $level->classrom = $_POST['classroom'];
            $insertedID = $level->save();
            $level->id = $insertedID;
            echo json_encode($level);
        }
    }

    public function update()
    {
        if (
            isset($_POST['level']) && $_POST['level'] && isset($_POST['course']) && $_POST['course'] &&
            isset($_POST['classromm']) && $_POST['classroom']
        ) {
            $level = new Level();
            $level->id = $_POST['id'];
            $level = $level->find();
            $level->level = $_POST['level'];
            $level->course = $_POST['course'];
            $level->classrom = $_POST['classroom'];
            $level->save();

            echo json_encode($level);
        }
    }

    public function delete()
    {
        //  try{
        $level = new Level();
        $level = $level->find($_POST['id']);
        $level->remove();
        //  echo json_encode(['status' => true]);
        // }catch(\Exception $e){
        //echo json_encode(['status' => false]);

        //  }

    }
    public function getlevelid()
    {

        if (isset($_POST['id'])) {

            $result = Level::findbyid($_POST['id']);
        }
        echo json_encode($result);
    }
}
