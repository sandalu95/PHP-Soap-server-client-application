<?php
 require_once('db.php');
 require_once('nusoap.php'); 
 $server = new nusoap_server();


function getUserDetails($id){

    global $con;
    $sql = "SELECT * FROM users WHERE id=:id";

    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id);  
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    return json_encode($data);
    $con = null;

}

$server->configureWSDL('dukeServer', 'urn:users');

$server->register('getUserDetails',
      array('id' => 'xsd:string'),  
      array('data' => 'xsd:string'),  
      'urn:users',   
      'urn:users#getUserDetails' 
      );  

$server->service(file_get_contents("php://input"));

?>