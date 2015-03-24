Test Environment Booking Tool 

This in an opensource tool written in PHP with code-ignitor(MVC). you are free to clone, do a pull request or download and use it commercially. 

This tool allows you to create environment, add multiple users, Reserve environment and admin user can approve,edit,delete the requests. 
There is calendar view to see the current reserve. Currently I am not checking the environment booking overlap. 

Demo : 
http://www.indiadevops.com/environmentbooking/ 

You are welcome to reach me with suggestion and idea to improve the tool. 

PHP Version : 5.3.3
Mysql : 5.1.73
Browser : Chrome and IE-9 

git clone https://github.com/shzshi/TestEnvironmentBooking.git

Edit config.php in directory application/config/  
$config['base_url'] = http://www.myenvironmentbooking.com

Edit database.php in directory application/config/
$db['default']['hostname'] = 'mysql-hostname';
$db['default']['username'] = 'mysql-username';
$db['default']['password'] = 'mysql-password';
$db['default']['database'] = 'mysql-database';
$db['default']['dbdriver'] = 'mysql';

edit .htaccess
RewriteBase /environmentbooking/
php_value error_log  /var/www/html/environmentbooking/PHP_errors.log
