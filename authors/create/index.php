<?php
require_once __DIR__ . '../../../connectdb.php';
class AuthorCreateRoute{

  function CreateAuthor($input){
    // TODO: error checking
    $parameterName = 'name';
    if(!isset($input[$parameterName]) || empty($input[$parameterName])){
      // TODO: return error
      return;

    }
    $requiredParameters = array("name");
    $db = new Connect;

    $statement = "INSERT INTO tb_authors ($parameterName) VALUES (:$parameterName)";
    $stmt = ($db->prepare($statement));
    $stmt->bindParam($parameterName,$input[$parameterName], PDO::PARAM_STR);
    $stmt->execute();




    //TODO check for errors, send code
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");
    header("Access-Control-Request-Method: POST");
    header('Content-Type: application/json');
  $API = new AuthorCreateRoute;
  $API->CreateAuthor($_POST);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");
    header("Access-Control-Request-Method: GET");
    header('Content-Type: application/json');
  $API = new AuthorCreateRoute;
  $API->CreateAuthor($_GET);
}

 ?>
