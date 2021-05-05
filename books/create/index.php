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
          break;
        case "int":
          $pdoType = PDO::PARAM_INT;
          break;
        default:
      }
      if($pdoType == null){
        continue;
      }
      $stmt->bindParam($key,$value, $pdoType);

    }
    $stmt->execute();
  }

  function CreateBook(){
    // TODO: error checking
    $db = new Connect;
    $requiredParameters = array("title", "shelfid","stateid","authorid");
    $params = array();
    foreach ($requiredParameters as $value) {
        $params[$value] = $_POST[$value];
    }
    $this->sqlInsert($db, "tb_books", $params);
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $API = new BookCreateRoute;
  $API->CreateBook();
}

 ?>
