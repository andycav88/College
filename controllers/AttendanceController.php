<?php

class AttendanceController
{   
    public function index()
    {
        include_once "views/index.php";
   /*      $attendance = new Attendance();
        $attendance->date = "2020-02-02";
        $attendance->justified = 2;
        $attendance->id_student = 2;
        $attendance->id_class = 1;
        $attendance->id = 6;
        $attendance->save();
        $attendance->remove();
        echo $attendance;*/
   
    }
  
       public function create()
    {
    
        if(isset($_POST['date']) && $_POST['date'] && isset($_POST['justified']) && $_POST['justified'] &&
        isset($_POST['id_class']) && $_POST['id_class'] && isset($_POST['id_student']) && $_POST['id_student' ]){
            $attendance = new Attendance();
            $attendance->date = $_POST['date'];
            $attendance->justified = $_POST['justified'];
            $attendance->id_class = $_POST['id_class'];
            $attendance->id_student = $_POST['id_student'];
            $insertedID = $attendance->save();
            $attendance->id = $insertedID;
            echo json_encode($attendance);
       }
    }

      public function update()
      {
        if(isset($_POST['date']) && $_POST['date'] && isset($_POST['justified']) && $_POST['justified'] &&
        isset($_POST['id_class']) && $_POST['id_class'] && isset($_POST['id_student']) && $_POST['id_student']){
            $attendance = new Attendance();
            $attendance->id =$_POST['id'];
            $attendance = $attendance->find();
            $attendance->name = $_POST['name'];
            $attendance->lastname = $_POST['lastname'];
            $attendance->email = $_POST['email'];
            $attendance->password = $_POST['password'];
            $attendance->save();
         
            echo json_encode($attendance);
        }
    }
        
    public function delete()
    {  
      //  try{
       $attendance = new Student();
       $attendance = $attendance->find($_POST['id']);
       $attendance->remove();
     //  echo json_encode(['status' => true]);
       // }catch(\Exception $e){
       //echo json_encode(['status' => false]);

      //  }

    }
}



?>