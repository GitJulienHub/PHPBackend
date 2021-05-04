<?php

require_once __DIR__ . '../../../connectdb.php';

class BookCreateRoute{

  function CreateBook(){
    // TODO: error checking
    $requiredParameters = array("title", "shelfid","stateid","authorid");
    $db = new Connect;

    $stmt = $db->prepare("INSERT INTO tb_books (title, shelfid, stateid, authorid) VALUES (?, ?, ?, ?)");
    $stmt->bind_param($_POST['title'], $_POST['shelfid'], $_POST['stateid'], $_POST['authorid']);
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
