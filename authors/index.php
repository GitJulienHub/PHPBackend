<?php
require_once __DIR__ . '../../connectdb.php';

class GetAuthorsRoute{

  function getAllAuthors(){
    $db = new Connect;
    $shelfs = array();
    $data = $db->prepare('select * from tb_authors');
    $data->execute();
    while($output = $data->fetch(PDO::FETCH_ASSOC)){
      array_push($shelfs, array(
        'id' => $output['id'],
        'name' => $output['name']
      ));
    }
    return json_encode($shelfs);
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Content-Type: application/json');
  $API = new GetAuthorsRoute;

  echo $API->getAllAuthors();
}
 ?>
