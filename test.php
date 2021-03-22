<?php 
$output = shell_exec('RET=`docker build -t 010131 .`;echo $RET');
echo $output;
?>
