<?php

require_once __DIR__ . '../../../connectdb.php';

class BookUpdateRoute{

  function UpdateBook($input){
    $db = new Connect;

    if(isset($input['id'])&& !empty($input['id'])){
        $actualParameters = array("shelfid", "stateid");
        foreach ($possibleParameters as $parameter){
          if(isset($input[$parameter])&& !empty($input[$parameter])){
            $stmt = $db->prepare("UPDATE tb_books SET ". $parameter ."=? WHERE id=?");
            $stmt->bind_param($input[$parameter], $id);
            $status = $stmt->execute();
          }

  }

  }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $API = new BookCreateRoute;
  $API->UpdateBook($input);
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
