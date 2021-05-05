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
  private $basicSelectStatement = "
      SELECT tb_books.*,tb_bookstates.id as bookstatesid, tb_bookstates.state
       ,tb_shelf.id as shelfid, tb_shelf.shelfdescr,tb_authors.id as authorid, tb_authors.name
      FROM `tb_books`
      INNER JOIN tb_bookstates ON tb_books.stateid=tb_bookstates.id
      LEFT OUTER JOIN tb_shelf ON tb_books.shelfid=tb_shelf.id
      INNER JOIN tb_authors ON tb_books.authorid=tb_authors.id";

  function GetAllBooks(){
    $db = new Connect;
    $books = array();
    $data = $db->prepare($this->basicSelectStatement);
    $data->execute();
    while($output = $data->fetch()){
      array_push($books, array(
        'id' => $output['id'],
        'title' => $output['title'],
        'authorid' => $output['authorid'],
        'name' => $output['name'],
        'shelfid' => $output['shelfid'],
        'shelfdescr' => $output['shelfdescr'],
        'stateid' => $output['stateid'],
        'state' => $output['state'],
      ));
    }
    return json_encode($books);
  }
  function GetBooksByParameters(){
    $db = new Connect;

    $possibleParameters = array("name", "title");

    $actualParameters = GetViableParametersAndValues($possibleParameters);
    $sqlConditions = BuildPreparedSQLConditionsFromParameters($possibleParameters);

    $preparedCondition = BuildPreparedSQLCondition($sqlConditions);

    $statement = $db->prepare($this->basicSelectStatement." WHERE " . $preparedCondition);
    $statement->execute($actualParameters);
    $books = array();

    while($output = $statement->fetch()){
      array_push($books, array(
        'id' => $output['id'],
        'title' => $output['title'],
        'authorid' => $output['authorid'],
        'name' => $output['name'],
        'shelfid' => $output['shelfid'],
        'shelfdescr' => $output['shelfdescr'],
        'stateid' => $output['stateid'],
        'state' => $output['state'],

      ));
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
