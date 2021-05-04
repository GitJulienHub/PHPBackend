<?php

require_once __DIR__ . '../../../connectdb.php';

class BookUpdateRoute{

  function UpdateBook(){
    $db = new Connect;

    if(isset($_POST['id'])&& !empty($_POST['id'])){
        $actualParameters = array("shelfid", "stateid");
        foreach ($possibleParameters as $parameter){
          if(isset($_POST[$parameter])&& !empty($_POST[$parameter])){
            $stmt = $db->prepare("UPDATE tb_books SET ". $parameter ."=? WHERE id=?");
            $stmt->bind_param($_POST[$parameter], $id);
            $status = $stmt->execute();
          }

  }

  }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $API = new BookCreateRoute;
  $API->UpdateBook();
}

 ?>
