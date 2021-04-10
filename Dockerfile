FROM centos:8

RUN yum upgrade -y \
&&  yum install epel-release -y \
&&  yum update -y \
&&  yum install nginx -y


EXPOSE 8081

CMD ["nginx", "-g", "daemon off;"]
