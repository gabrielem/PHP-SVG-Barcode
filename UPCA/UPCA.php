<?php
    //Left has white bar at 1st, old only.
    //Right has black bar at 1st (event only).
    $bartable=array('3211','2221','2122','1411','1132','1231','1114','1312','1213','3112');
    $guard='101';
    $center='01010';
    //configure
    $unit='px';
    $bw=3;//bar width
    $width=$bw*113;
    $height=$bw*50;
    $fs=8*$bw;//Font size
    $yt=45*$bw;
    $dx=2*$bw;//lengh between bar and text
    $x=7*$bw;
    $y=2.5*$bw;
    $sb=35*$bw;
    $lb=45*$bw;
    
    function check($str){
        $code=str_split($str);
        $sum=($code[0]+$code[2]+$code[4]+$code[6]+$code[8]+$code[10])*3;
        $sum+=$code[1]+$code[3]+$code[5]+$code[7]+$code[9];
        $sum=10-($sum %10);
        return $sum;
    }
    function draw($num){
        global  $unit,$prity,$bartable,$guard,$center,$width, $bw, $height, $x,$y,$yt,$dx,$fs, $sb, $lb;
        $num=preg_replace('/\D/','',$num);
        $char=$num.check($num);
        $char=str_split($char);

        $img='';
        $img.= "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>\n<!DOCTYPE svg PUBLIC \"-//W3C//DTD SVG 1.1//EN\" \"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd\">\n";
        $img.= "<svg width='$width$unit' height='$height$unit' version='1.1' xmlns='http://www.w3.org/2000/svg'>\n";
        $xt=$x+$dx-8*$bw;//Start point of text drawing
        $img.= "<text x='$xt$unit' y='$yt$unit' font-family='Arial' font-size='$fs'>$char[0]</text>\n";

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
        //Draw First number
        $val =$bartable[$char[0]];
        $img.= "<desc>First number</desc>\n";
        $val =str_split($val);
        for ($j = 0 ; $j < 4 ; $j++) {
            $num=(int)$val[$j];
            $w=$bw*$num;
            if ($j%2) {
                $img.= "<rect x='$x$unit' y='$y$unit' width='$w$unit' height='$lb$unit' fill='black' stroke-width='0' />\n";
            }
            $x=$x+$w;
        }
        //Draw Left Bar.
        for ($i=1;$i<6; $i++){
            $val=$bartable[$char[$i]];
            $img.= '<desc>'.htmlspecialchars($char[$i])."</desc>\n";
            $xt=$x+$dx;
            $img.= "<text x='$xt$unit' y='$yt$unit' font-family='Arial' font-size='$fs'>".$char[$i]."</text>\n";
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
        for ($i=6;$i<11; $i++){
            $val=$bartable[$char[$i]];
            $img.= '<desc>'.htmlspecialchars($char[$i])."</desc>\n";
            $xt=$x+$dx;
            $img.= "<text x='$xt$unit' y='$yt$unit' font-family='Arial' font-size='$fs'>".$char[$i]."</text>\n";
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
        //Draw checksum number
        $val =$bartable[$char[11]];
        $img.= "<desc>Zero Bar</desc>\n";
        $val =str_split($val);
        for ($j = 0 ; $j < 4 ; $j++) {
            $num=(int)$val[$j];
            $w=$bw*$num;
            if (!($j%2)) {
                $img.= "<rect x='$x$unit' y='$y$unit' width='$w$unit' height='$lb$unit' fill='black' stroke-width='0' />\n";
            }
            $x=$x+$w;
        }
        //Draw End Guard Bar.
        $val =$guard;
        $img.= "<desc>End Guard</desc>\n";
        $val =str_split($val);
        foreach ($val as $bar){
            if ((int)$bar===1){
                $img.= "<rect x='$x$unit' y='$y$unit' width='$bw$unit' height='$lb$unit' fill='black' stroke-width='0' />\n";
            }
            $x=$x+$bw;
        }
        //Checksum char
        $xt+=2*9*$bw;
        $img.="<text x='$xt$unit' y='$yt$unit' font-family='Arial' font-size='$fs'>$char[11]</text>\n";
        $img.='</svg>';

        return $img;
    }
?>