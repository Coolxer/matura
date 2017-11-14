<?php

	if(!$id = mysql_connect('localhost','root',''))
	{
		exit("Server connection error!");
	}
	else
	{
		if(!$base = mysql_select_db('matura',$id))
		{
			exit("Database connect error!");
		}
	}
	
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	
	$tableName = "";
		
	if(isSet($_GET['tableName']))
	{
		$tableName = $_GET['tableName'];
	}
	else
	{
		exit("Error sending name of table to show");
	}
	
	if(!$result = mysql_query("select * from $tableName", $id))
	{
		echo "Query failed";
	}
	else
	{
		$data = array();
		$row_array = array();
		$names_of_columns = array();
		$num_of_rows = mysql_num_rows($result);
		
		while($row = mysql_fetch_array($result))
		{
			$row_array[] = $row;
		}
		
		if(!$resultCols = mysql_query("show columns from $tableName", $id))
		{
			exit("Query nr 2 failed");
		}
		else
		{
			while($col = mysql_fetch_assoc($resultCols))
			{
				$names_of_columns[] = $col['Field'];
			}
		}
		
		$data['results'] = $row_array;
		$data['num_of_rows'] = $num_of_rows;
		$data['names_of_columns'] = $names_of_columns;
		
		echo json_encode($data);
	}
	
	mysql_close($id);
?>