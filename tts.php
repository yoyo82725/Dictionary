<?php

$word = $_POST['word'];

if($word){
	//http://translate.google.com/translate_tts?tl=en&q=
	//處理自串
	$word = strip_tags($word);
	$word2 = str_replace(' ', '%20', $word);
	
	//建立放置目錄
	if(@mkdir('tts')){
	}else{//刪除舊目錄+檔案
		deleteDirectory('tts');
		mkdir('tts');
	}
	
	//抓音樂
	copy("http://translate.google.com/translate_tts?tl=en&q={$word2}","tts/{$word}.mp3");
	
	//播音樂
	echo "	<audio hidden autoplay controls >
	<source src='tts/{$word}.mp3' type='audio/mp3' ></source>
	Your browser does not support the audio tag.
	</audio>";
}

function deleteDirectory($dir) {//強制刪除目錄  適用PHP5.4以下?
	if (!file_exists($dir)) return true;  
	if (!is_dir($dir) || is_link($dir)) return unlink($dir);  
		foreach (scandir($dir) as $item) {  
			if ($item == '.' || $item == '..') continue;  
			if (!deleteDirectory($dir . "/" . $item)) {  
				chmod($dir . "/" . $item, 0777);  
				if (!deleteDirectory($dir . "/" . $item)) return false;  
			};  
		}  
		return rmdir($dir);  
}  
?>