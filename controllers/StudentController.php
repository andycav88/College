<?php

class StudentController
{   
    public function index()
    {
        include_once "views/index.php";
     /*   $student = new Student();
        $student->name = "JUAN";
        $student->lastname = "salgado Herrera";
        $student->password = "admin";
        $student->email = "juan@gmail.com";
        $student->id_level = 1;
     //   $student->id = 1;
        $student->remove();
        echo $studen;*/
    }
  
       public function create()
    {
    
        if(isset($_POST['name']) && $_POST['name'] && isset($_POST['lastname']) && $_POST['lastname'] &&
        isset($_POST['email']) && $_POST['email'] && isset($_POST['password']) && $_POST['password' ]&&
        isset($_POST['id_level']) && $_POST['id_level']){
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
        if(isset($_POST['name']) && $_POST['name'] && isset($_POST['lastname']) && $_POST['lastname'] &&
        isset($_POST['email']) && $_POST['email'] && isset($_POST['password']) && $_POST['password' ]&&
        isset($_POST['id_level']) && $_POST['id_level']){
            $student = new Student();
            $student->id =$_POST['id'];
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
}



?>