<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
    <?php
        //Create SVG in main directory before run this cript.
        include 'EAN13example.php';
        $dir=getcwd ();
        $code=893603602000;
        for($i=1;$i<=100;$i++){
            $code++;
            $write =fopen($dir.'/SVG/'.$code.'.svg', 'w');
            $b= fwrite($write,draw($code));
            fclose($write);
        }
        //                echo "<object data='ean13example.php?code=$code' type='image/svg+xml'></object> \n";
                                   
    ?>
</body>
</html>
