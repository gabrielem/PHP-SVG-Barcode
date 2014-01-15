<?php
    $prity=array(
        array(1,1,1,1,1,1),
        array(1,1,0,1,0,0),
        array(1,1,0,0,1,0),
        array(1,1,0,0,0,1),
        array(1,0,1,1,0,0),
        array(1,0,0,1,1,0),
        array(1,0,0,0,1,1),
        array(1,0,1,0,1,0),
        array(1,0,1,0,0,1),
        array(1,0,0,1,0,1)
    );
    //Left has white bar at 1st.
    //Right has black bar at 1st (event only).
    $bartable=array(
        array('3211','1123'),
        array('2221','1222'),
        array('2122','2212'),
        array('1411','1141'),
        array('1132','2311'),
        array('1231','1321'),
        array('1114','4111'),
        array('1312','2131'),
        array('1213','3121'),
        array('3112','2113')
    );
    $guard='101';
    $center='01010';
    //configure
    $unit='px';
    $bw=3;//bar width
    $width=$bw*106;
    $height=$bw*50;
    $fs=8*$bw;//Font size
    $yt=45*$bw;
    $dx=2*$bw;//lengh between bar and text
    $x=7*$bw;
    $y=2.5*$bw;
    $sb=35*$bw;
    $lb=45*$bw;

    function check($str){
        $sum=0;
        $code=str_split($str);
        $sum=($code[1]+$code[3]+$code[5]+$code[7]+$code[9]+$code[11])*3;
        $sum+=$code[0]+$code[2]+$code[4]+$code[6]+$code[8]+$code[10];
        $sum=10-($sum %10);
        return $sum;
    }
    function draw($num){
        global  $unit,$prity,$bartable,$guard,$center,$width, $bw,$fs, $yt,$dx, $height, $x,$y, $sb, $lb;
        $num=preg_replace('/\D/','',$num);
        $char=$num.check($num);
        $first=substr($num,0,1);
        $first=(int)$first;
        $oe=$prity[$first];//Old event array for first number
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
        //Draw Left Bar.
        for ($i=1;$i<7; $i++){
            $id=$i-1;//id for Old-event array
            $oev=!$oe[$id];//Old-event value
            $val=$bartable[$char[$i]][$oev];
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
  
        //Draw Right Bar always in first column.
        for ($i=7;$i<13; $i++){
            $val=$bartable[$char[$i]][0];
            $img.= '<desc>'.htmlspecialchars($char[$i])."</desc>\n";
            $xt=$x+$dx;
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
            if ((int)$bar===1){
                $img.= "<rect x='$x$unit' y='$y$unit' width='$bw$unit' height='$lb$unit' fill='black' stroke-width='0' />\n";
            }
            $x=$x+$bw;
        }
        $img.= '</svg>';
        return $img;
    }
?>