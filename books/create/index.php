<?php

require_once __DIR__ . '../../../connectdb.php';

class BookCreateRoute{

  function sqlInsert($db, $table, $params){
    if(!isset($params) || empty($params)){
      return;
    }
    $statement = "insert into $table (";
    $colNames = "";
    $valNames = "";
    foreach ($params as $key => $value) {
        $colNames = $colNames . $key . ',';
        $valNames = $valNames . ":". $key . ', ';
    }
    $colNames = substr($colNames, 0, strlen($colNames)-1);
    $valNames = substr($valNames, 0, strlen($valNames)-2);

    $statement = $statement . $colNames . ") VALUES (". $valNames . ")";
    echo $statement;
    $stmt = ($db->prepare($statement));

    foreach ($params as $key => $value) {
      $pdoType = null;
      switch(gettype($value)){
        case "string":
          $pdoType = PDO::PARAM_STR;
          $stmt->bindParam(":".$key,$value, $pdoType, 50);
          break;
        case "int":
          $pdoType = PDO::PARAM_INT;
          $stmt->bindParam(":".$key,$value, $pdoType);
          break;
        default:
      }
      if($pdoType == null){
        continue;
      }

    }
    $stmt->execute();
  }

  function CreateBook($input){
    // TODO: error checking
    $db = new Connect;
/*
    $requiredParameters = array("title", "shelfid","stateid","authorid");
    $params = array();
    foreach ($requiredParameters as $value) {
        $params[$value] = $input[$value];
    }
*/
    $s = "insert INTO tb_books (title, authorid, shelfid, stateid) VALUES ('".$input["title"]."',". $input["authorid"]." , ".$input["shelfid"].", ".$input["stateid"].")";
    $stmt = $db->prepare($s);
    $stmt->execute();
    //$this->sqlInsert($db, "tb_books", $params);
  }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
header("Access-Control-Allow-Origin: http://localhost:3000");
  $API = new BookCreateRoute;
  $API->CreateBook($_POST);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");
    header("Access-Control-Request-Method: GET");
    header('Content-Type: application/json');
    $API = new BookCreateRoute;
    $API->CreateBook($_GET);
}

 ?>
