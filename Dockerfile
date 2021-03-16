FROM ubuntu:18.04
ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update -y \
&&  apt-get install nginx -y


EXPOSE 8080

CMD ["nginx", "-g", "daemon off;"]
