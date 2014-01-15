<!-- 
Document   : viewEAN13
Created on : Feb 3, 2010, 8:40:15 AM
Author     : Jungle Man
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
    <?php
        $code=893603602000;
        for($i=1;$i<11;$i++){
            for($j=1;$j<6;$j++){
                $code++;
                echo "<object data='EAN13example.php?code=$code' type='image/svg+xml' ></object> \n";
            }
            echo'<br>';
                             
        }
    ?>
</body>
</html>
