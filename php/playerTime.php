<?php
//if(!empty($_POST['q'])){
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
    $query = $db->query("select (P.Retired - D.Year) as time, P.Name from Players AS P, Draft AS D where P.Players_ID = D.player_id and P.pos='QB' LIMIT 200;");
    
    if($query->num_rows > 0){
        $i = 0;
        while($row = $query->fetch_assoc()) {
			$data[$i]['time'] = $row["time"];
			$data[$i]['name'] = $row["Name"];
			$i++;
		}
    }
    
    //returns data as JSON format
    echo json_encode($data);
//}
?>