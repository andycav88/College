<?php

class LevelController
{   
    public function index()
    {
        include_once "views/index.php";
        $level = new Level();
        $level->level = "PRE-UNIV";
        $level->course = "2";
        $level->classroom = "456";
        $level->id = 1;
      //  $level->save();
        $level->remove();
        echo $level;
    }
  
       public function create()
    {
    
        if(isset($_POST['level']) && $_POST['level'] && isset($_POST['course']) && $_POST['course'] &&
        isset($_POST['classromm']) && $_POST['classroom']){
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
        if(isset($_POST['level']) && $_POST['level'] && isset($_POST['course']) && $_POST['course'] &&
        isset($_POST['classromm']) && $_POST['classroom']){
            $level = new Level();
            $level->id =$_POST['id'];
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
       $level = new Student();
       $level = $level->find($_POST['id']);
       $level->remove();
     //  echo json_encode(['status' => true]);
       // }catch(\Exception $e){
       //echo json_encode(['status' => false]);

      //  }

    }
}



?>