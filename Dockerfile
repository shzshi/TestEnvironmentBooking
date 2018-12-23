FROM tutum/lamp:latest
RUN rm -fr /app && git clone https://github.com/shzshi/TestEnvironmentBooking.git /app
#ADD /app/init_db.sh /tmp/init_db.sh
RUN chmod -R 755 /app/init_db.sh &&\
/app/init_db.sh
EXPOSE 80 3306
CMD ["/run.sh"]