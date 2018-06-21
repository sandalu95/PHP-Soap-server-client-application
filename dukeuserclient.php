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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/flipcard.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- scripts -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
  <div class="jumbotron">
  <div class="heading">
    <h2>
      DukeNET
    </h2>
    <br><br>
    <h4>Enter <b>ID</b> and click <b>Fetch Details</b></h4>
  </div>

  <form class="form-inline" method = 'post' name='form1'>  
   <?php if($error) { ?> 
      <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong>&nbsp;<?php echo $error; ?> 
         </div>
   <?php } ?>
     <div class="form-group">
       <label for="email">ID:</label>
       <input type="text" class="form-control" name="id" id="id" placeholder="Enter ID">
     </div>

     <button type="submit" name='sub' class="btn btn-default"><i class="fas fa-search"></i> Fetch Details</button>
   </form>
   <br><br>
    <h4>User Details</h4>
  <?php 

  if($result!=false){ 
        if(true){

         count(null);

        for ($i=0; $i < count($result); $i++) { 
            echo '<div class="col-xs-12 col-sm-6 col-md-4">';
            echo '<div class="image-flip" ontouchstart="this.classList.toggle("hover");">';
            echo '<div class="mainflip">';
            echo '<div class="frontside">';
            echo '<div class="card">';
            echo '<div class="card-body text-center">';
            echo '<p><img class=" img-fluid" src="images/'.$result->profile_pic.'" alt="card image"></p>';
            echo '<h4 class="card-title">'.$result->my_name.'</h4>';
            echo '<p class="card-text">Birth Date : '.$result->year." - ".$result->month.'</p>';
            echo '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="backside">';
            echo '<div class="card" style="height="120px;">';
            echo '<div class="card-body text-center mt-4" style="padding:15px 80px; margin:0 10px;">';
            echo '<h4 class="card-title">'.$result->my_name.'</h4>';
            echo '<p class="card-text">No.of Posts : '.$result->num_posts.'</p>';     
            echo '<p class="card-text">No.of Likes : '.$result->num_likes.'</p>';     
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
      }
    }
    else{
      echo "Enter a valid id";
    }
  ?>
  </div>
</body>
</html>

