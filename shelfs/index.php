<?php
require_once __DIR__ . '../../connectdb.php';

class GetShelfsRoute{

  function getAllShelfs(){
    $db = new Connect;
    $shelfs = array();
    $data = $db->prepare('select * from tb_shelf');
    $data->execute();
    while($output = $data->fetch(PDO::FETCH_ASSOC)){
      array_push($shelfs, array(
        'id' => $output['id'],
        'shelfdescr' => $output['shelfdescr']
      ));
    }
    return json_encode($shelfs);
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $API = new GetShelfsRoute;
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Content-Type: application/json');
  echo $API->getAllShelfs();
}
 ?>
