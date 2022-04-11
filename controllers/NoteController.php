<?php

class NoteController
{   
    public function index()
    {
        include_once "views/index.php";
        $note = new Note();
        $note->note = 12;
        $note->trimester = 1;
        $note->student_id = 2;
        $note->class_id = 1;
     //   $note->id = 1
        $note->save();
      //  $note->remove();
        echo $note;
    }
  
       public function create()
    {
    
        if(isset($_POST['note']) && $_POST['note'] && isset($_POST['trimester']) && $_POST['trimester'] &&
        isset($_POST['student_id']) && $_POST['student_id'] && isset($_POST['class_id']) && $_POST['class_id']){
            $note = new Note();
            $note->note = $_POST['note'];
            $note->trimester = $_POST['trimester'];
            $note->student_id = $_POST['student_id'];
            $note->class_id = $_POST['class_id'];
            $insertedID = $note->save();
            $note->id = $insertedID;
            echo json_encode($note);
       }
    }

      public function update()
      {
        if(isset($_POST['note']) && $_POST['note'] && isset($_POST['trimester']) && $_POST['trimester'] &&
        isset($_POST['student_id']) && $_POST['student_id'] && isset($_POST['class_id']) && $_POST['class_id']){

            $note = new Note();
            $note->id =$_POST['id'];
            $note = $note->find();
            $note->note = $_POST['note'];
            $note->trimester = $_POST['trimester'];
            $note->student_id = $_POST['student_id'];
            $note->class_id = $_POST['class_id'];
            $note->save();
         
            echo json_encode($note);
        }
    }
        
    public function delete()
    {  
      //  try{
       $note = new Note();
       $note = $note->find($_POST['id']);
       $note->remove();
     //  echo json_encode(['status' => true]);
       // }catch(\Exception $e){
       //echo json_encode(['status' => false]);

      //  }

    }
}



?>