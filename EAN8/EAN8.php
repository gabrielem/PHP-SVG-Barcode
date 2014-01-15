<?php
    //Left start with white bar and right with black
    $bartable=array('3211','2221','2122','1411','1132','1231','1114','1312','1213','3112');
    $guard='101';
    $center='01010';
    
    //configure
    $unit='px';//Base Unit
    $bw=3;
    $width=75*$bw;
    $height=50*$bw;
    $fs=8*$bw;
    $x=4*$bw;
    $yt=45*$bw;
    $dx=3*$bw;
    $y=2.5*$bw;
    $sb=35*$bw;
    $lb=45*$bw;
    
    function check($str){
        $code=str_split($str);
        $sum=($code[0]+$code[2]+$code[4]+$code[6])*3;
        $sum+=$code[1]+$code[3]+$code[5];
        $sum=10-($sum %10);
        return $sum;
    }
    function draw($num){
        global  $unit,$bartable,$guard,$center,$width, $bw, $height,$fs, $x,$y,$yt,$dx, $sb, $lb;
        $num=preg_replace('/\D/','',$num);
        $char=$num.check($num);
        $char=str_split($char);

        $img='';
        $img.= "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>\n<!DOCTYPE svg PUBLIC \"-//W3C//DTD SVG 1.1//EN\" \"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd\">\n";
        $img.= "<svg width='$width$unit' height='$height$unit' version='1.1' xmlns='http://www.w3.org/2000/svg'>\n";
        
        //Draw Guard bar.
        $val =$guard;
        $img.= "<desc>First Guard</desc>\n";
        $val =str_split($val);
        foreach ($val as $bar){
            if ((int)$bar===1){
                $img.= "<rect x='$x$unit' y='$y$unit' width='$bw$unit' height='$lb$unit' fill='black' stroke-width='0' />\n";
            }
            $x=$x+$bw;
        }
        
        //Draw Left Bar.
        for ($i=0;$i<4; $i++){
            $val=$bartable[$char[$i]];
            $img.= '<desc>'.htmlspecialchars($char[$i])."</desc>\n";
            $xt=$x+$dx;
            $img.= "<text x='$xt$unit' y='$yt$unit' font-family='Arial' font-size='$fs'>$char[$i]</text>\n";
            $val =str_split($val);
            for ($j = 0 ; $j < 4 ; $j++) {
                $num=(int)$val[$j];
                $w=$bw*$num;
                if ($j%2) {
                    $img.= "<rect x='$x$unit' y='$y$unit' width='$w$unit' height='$sb$unit' fill='black' stroke-width='0' />\n";
                }
                $x=$x+$w;
            }
        }
       
        //Draw Center Bar.
        $val =$center;
        $img.= "<desc>Center</desc>\n";
        $val =str_split($val);
        foreach ($val as $bar){
            if ((int)$bar===1){
                $img.= "<rect x='$x$unit' y='$y$unit' width='$bw$unit' height='$lb$unit' fill='black' stroke-width='0' />\n";
            }
            $x=$x+$bw;
        }
        
        //Draw Right Bar.
        for ($i=4;$i<8; $i++){
            $val=$bartable[$char[$i]];
            $xt=$x+$dx;
            $img.= '<desc>'.htmlspecialchars($char[$i])."</desc>\n";
            $img.= "<text x='$xt$unit' y='$yt$unit' font-family='Arial' font-size='$fs'>$char[$i]</text>\n";
            $val =str_split($val);
            for ($j = 0 ; $j < 4 ; $j++) {
                $num=(int)$val[$j];
                $w=$bw*$num;
                if (!($j%2)) {
                    $img.= "<rect x='$x$unit' y='$y$unit' width='$w$unit' height='$sb$unit' fill='black' stroke-width='0' />\n";
                }
                $x=$x+$w;
            }
        }

        //Draw End Guard Bar.
        $val =$guard;
        $img.= "<desc>End Guard</desc>\n";
        $val =str_split($val);
        foreach ($val as $bar){
            $x=$x+$bw;
            if ((int)$bar===1){
                $img.= "<rect x='$x$unit' y='$y$unit' width='$bw$unit' height='$lb$unit' fill='black' stroke-width='0' />\n";
            }
        }
        
        $img.= '</svg>';
        return $img;
    }
?>