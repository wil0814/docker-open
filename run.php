<?php
$output = shell_exec('docker run --rm -p8080:80 -p8081:80 -p3306:3306 -itd william880814123/0107-test');
echo $output;


?>
