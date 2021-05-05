<?php
require_once __DIR__ . '../../connectdb.php';

class GetStatesRoute{

  function getAllStates(){
    $db = new Connect;
    $shelfs = array();
    $data = $db->prepare('select * from tb_bookstates');
    $data->execute();
    while($output = $data->fetch(PDO::FETCH_ASSOC)){
      array_push($shelfs,array(
        'id' => $output['id'],
        'state' => $output['state']
      ));
    }
    return json_encode($shelfs);
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $API = new GetStatesRoute;
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Content-Type: application/json');
  echo $API->getAllStates();
}
 ?>
