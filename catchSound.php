<?php
	//link sql
    $connection = mysql_connect('localhost', 'root', '') or die('Could not connect to MySQL database. ' . mysql_error());
    $db = mysql_select_db('gcide',$connection);
	
	$catchUrl = 'http://dict.dreye.com/audio/tms/';
	//main
	$sql = 'SELECT * FROM `gcide` ;';
	
	if($res = mysql_query($sql)){
		while($row = mysql_fetch_array($res)){
			//選定單字
			$id = $row['id'];
			$word = strtolower($row['word']);
			//抓字首
			$pre = strtoupper(substr($word,0,1));
			//下載網站mp3
			$downloadUrl = $catchUrl.$pre.'/'.$word.'.mp3';
			//若成功下載,寫入資料庫
			if(@copy($downloadUrl,'mp3/'.$word.'.mp3')){
				$sql2 = "UPDATE `gcide` SET `soundSource` = '{$downloadUrl}' WHERE `id`='{$id}';";
				mysql_query($sql2);
			}
			
		}
	}
	echo 'Done!';
?>