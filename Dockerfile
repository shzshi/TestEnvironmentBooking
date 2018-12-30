FROM tutum/lamp:latest
#RUN rm -fr /app && git clone https://github.com/shzshi/TestEnvironmentBooking.git /app
#ADD /app/init_db.sh /tmp/init_db.sh
RUN rm -fr /app && git clone https://github.com/shzshi/TestEnvironmentBooking.git /app \
    && echo "mysqld_safe &" > /tmp/config \
    && echo "mysqladmin --silent --wait=10 ping || exit 1" >> /tmp/config \
    && echo "mysql -e 'GRANT ALL PRIVILEGES ON *.* TO \"root\"@\"%\" WITH GRANT OPTION;'" >> /tmp/config \
    && echo "mysql -u root < /app/testenvironmentbooking.sql" >> /tmp/config \
    && bash /tmp/config \
    && rm -f /tmp/config
#RUN chmod a+x /app/init_db.sh
#RUN /app/init_db.sh
EXPOSE 80 3306
CMD ["/run.sh"]