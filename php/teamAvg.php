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
    $query = $db->query("select D.tm, avg(Pass_Att), avg(Pass_Yds), avg(Pass_TD) , avg(Thrown_Int), avg(Rush_Att), avg(Rush_Yds), avg(Rush_TD) from Players AS P, Draft AS D, stats as S where P.Players_ID = D.player_id and S.Players_Players_ID=P.Players_ID and P.Pos = 'QB' AND S.Pass_Att <> 0 AND S.Rush_Att <> 0 group by D.Tm");
    
    if($query->num_rows > 0){
        $i = 0;
        while($row = $query->fetch_assoc()) {
			$data[$i]['team'] = $row["tm"];
			$data[$i]['pass_att'] = $row["avg(Pass_Att)"];
            $data[$i]['pass_yds'] = $row["avg(Pass_Yds)"];
            $data[$i]['pass_td'] = $row["avg(Pass_TD)"];
            $data[$i]['thrown_int'] = $row["avg(Thrown_Int)"];
            $data[$i]['rush_att'] = $row["avg(Rush_Att)"];
            $data[$i]['rush_yds'] = $row["avg(Rush_Yds)"];
            $data[$i]['rush_td'] = $row["avg(Rush_TD)"];
			$i++;
		}
		$data['total'] = $query->num_rows;
    }
    
    //returns data as JSON format
    echo json_encode($data);
//}
?>