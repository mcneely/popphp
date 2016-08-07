popphp
======

This lists the current top PHP Projects on Github.

Prerequisites
-------------
Install Mysql and set up a User. Either give the permissions to create the database or create the database and give it rights to update the schema.

Install Composer, More at: https://getcomposer.org

Setup
-----
Clone the repo into a location of your choice.
```
git clone git@github.com:mcneely/popphp.git
```

Run the install.
```
cd popphp
composer install
```

This assumes you installed globally. Otherwise:
```
cd popphp
composer.phar install
```

This will prompts you with a few questions. Enter in the database user information when prompted.
When prompted, if you opted to go ahead and create the Database, enter the database name you created otherwise specify a database name to store the information or choose the default.

If you opted to just create the user:
```
composer run buildDB
```
This will build the database, create the tables and populated data from github.

If you created the database yourself:
```
composer run updateSchema
```
This will just create the tables and populated data from github.

Next is to either point your webserver vhost to the web directory or if you want to just run locally:
```
composer run server
```
**Please note that is NOT advisable to use this built in web server in a production environment**

The database automatically populates on install and updates. If you want to manually update run the following command:
```
composer run updateDB
```

Ideally, you would want to add the the script to a cron job either via the command above or:
```
php bin/console app:updateDB
```