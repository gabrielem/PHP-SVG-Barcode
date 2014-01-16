<?php
class Code39{
    
    public $Code39;

    function __construct(){
    $this->Code39 = array(
    '0'=>'111221211',
    '1'=>'211211112',
    '2'=>'112211112',
    '3'=>'212211111',
    '4'=>'111221112',
    '5'=>'211221111',
    '6'=>'112221111',
    '7'=>'111211212',
    '8'=>'211211211',
    '9'=>'112211211',
    'A'=>'211112112',
    'B'=>'112112112',
    'C'=>'212112111',
    'D'=>'111122112',
    'E'=>'211122111',
    'F'=>'112122111',
    'G'=>'111112212',
    'H'=>'211112211',
    'I'=>'112112211',
    'J'=>'111122211',
    'K'=>'211111122',
    'L'=>'112111122',
    'M'=>'212111121',
    'N'=>'111121122',
    'O'=>'211121121',
    'P'=>'112121121',
    'Q'=>'111111222',
    'R'=>'211111221',
    'S'=>'112111221',
    'T'=>'111121221',
    'U'=>'221111112',
    'V'=>'122111112',
    'W'=>'222111111',
    'X'=>'121121112',
    'Y'=>'221121111',
    'Z'=>'122121111',
    '-'=>'121111212',
    '.'=>'221111211',
    ' '=>'122111211',
    '$'=>'121212111',
    '/'=>'121211121',
    '+'=>'121112121',
    '%'=>'111212121',
    '*'=>'121121211');
    
    }
    
    function checksum( $string )
    {
        $checksum = 0;
        $length   = strlen( $string );
        $charset  = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-. $/+%';
 
        for( $i=0; $i < $length; ++$i )
        {
            $checksum += strpos( $charset, $string[$i] );
        }
 
        return substr( $charset, ($checksum % 43), 1 );
    }
    function draw($str,$checksum=false){
        //global $unit,$x,$Code39,$height,$bw;
        $Code39=$this->Code39;
        $unit='px';//Unit
        $bw=3;//bar width
        $height=50*$bw;// px
        $x=4*$bw;
        $y=2.5*$bw;
        
        
        
        $str=strtoupper($str);
        if ($checksum) {
            $str=$str.$this->checksum($str);
        }
        $str='*'.$str.'*';
        $long=(strlen($str)+3)*12;
        $width=$bw*$long;
        $text=str_split($str);
        $img='';
        $img.= "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>\n<!DOCTYPE svg PUBLIC \"-//W3C//DTD SVG 1.1//EN\" \"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd\">\n";
        $img.= "<svg width='$width$unit' height='$height$unit' version='1.1' xmlns='http://www.w3.org/2000/svg'>\n";
        
        foreach($text as $char){
            $img.=$this->drawsymbol($char);
        }
        $img.='</svg>';
        return $img;
    }
    function drawsymbol($char){
        //global $unit,$Code39,$x,$y,$dx,$bw,$fs,$dx,$yt,$bl;
        $Code39=$this->Code39;
        $unit='px';//Unit
        $bw=3;//bar width
        $height=50*$bw;// px
        $fs=8*$bw;//Font size
        $yt=45*$bw;
        $dx=3*$bw;
        $x=4*$bw;
        $y=2.5*$bw;
        $bl=35*$bw;

        
        $x+=$bw;
        $img='';
        $img.= '<desc>'.htmlspecialchars($char)."</desc>\n";
        $xt=$x+$dx;
        $img.= "<text x='$xt$unit' y='$yt$unit' font-family='Arial' font-size='$fs'>$char</text>\n";
        $val =str_split($Code39[$char]);
        $len=9;
        for ($i=0; $i<$len; $i++){
            $num=(int)$val[$i];
            $w=$bw*$num;
            if(!($i % 2)){
                $img.= "<rect x='$x$unit' y='$y$unit' width='$w$unit' height='$bl$unit' fill='black' stroke-width='0' />\n";
            }
            $x += $w;
        }
        return $img;
    }
}

?>
