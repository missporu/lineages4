<?
function str2gradient($text,$from='',$to='', $mode="hex") 
{ 
    if($mode=="hex") 
    { 
        $to  = hexdec($to[0].$to[1]).",".hexdec($to[2].$to[3]).",".hexdec($to[4].$to[5]); 
        $from= hexdec($from[0].$from[1]).",".hexdec($from[2].$from[3]).",".hexdec($from[4].$from[5]);
    } 

    if( empty($text) ) 
        return ''; 
    else 
        $levels=strlen($text); 

    if (empty($from)) 
                $from = array(0,0,255); 
    else 
                $from = explode(",", $from); 

    if (empty($to)) 

                $to = array(255,0,0); 
    else 
                $to = explode(",", $to); 

        $output = ""; 

        for ($i=1;$i<=$levels;$i++) 
        { 
                for ($ii=0;$ii<3;$ii++) 
                { 
                        $tmp[$ii] = $from[$ii] - $to[$ii]; 
                        $tmp[$ii] = floor($tmp[$ii] / $levels); 
                        $rgb[$ii] = $from[$ii] - ($tmp[$ii] * $i); 

                        if ($rgb[$ii] > 255) $rgb[$ii] = 255; 

                        $rgb[$ii] = dechex($rgb[$ii]); 
                        $rgb[$ii] = strtoupper($rgb[$ii]); 

                        if (strlen($rgb[$ii]) < 2) $rgb[$ii] = "0$rgb[$ii]"; 
                } 
           $output .= ''.$rgb[0].$rgb[1].$rgb[2].'' == '000000' ? '' . mb_substr($text, ($i-1), 1) . '' : "<font color=\"#".$rgb[0].$rgb[1].$rgb[2]."\">" . mb_substr($text, ($i-1), 1) ."</font>"; 
        } 
        return $output; 
} 
?>
