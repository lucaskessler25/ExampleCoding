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
    $query = $db->query("SELECT Players.Name,Miscellaneous.Pro_Bowls,Miscellaneous.AP1 From players right outer join miscellaneous on players.Players_ID = miscellaneous.Players_Players_ID where Pos = 'QB' and Pro_Bowls <>0 and AP1<>0");
    if($query->num_rows > 0){
		$i = 0;
        while($userData = $query->fetch_assoc()) {
			$data[$i]['name'] = $userData["Name"];
			$data[$i]['pro_bowls'] = $userData["Pro_Bowls"];
                        $data[$i]['ap1'] = $userData["AP1"];
			$i++;
		}
		$data['total'] = $query->num_rows;
    }
    
    //returns data as JSON format
    echo json_encode($data);
//}
?>