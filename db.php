<?php

	$host         = "localhost";
	$username     = "root";
	$password     = "";
	$dbname       = "dukenet";

	try {
	    $con = new PDO('mysql:host=localhost;dbname=dukenet', $username, $password);
	} 
	catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}