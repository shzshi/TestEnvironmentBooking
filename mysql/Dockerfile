FROM mysql:5.6
COPY ./my.cnf /etc/mysql/conf.d/
MAINTAINER Shashikant Bangera @shzshi

ENV MYSQL_DATABASE=cg_apiserver \
    MYSQL_ROOT_PASSWORD=root

ADD ./testenvironmentbooking.sql /docker-entrypoint-initdb.d

EXPOSE 3306
