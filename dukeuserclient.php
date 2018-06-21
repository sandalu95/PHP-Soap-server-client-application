<?php

  ini_set('display_errors', true); 
  error_reporting(E_ALL);

  require_once('nusoap.php');
  
  $error  = ''; 
  $result = array(); 
  $wsdl = "webservice.wsdl";
  
  if(isset($_POST['sub'])){
    $id = trim($_POST['id']);
    if(!$id){
      $error = 'ID cannot be left blank.';
    }
    if(!$error){ 
      $client = new nusoap_client($wsdl, true);
      $err = $client->getError();
      if ($err) {
        echo '<h2>Constructor error</h2>' . $err;
        exit();
      }
      try {
        $result = $client->call('getUserDetails', array($id));
        $result = json_decode($result); 
      }
      catch (Exception $e) {
          echo 'Caught exception: ',  $e->getMessage(), "\n";
      }
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/flipcard.css">
  <!-- scripts -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/viewall.js"></script>
</head>
<body>

</body>
</html>

