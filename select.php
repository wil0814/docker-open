<?php

$iso = $_POST['iso'];

$server = $_POST['server'];
//新增系統
if($iso =="ubuntu"){
	$str = "FROM ubuntu:18.04
ARG DEBIAN_FRONTEND=noninteractive
";
    $file = fopen("Dockerfile","w+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);
}else{
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


EXPOSE 8080

CMD [\"nginx\", \"-g\", \"daemon off;\"]";
    $file = fopen("Dockerfile","a+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);

	}else{ 				// centos 判斷
	     $str = "RUN yum upgrade -y \
&&  yum install epel-release -y \
&&  yum update -y \
&&  yum install nginx -y


EXPOSE 8080

CMD [\"nginx\", \"-g\", \"daemon off;\"]";
    $file = fopen("Dockerfile","a+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);


	}
}else{
	 if($iso=="ubuntu"){             // ubuntu 判斷
                $str = "RUN apt-get update -y \
&&  apt-get -y install apache2


EXPOSE 8080

CMD [\"/usr/sbin/apachectl\",\"-D\",\"FOREGROUND\"]";
    $file = fopen("Dockerfile","a+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);

        }else{                          // centos 判斷
             $str = "RUN yum upgrade -y \
&&  yum install epel-release -y \
&&  yum update -y \
&&  yum install httpd httpd-tools -y


EXPOSE 8080

CMD [\"/usr/sbin/httpd\",\"-D\",\"FOREGROUND\"]";
    $file = fopen("Dockerfile","a+"); //開啟檔案
    fwrite($file,$str.PHP_EOL);
    fclose($file);


	}
}





//列出 Dockerfile內容
$filename = "Dockerfile";
$str = "";
//判斷是否有該檔案
if(file_exists($filename)){
    $file = fopen($filename, "r");
    if($file != NULL){
        //當檔案未執行到最後一筆，迴圈繼續執行(fgets一次抓一行)
        while (!feof($file)) {
		$str .= fgets($file);
        }
        fclose($file);
    }
}
echo $str;





?>

