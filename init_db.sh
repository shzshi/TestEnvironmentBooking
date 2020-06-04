#!/bin/bash
/usr/bin/mysqld_safe &
sleep 5
mysql -u root < /app/testenvironmentbooking.sql