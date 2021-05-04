<?php
require_once __DIR__ . '/connectdb.php';

class LibraryAPI{
  function GetAllBooks(){
    $db = new Connect;
    $users = array();
    $data = $db->prepare('select * from tb_bookstates');
    $data->execute();
    while($output = $data->fetch(PDO::FETCH_ASSOC)){
      $users[$output['id']] = $output['state'];
    }
    return json_encode($users);
  }
}

$API = new LibraryAPI;
header('Content-Type: application/json');
echo $API->GetAllBooks();

 ?>
