FROM ubuntu:18.04
ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update -y \
&&  apt-get -y install apache2


EXPOSE 8080

CMD ["/usr/sbin/apachectl","-D","FOREGROUND"]
