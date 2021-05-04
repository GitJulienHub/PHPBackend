<?php

require_once __DIR__ . '../../../connectdb.php';

class ShelfCreateRoute{

  function CreateShelf(){
    // TODO: error checking
    $requiredParameters = array("shelfdescr");
    $db = new Connect;

    $stmt = $db->prepare("INSERT INTO tb_shelf (shelfdescr) VALUES (?)");
    $stmt->bind_param($_POST['shelfdescr']);
    $stmt->execute();
    $stmt->close();
    $db->close();
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $API = new BookCreateRoute;
  $API->CreateBook();
}

 ?>
