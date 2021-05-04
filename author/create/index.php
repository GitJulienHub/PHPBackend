<?php

require_once __DIR__ . '../../../connectdb.php';

class AuthorCreateRoute{

  function CreateAuthor(){
    // TODO: error checking
    $requiredParameters = array("name");
    $db = new Connect;

    $stmt = $db->prepare("INSERT INTO tb_authors (name) VALUES (?)");
    $stmt->bind_param($_POST['name']);
    $stmt->execute();
    $stmt->close();
    $db->close();
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $API = new BookCreateRoute;
  $API->CreateAuthor();
}

 ?>
