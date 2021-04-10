<?php
$output = shell_exec('sudo docker run --rm -p8080:80 -p8081:80 -p3306:3306 -itd william880814123/0107-test');
//$content = system('sudo docker images', $ret);

//$output = shell_exec('RET=`sudo docker images`;echo $RET');
echo $output;


?>
