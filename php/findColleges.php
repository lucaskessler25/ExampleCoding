<?php
    $data = array();
    
    //database details
    $dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName     = 'draft';
    
    //create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($db->connect_error){
        die("Unable to connect database: " . $db->connect_error);
    }
    
    //get user data from the database
    $query = $db->query("SELECT DISTINCT College FROM players ORDER BY College;");
    if($query->num_rows != 0){
		$i = 0;
        while($userData = $query->fetch_assoc()) {
			$data[$i]['college'] = $userData["College"];	//add college value from each row
			$i++;
		}
		$data['total'] = $query->num_rows;					//add total amount of rows to data.total
    }
    
    //returns data as JSON format
    echo json_encode($data);
?>

