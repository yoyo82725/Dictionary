<?php
    if (isset($_POST['search'])) {
	
	    $db = new pdo("mysql:host=localhost;dbname=gcide", "root", "");
        // never trust what user wrote! We must ALWAYS sanitize user input
        $word = mysql_real_escape_string($_POST['search']);
        $query = "SELECT * FROM gcide WHERE word LIKE '" . $word . "%' ORDER BY word LIMIT 10";
        $result = $db->query($query);
        $end_result = '';
        if ($result) {
            while ( $r = $result->fetch(PDO::FETCH_ASSOC) ) {
                $end_result                       .= '<dt>' . $r['word'];
                if($r['pos'])         $end_result .= ',&nbsp;<span class="pos">'.$r['pos'].'</span>';
				//音效(使用譯點通)
				if($_POST['choose'] == 1){
					if($r['soundSource']) $end_result .= '&nbsp;&nbsp;<audio hidden id="'.strtolower($r['word']).'Player" controls="controls"><source src="mp3/'.strtolower($r['word']).'.mp3" type="audio/mp3" /></audio><input type="button" value="sound" onclick="document.getElementById(\''.strtolower($r['word']).'Player\').play();" />';
				}else{
					//音效(使用TTS)******************
					$js = "tts('{$r['word']}');";
					$end_result .= '&nbsp;&nbsp;<input type="button" value="sound" onclick="'.$js.'" />';
					//*******************************
				}
				$end_result                       .= '</dt>';
                $end_result                       .= '<dd>';
                if($r['fld'])         $end_result .= '<span class="fld">('.$r['fld'].')</span>';
                $end_result                       .= $r['definition'];
                $end_result                       .= '</dd>';
            }
        }
        if(!$end_result) {
            $end_result = '<dt><div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
            <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
            No results found.</p>
            </div></dt>';
        }
        echo $end_result;
    }
?>
<script type='text/javascript'>
	function tts(inWord){//tts語音
		$.ajax({
			type: "POST",
			url: "tts.php",
			data: { word : inWord },
			success: function(html){ // this happens after we get results
				$("#sound").html(html);
			}
		});
	}
</script>