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
    $query = $db->query("SELECT Count(P.Pos), P.pos FROM Draft AS D, Players AS P where D.player_id=P.Players_ID Group by P.Pos");
    
    if($query->num_rows > 0){
        $i = 0;
        while($row = $query->fetch_assoc()) {
			$data[$i]['count'] = $row["Count(P.Pos)"];
			$data[$i]['pos'] = $row["pos"];
			$i++;
		}
    }
    
    //returns data as JSON format
    echo json_encode($data);
//}
?>