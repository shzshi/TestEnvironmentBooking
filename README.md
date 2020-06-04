# Test Environment Booking Tool 

This in an opensource tool written in PHP with code-ignitor(MVC). you are free to clone, do a pull request or download and use it commercially. 

This tool allows you to create environment, add multiple users, Reserve environment and admin user can approve,edit,delete the requests. 
There is calendar view to see the current reserve. Currently I am not checking the environment booking overlap. 

### Features 

- Environment Booking
- Environment Scheduling
- Calendar View
- User Registeration and Login

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
PHP Version : 5.6 and above
Mysql : 5.1.73
Browser : Chrome and IE-9 
```

### Installation & Configuration

#### Quick and Easy 

you can quickly stand up environment booking with docker , please please follow the steps for the same 

- Git Clone the repo 

```
git clone https://github.com/shzshi/TestEnvironmentBooking.git
```

- Run Docker Compose 

Just run the docker-compose , this should stand up the EBT locally for you. 

```
docker-compose up --build -d 

```

Once docker-compose sucessfully creates the containers , you should be able to access the tools 

- url : http://localhost/ebt/

##### admin credentials 

user : admin@localhost.com
pass : admin@123 

#### Manual Setup

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
<IfModule mod_rewrite.c>
  RewriteEngine On
  # !IMPORTANT! Set your RewriteBase here and don't forget trailing and leading
  #  slashes.
  # If your page resides at
  #  http://www.example.com/mypage/test1
  # then use
  # RewriteBase /mypage/test1/
  RewriteBase /ebt/
  # RewriteCond %{REQUEST_FILENAME} !-f
  #RewriteCond $1 !^(index\.php|images|stylesheets|scripts|robots\.txt)
  # RewriteCond %{REQUEST_FILENAME} !-d
  #RewriteRule ^(.*)$ index.php?/$1 [L]
  RewriteCond $1 !^(index\.php|images|css|js|robots\.txt|favicon\.ico)
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule ^(.*)$ ./index.php/$1 [L]

  php_flag display_startup_errors on
  php_flag display_errors on
  php_flag html_errors on
  php_flag  log_errors on
  #php_value error_log  /ebt/PHP_errors.log
  
</IfModule>

<IfModule !mod_rewrite.c>
  # If we don't have mod_rewrite installed, all 404's
  # can be sent to index.php, and everything works as normal.
  # Submitted by: ElliotHaughin

  ErrorDocument 404 /index.php
</IfModule>
```

### Add database & table in mysql 
```
add testenvironmentbooking.sql to mysql database.
```