<?php
    $connection = mysql_connect('localhost', 'root', '') or die('Could not connect to MySQL database. ' . mysql_error());
    $db = mysql_select_db('gcide',$connection);

    mysql_query('TRUNCATE TABLE gcide') or die(mysql_error());

    $xml = array('xml/gcide_a.xml', 'xml/gcide_b.xml', 'xml/gcide_c.xml', 'xml/gcide_d.xml', 'xml/gcide_e.xml','xml/gcide_f.xml','xml/gcide_g.xml', 'xml/gcide_h.xml', 'xml/gcide_i.xml', 'xml/gcide_j.xml', 'xml/gcide_k.xml', 'xml/gcide_l.xml', 'xml/gcide_m.xml', 'xml/gcide_n.xml', 'xml/gcide_o.xml', 'xml/gcide_p.xml', 'xml/gcide_q.xml', 'xml/gcide_r.xml', 'xml/gcide_s.xml', 'xml/gcide_t.xml', 'xml/gcide_u.xml', 'xml/gcide_v.xml', 'xml/gcide_w.xml', 'xml/gcide_x.xml', 'xml/gcide_y.xml', 'xml/gcide_z.xml');
    $numberoffiles = count($xml);

    for ($i = 0; $i <= $numberoffiles-1; $i++) {
        $xmlfile = $xml[$i];
        // original file contents
        $original_file = @file_get_contents($xmlfile);
        // if file_get_contents fails to open the link do nothing
        if(!$original_file) {}
        else {
            // find words in original file contents
            preg_match_all("/<hw>(.*?)<\/hw>(.*?)<def>(.*?)<\/def>/", $original_file, $results);
            $blocks = $results[0];
            // traverse blocks array
            for ($j = 0; $j <= count($blocks)-1; $j++) {
                preg_match_all("/<hw>(.*?)<\/hw>/", $blocks[$j], $wordarray);
                $words = $wordarray[0];
                $word = addslashes(strip_tags($words[0]));
                $word = preg_replace('{-}', ' ', $word);
                $word = preg_replace("/[^a-zA-Z0-9\s]/", "", $word);
                preg_match_all("/<def>(.*?)<\/def>/", $blocks[$j], $definitionarray);
                $definitions = $definitionarray[0];
                $definition = addslashes(strip_tags($definitions[0]));
                $definition = preg_replace('{-}', ' ', $definition);
                $definition = preg_replace("/[^a-zA-Z0-9\s]/", "", $definition);
                preg_match_all("/<pos>(.*?)<\/pos>/", $blocks[$j], $posarray);
                $poss = $posarray[0];
                $pos = addslashes(strip_tags($poss[0]));
                $pos = preg_replace('{-}', ' ', $pos);
                $pos = preg_replace("/[^a-zA-Z0-9\s]/", "", $pos);
                preg_match_all("/<fld>(.*?)<\/fld>/", $blocks[$j], $fldarray);
                $flds = $fldarray[0];
                $fld = addslashes(strip_tags($flds[0]));
                $fld = preg_replace('{-}', ' ', $fld);
                $fld = preg_replace("/[^a-zA-Z0-9\s]/", "", $fld);

                $insertsql = "INSERT INTO gcide (word, definition, pos, fld) VALUES ('$word', '$definition', '$pos', '$fld')";
                $insertresult = mysql_query($insertsql) or die(mysql_error());

                echo $word. " " . $definition ."\n";
            }
        }
    }
    echo 'Done!';
?>