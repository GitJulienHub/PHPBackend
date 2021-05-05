<?php

require_once __DIR__ . '../../../connectdb.php';

class AuthorCreateRoute{

  function CreateAuthor(){
    // TODO: error checking
    $parameterName = 'name';

    if(!isset($_POST[$parameterName]) || empty($_POST[$parameterName])){
      // TODO: return error
      return;

    }
    $requiredParameters = array("name");
    $db = new Connect;

    $statement = "INSERT INTO tb_authors ($parameterName) VALUES (:$parameterName)";;
    $stmt = ($db->prepare($statement));
    $stmt->bindParam($parameterName,$_POST[$parameterName], PDO::PARAM_STR);
    $stmt->execute();

    //TODO check for errors, send code
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header("Access-Control-Allow-Origin: http://localhost:3000");
  $API = new AuthorCreateRoute;
  $API->CreateAuthor();
}

 ?>