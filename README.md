#Setting Up Laravel
```
mkdir gitrepo
```
```
yum install php php-mcrypt php-pdo httpd mysql mysql-server php-mysqlnd php-xmlrpc
```
```
service mysqld start; chkconfig mysqld on
```
```
cd /usr/local/bin; curl -sS https://getcomposer.org/installer | php; mv composer.phar composer; 
```
```
cd ~/gitrepo
```
```
composer create-project laravel/laravel --prefer-dist
```

##Staging scripts
Production:
+ deploy.sh:
```
#!/bin/bash
rm -Rf p4
git clone git@github.com:wbirkmaier/p4.git
cd p4
composer install --prefer-dist
chmod -R 777 app/storage
cd ..
```
+ stage.sh
```
#!/bin/bash
rm -Rf laravel
cp -R /home/wbirkmaier/gitrepo/test/laravel/ .
cd laravel
chmod -R 777 app/storage
```

##Sync to apache dir
+ cp ``` <project> ``` in /var/www/html 
+ replace DocumentRoot "/var/www/html" in vi /etc/httpd/conf/httpd.conf in ```<project>```/public
```
<Directory "/var/www/html">
    AllowOverride All
```
+ make sure you
```
chmod -R 777 app/storage
```
+ allow httpd with selinux
```
setsebool -P httpd_unified 1
```

##Debug environments
```
/app/config/local/app.php We set debug to true
/app/config/production/app.php We set debug to false
/app/config/app.php We set debug to false
```

##Determine Environment
vi /bootstrap/start.php

+ For all environments to get devel environment
```
$env = $app->detectEnvironment(array(

    'local' => array('*'),

));
```
+ Otherwise do this for each environment:

```
$env = $app->detectEnvironment(array(

    'local' => array('Jane-Doe-MacBook-Air.local'),
    'production' => array('ex-std-node292.prod.rhcloud.com'),

));
```

##Database Setup
```mysql -u root```

```create database wilxc;```

exit the database.

```
/usr/bin/mysql_secure_installation and say yes to all, set password

Then edit the files below:
vi /app/config/database.php
vi /app/config/local/database.php
```

```
 'mysql' => array(
                        'driver'    => 'mysql',
                        'host'      => 'localhost',
                        'database'  => 'laravel',
                        'username'  => 'root',
                        'password'  => '',
```

##Test Database
vi app/routes.php
```
Route::get('test', function()
{
    echo 'Environment: '.App::environment().'<br>';
    $results = DB::select('SHOW DATABASES;');
    echo print_r($results);
    phpinfo();
}); 
```
##Migration (Schemas)

```
php artisan migrate:make create_test_table
```
+ Run the migration
```
php artisan migrate
```

##Set up Andy Goodwin Code for laravel
In app/models add XenApi.php, case matters
```
<?php
/*
 *    PHP XenAPI v1.0
 *    a class for XenServer API calls
 *
 *    Copyright (C) 2010 Andy Goodwin <andyg@unf.net>
 *
 *    This class requires xml-rpc, PHP5, and curl.
 *
 *    Permission is hereby granted, free of charge, to any person obtaining 
 *    a copy of this software and associated documentation files (the 
 *    "Software"), to deal in the Software without restriction, including 
 *    without limitation the rights to use, copy, modify, merge, publish, 
 *    distribute, sublicense, and/or sell copies of the Software, and to 
 *    permit persons to whom the Software is furnished to do so, subject to 
 *    the following conditions:
 *
 *    The above copyright notice and this permission notice shall be included 
 *    in all copies or substantial portions of the Software.
 *
 *    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS 
 *    OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
 *    MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
 *    IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY 
 *    CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
 *    TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
 *    SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 */

class XenApi extends Eloquent 
{

```

?> can be removed from the end as well

From main code remove
```
<?
include('xenapi.php');
```

#User Authentication
app/config/session.php

```
'driver' => 'database',
```

```
php artisan session:table
```

```
php artisan migrate
```

```
php artisan migrate:make create_user_table
```

```
public function up()
	{
         Schema::create('users', function($table)
            {
                $table->increments('id');
                $table->string('username', 128)->unique();
                $table->string('password', 60);
                $table->string('email', 254)->unique();
                $table->rememberToken();
                $table->timestamps();
            });
	}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}
```


#Credits
+ PHP XenApi code from <https://github.com/andygoodwin/PHP-xenapi>
+ Bootstrap <http://getbootstrap.com/>
+ Font Awesome <https://fortawesome.github.io/Font-Awesome/>

##Tips and Trick
+ php --ini
+ phpinfo();
+ php code.php

