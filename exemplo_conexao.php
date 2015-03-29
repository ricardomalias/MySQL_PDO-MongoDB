<?php

	class DB
	{
		function con()
		{
			try {
			    $conn = new PDO('mysql:host=localhost;dbname=user', 'username', 'password');
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
			    echo 'ERROR: ' . $e->getMessage();
			}

			return $conn;
		}

		function mongodb()
		{
		   $m = new MongoClient();
		   $db = $m->user;

		   return $db;
		}
	}
	
	// mysql usando PDO
	$sql = '
		SELECT
			id_user,
			nome,
			status
		FROM
			user
	';

	$query = DB::con()->prepare($sql);
	$query->execute();

	$rs = $query->fetchAll();

	foreach($rs as $user)
	{
		echo $user["id_user"] . " - ";
		echo $user["nome"] . "<br>";
	}



	// mongodb
	$mquery = DB::mongodb();

	$collection = $mquery->users;	
	$cursor = $collection->find();

	foreach ($cursor as $user) 
	{
		echo $user["id_user"] . " - ";
		echo $user["nome"] . "<br>";
	}
	
?>