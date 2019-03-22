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
    $query = $db->query("Select Count(College) as ct, College from Players Where pos = 'QB' and exists ( select * from Players AS P, Draft AS D where P.Players_ID = D.player_id) Group by college order by ct;");
    
    if($query->num_rows > 0){
        $i = 0;
        while($row = $query->fetch_assoc()) {
			$data[$i]['count'] = $row["ct"];
			$data[$i]['college'] = $row["College"];
			$i++;
		}
    }
    
    //returns data as JSON format
    echo json_encode($data);
//}
?>