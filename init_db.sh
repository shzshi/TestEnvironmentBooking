#!/bin/bash
/usr/bin/mysqld_safe &
sleep 5
mysql -u root environmentbooking < /app/testenvironmentbooking.sql