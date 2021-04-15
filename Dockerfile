FROM centos:8

RUN yum upgrade -y \
&&  yum install epel-release -y \
&&  yum update -y \
&&  yum install httpd httpd-tools -y


EXPOSE 8082

CMD ["/usr/sbin/httpd","-D","FOREGROUND"]
