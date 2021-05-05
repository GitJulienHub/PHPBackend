<?php

require_once __DIR__ . '../../../connectdb.php';

class ShelfCreateRoute{

  function CreateShelf($input){
    // TODO: error checking
    $parameterName = 'shelfdescr';

    if(!isset($input[$parameterName]) || empty($input[$parameterName])){
      // TODO: return error
      return;

    }
    $requiredParameters = array("shelfdescr");
    $db = new Connect;

    $statement = "INSERT INTO tb_shelf ($parameterName) VALUES (:$parameterName)";
    $stmt = ($db->prepare($statement));
    $stmt->bindParam($parameterName,$input[$parameterName], PDO::PARAM_STR);
    $stmt->execute();

    //TODO check for errors, send code
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header("Access-Control-Allow-Origin: http://localhost:3000");
  $API = new ShelfCreateRoute;
  $API->CreateShelf($_POST);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");
    header("Access-Control-Request-Method: GET");
    header('Content-Type: application/json');
    $API = new ShelfCreateRoute;
    $API->CreateShelf($_GET);
}

 ?>
