<?php
require_once __DIR__ . '../../connectdb.php';

class GetAuthorsRoute{

  function getAllAuthors(){
    $db = new Connect;
    $shelfs = array();
    $data = $db->prepare('select * from tb_authors');
    $data->execute();
    while($output = $data->fetch(PDO::FETCH_ASSOC)){
      $shelfs[$output['id']] = array(
        'id' => $output['id'],
        'name' => $output['name']
      );
    }
    return json_encode($shelfs);
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $API = new GetAuthorsRoute;
  header('Content-Type: application/json');
  echo $API->getAllAuthors();
}
 ?>
