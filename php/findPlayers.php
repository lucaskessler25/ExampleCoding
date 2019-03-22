<?php
if(!empty($_POST['q'])){
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
    $query = $db->query("SELECT Name, Players_ID FROM players WHERE College = '" . $_POST['q'] . "'");
    if($query->num_rows > 0){
		$i = 0;
        while($userData = $query->fetch_assoc()) {
			$data[$i]['name'] = $userData["Name"];		//adds the name of the current row of results from query
			$data[$i]['pId'] = $userData["Players_ID"];	//adds the Players_ID of the current row of results from query
			$i++;
		}
		$data['total'] = $query->num_rows;				//how many rows did we return? add value to data.total
    }
    
    //returns data as JSON format
    echo json_encode($data);
}
?>




