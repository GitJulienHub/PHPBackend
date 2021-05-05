<?php
require_once __DIR__ . '../../connectdb.php';


function BuildPreparedSQLCondition($conditions){
  $condition = "";

  foreach ($conditions as $key => $value){
      $condition = $condition . $conditions[$key] . " AND ";
  }

  //remove last AND
  $condition = substr($condition, 0, strlen($condition)-5);

  return $condition;
}
function BuildPreparedSQLConditionsFromParameters($possibleParameters){
  $sqlConditions = array();
  foreach ($possibleParameters as $parameter){
    if(isset($_GET[$parameter])&& !empty($_GET[$parameter])){
      $sqlConditions[$parameter] =  " ". $parameter ." LIKE :" . $parameter . " ";
    }
  }
  return $sqlConditions;
}
function GetViableParametersAndValues($possibleParameters){
  $actualParameters = array();
  foreach ($possibleParameters as $parameter){
    if(isset($_GET[$parameter])&& !empty($_GET[$parameter])){
      $actualParameters[$parameter] = "%".$_GET[$parameter]."%";
    }
  }
  return $actualParameters;
}
class LibraryAPI{

  function GetAllBooks(){
    $db = new Connect;
    $users = array();
    $data = $db->prepare('select * from tb_books');
    $data->execute();
    while($output = $data->fetch(PDO::FETCH_ASSOC)){
      array_push($users, array(
        'id' => $output['id'],
        'title' => $output['title']
      ));
    }
    return json_encode($users);
  }
  function GetBooksByParameters(){
    $baseStatement = "
    SELECT tb_books.*, tb_bookstates.state,
     tb_shelf.shelfdescr, tb_authors.name
    FROM `tb_books`
    INNER JOIN tb_bookstates ON tb_books.stateid=tb_bookstates.id
    INNER JOIN tb_shelf ON tb_books.shelfid=tb_shelf.id
    INNER JOIN tb_authors ON tb_books.authorid=tb_authors.id

    WHERE
    ";

    $db = new Connect;

    $possibleParameters = array("name", "title");

    $actualParameters = GetViableParametersAndValues($possibleParameters);
    $sqlConditions = BuildPreparedSQLConditionsFromParameters($possibleParameters);

    $preparedCondition = BuildPreparedSQLCondition($sqlConditions);

    $statement = $db->prepare($baseStatement . $preparedCondition);
    $statement->execute($actualParameters);
    $books = array();
    while($row = $statement->fetch()){
      $books[$row['id']] = array(
        'title' => $row['title'],
        'name' => $row['name'],
        'shelfdescr' => $row['shelfdescr'],
        'state' => $row['state'],

      );
    }
    return json_encode($books);
  }

}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $API = new LibraryAPI;
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Content-Type: application/json');

  if(count($_GET)==0){
    echo $API->GetAllBooks();
  }else{
    echo $API->GetBooksByParameters();
  }



}


 ?>
