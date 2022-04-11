<?php

class ProfessorController
{
  public function index()
  {

    $professors = Professor::all();
    view("listProfessor", $professors);

    //include_once "views/listProfessor.php";

    /*  $professor = new Professor();
        $professor->specialist = 1;
        $professor->name = "NESTLE";
        $professor->lastname = "Prieto";
        $professor->password = "admin11";
        $professor->email = "pedro@gmail.com";
        $professor->id = 8;
        $professor->save();
       //  $professor->remove();
        echo $professor;*/
  }

  public function create()
  {

    if (
      isset($_POST['specialist']) && $_POST['specialist'] && isset($_POST['name']) && $_POST['name'] &&
      isset($_POST['lastname']) && $_POST['lastname'] && isset($_POST['email']) && $_POST['email'] &&
      isset($_POST['password']) && $_POST['password']
    ) {
      $professor = new Professor();
      $professor->specialist = $_POST['specialist'];
      $professor->name = $_POST['name'];
      $professor->lastname = $_POST['lastname'];
      $professor->email = $_POST['email'];
      $professor->password = $_POST['password'];
      $insertedID = $professor->save();
      $professor->id = $insertedID;
      $results = json_encode($professor);
      echo $results;
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
    //  try{
    $professor = new Professor();
    $professor = $professor->find($_POST['id']);
    $professor->remove();
    //  echo json_encode(['status' => true]);
    // }catch(\Exception $e){
    //echo json_encode(['status' => false]);

    //  }

  }
}
