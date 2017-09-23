FROM tutum/lamp:latest
RUN rm -fr /app && git clone https://github.com/shzshi/TestEnvironmentBooking.git /app
ADD init_db.sh /tmp/init_db.sh
RUN /tmp/init_db.sh
EXPOSE 80 3306
CMD ["/run.sh"]