<?php

class ClassController
{   
    public function index()
    {
        include_once "views/index.php";
        $class = new Classe();
        $class->name = "SIRVE";
        $class->id_professor = 8;
        $class->id_level = 1;
        $class->id = 2;
        $class->remove();
        echo $class;
    }
  
       public function create()
    {
    
        if(isset($_POST['name']) && $_POST['name'] && isset($_POST['id_professor']) && $_POST['id_professor'] &&
        isset($_POST['id_level']) && $_POST['id_level']){
            $class = new Classe();
            $class->name = $_POST['name'];
            $class->id_professor = $_POST['id_professor'];
            $class->id_level = $_POST['id_level'];
            $insertedID = $class->save();
            $class->id = $insertedID;
            echo json_encode($class);
       }
    }

      public function update()
      {
        if(isset($_POST['name']) && $_POST['name'] && isset($_POST['id_professor']) && $_POST['id_professor'] &&
        isset($_POST['id_level']) && $_POST['id_level']){
            $class = new Classe();
            $class->id =$_POST['id'];
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
      //  try{
       $class = new Classe();
       $class = $class->find($_POST['id']);
       $class->remove();
     //  echo json_encode(['status' => true]);
       // }catch(\Exception $e){
       //echo json_encode(['status' => false]);

      //  }

    }
}
