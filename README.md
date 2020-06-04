##Test Environment Booking Tool 

This in an opensource tool written in PHP with code-ignitor(MVC). you are free to clone, do a pull request or download and use it commercially. 

This tool allows you to create environment, add multiple users, Reserve environment and admin user can approve,edit,delete the requests. 
There is calendar view to see the current reserve. Currently I am not checking the environment booking overlap. 

### Demo to play around with:
``` 
http://www.indiadevops.com/environmentbooking/

admin credentials 

user : admin@localhost.com

pass : admin@123 
```

You are welcome to reach me with suggestion and idea to improve the tool. 


### In case you find a bug/suggested improvement for Environment Booking Tool

issue tracker is available here: https://github.com/shzshi/TestEnvironmentBooking/issues


### Requirement : 
```
PHP Version : 5.3.3
Mysql : 5.1.73 
Browser : Chrome and IE-9 
```

### Installation & Configuration
```
git clone https://github.com/shzshi/TestEnvironmentBooking.git
```

### Edit config.php in directory application/config/
```
$config['base_url'] = http://www.myenvironmentbooking.com
```

### Edit database.php in directory application/config/
```
$db['default']['hostname'] = 'mysql-hostname';
$db['default']['username'] = 'mysql-username';
$db['default']['password'] = 'mysql-password';
$db['default']['database'] = 'mysql-database';
$db['default']['dbdriver'] = 'mysql';
```

### Edit .htaccess
```
# If your page resides at
#  http://www.example.com/mypage/test1
# then use
# RewriteBase /mypage/test1/
  
RewriteBase /

#set the path for error log
php_value error_log  /var/www/html/environmentbooking/PHP_errors.log
```

### Add database & table in mysql 
```
add testenvironmentbooking.sql to mysql database.
```