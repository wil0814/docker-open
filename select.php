<?php
header("Content-type:text/html;charset=utf-8");

$iso = $_POST["iso"];

$server = $_POST["server"];
//新增系統
if($iso =="youbike"){
$output = shell_exec('sudo docker run --rm -p8080:80 -p8081:80 -p3306:3306 -itd william880814123/0107-test');
echo $output;
}

if($iso =="ubuntu"){
	$str = "FROM ubuntu:18.04
ARG DEBIAN_FRONTEND=noninteractive
";
    $file = fopen("Dockerfile","w+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);
}elseif($iso =="centos"){
	$str = "FROM centos:8
";
    $file = fopen("Dockerfile","w+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);

}
//新增伺服器
if($server =="nginx"){			//server判斷	
	if($iso=="ubuntu"){		// ubuntu 判斷
		$str = "RUN apt-get update -y \
&&  apt-get install nginx -y


EXPOSE 8081

CMD [\"nginx\", \"-g\", \"daemon off;\"]";
    $file = fopen("Dockerfile","a+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);

	}else{ 				// centos 判斷
	     $str = "RUN yum upgrade -y \
&&  yum install epel-release -y \
&&  yum update -y \
&&  yum install nginx -y


EXPOSE 8081

CMD [\"nginx\", \"-g\", \"daemon off;\"]";
    $file = fopen("Dockerfile","a+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);


	}
}else{
	 if($iso=="ubuntu"){             // ubuntu 判斷
                $str = "RUN apt-get update -y \
&&  apt-get -y install apache2


EXPOSE 8082

CMD [\"/usr/sbin/apachectl\",\"-D\",\"FOREGROUND\"]";
    $file = fopen("Dockerfile","a+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);

        }else{                          // centos 判斷
             $str = "RUN yum upgrade -y \
&&  yum install epel-release -y \
&&  yum update -y \
&&  yum install httpd httpd-tools -y


EXPOSE 8082

CMD [\"/usr/sbin/httpd\",\"-D\",\"FOREGROUND\"]";
    $file = fopen("Dockerfile","a+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);


	}
}





//列出 Dockerfile內容
//$filename = "Dockerfile";
//$str = "";
//判斷是否有該檔案
//if(file_exists($filename)){
//    $file = fopen($filename, "r");
//    if($file != NULL){
        //當檔案未執行到最後一筆，迴圈繼續執行(fgets一次抓一行)
//        while (!feof($file)) {
//		$str .= fgets($file);
//        }
//        fclose($file);
//    }
//}


$output = shell_exec('RET=`sudo docker build -t dockerfile .`;echo $RET');

//echo'<pre>';
//echo $output;
//echo $str; ##dockerfile 內容
//echo'</pre>';
if($server == "nginx"){
	$output = shell_exec('RET=`sudo docker run --rm -p8081:80 -d dockerfile`;echo $RET');

}else{
	$output = shell_exec('RET=`sudo docker run --rm -p8082:80 -d dockerfile`;echo $RET');

}
//$output = shell_exec('RET=`docker run --rm -p8080:80 -d dockerfile`;echo $RET');
//echo $output;
?>




