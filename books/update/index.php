<?php

require_once __DIR__ . '../../../connectdb.php';

class BookUpdateRoute{

  function UpdateBook($input){
    $db = new Connect;
    if(isset($input['bookid'])&& !empty($input['bookid'])){
        $possibleParameters = array("shelfid", "stateid");
        foreach ($possibleParameters as $parameter){
          if(isset($input[$parameter])&& !empty($input[$parameter])){
            $stmt = $db->prepare("UPDATE tb_books SET ". $parameter ."=". $input[$parameter]." WHERE id=".$input["bookid"]);
            $status = $stmt->execute();
          }

  }

  }
}
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $API = new BookUpdateRoute;
  $API->UpdateBook($_POST);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");
    header("Access-Control-Request-Method: GET");
    header('Content-Type: application/json');
    $API = new BookUpdateRoute;
    $API->UpdateBook($_GET);
}
 ?>
