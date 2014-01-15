<?php
    function check($str){
        $code=str_split($str);
        $sum=$code[0]*10+$code[1]*9+$code[2]*8+$code[3]*7+$code[4]*6+$code[5]*5+$code[6]*4+$code[7]*3+$code[8]*2;
        $sum=11-($sum %11);
        if ($sum==10){
            $sum='X';
        }
        return $sum;
    }
    echo check('020135341')
?>
