![project tools logo](https://project-tools.co.uk/project-tools.png)

# Project Tools Installation

The following procedure defines how to install Project-Tools on to a LAMP server stack.

Development of Project Tools was carried out on an Ubuntu LAMP server, running:

* Ubuntu 16.04 LTS
* Apache 2 v2.4.18 (Ubuntu)
* Mysql  Ver 14.14 Distrib 5.7.22
* PHP 7.0.28-0ubuntu0.16.04.1

Deployment has also since been successfully tested on the latest version of Ubuntu server (as of: 1 May 2018):

* Ubuntu 18.04 LTS
* Apache2 v2.4.29 (Ubuntu)
* Mysql  Ver 14.14 Distrib 5.7.22
* PHP 7.2.3-1ubuntu1

Although Linux command line experience is preferred, the basic commands required have been specified.


## 1.	Pre-Requisites

* LAMP stack already install and tested.

* At least 2GB RAM, for install.

* mysql database and associated user account.

* Web server service running under **/var/www/html/**

* SMTP Mail service & associated credentials.

* The following steps 2 - 6, are all run as root


## 2.	Install Composer

[Reference: https://getcomposer.org/download/](https://getcomposer.org/download/)

    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

    php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

    php composer-setup.php --install-dir=/usr/local/bin --filename=composer

*note: above hash correct as of 1 May 2018


## 3.	Install NodeJs on server

    curl -sL https://deb.nodesource.com/setup_8.x | bash -

    apt-get install -y nodejs

*note: Initial development was carried out with node 6. If the above (node 8 version) causes issues, please run the following instead:

    curl -sL https://deb.nodesource.com/setup_6.x | bash -


## 4.	Clone project from git

    cd /var/www/html/
    
    git clone git@github.com:derrickr/project-tools.git .


## 5.	Edit .env file for environment

Basic Laravel knowledge is required to configure your **.env** file.

Please refer to the **ENV.md** file for instructions regarding how to configure your **.env** file


## 6.	Install Node Package Manager

Within your installation's directory (e.g. **/var/www/html/**) run, as root:

    npm install && npm run prod

*note: On Ubuntu 18.04 LTS I found an issue with the 'npm install' failing due to 'pngquant', which I resolved by following the answer on [this stackoverflow article](https://stackoverflow.com/questions/49308545/error-with-npm-update-pngquant-binary-does-not-seem-to-work-correctly):

    sudo wget -q -O /tmp/libpng12.deb http://mirrors.kernel.org/ubuntu/pool/main/libp/libpng/libpng12-0_1.2.54-1ubuntu1_amd64.deb
    sudo dpkg -i /tmp/libpng12.deb \
    sudo rm /tmp/libpng12.deb


## 7.	Composer update

As **non-root** user, run:

    sudo chown -R derrick:derrick /var/www/html/

    composer update

*note: Replace derrick:derrick (username and group) as required for your implementation!


## 8.	Supervisor

Supervisor is required to run Laravel's artisan queue to send email 

    sudo apt-get install supervisor

Create: `/etc/supervisor/conf.d/laravelMailer.conf` with the following:

	[program:laravelMailer]
	command=php /var/www/html/artisan queue:work database --queue=emails --tries=3
	user=www-data
	autostart=true
	autorestart=true
	stderr_logfile=/var/log/laravelMailer.err.log
	stdout_logfile=/var/log/laravelMailer.out.log

_*note: absolute path required on the above 'command' line!_

Check supervisor working:

	supervisorctl reread
	supervisorctl update
	supervisorctl
		supervisor> status

The above should provide an output similar to this:

    laravelMailer                    RUNNING   pid 20479, uptime 0:06:50
    supervisor>

At which point, you can now quit supervisorctl:

		supervisor> quit

The `php artisan queue` should now be running as a process, in the background. You can check this by running: `ps -aux | grep 'queue'`


## 9.	Database Migration & Seeding

Still within **/var/www/html/**, run the following:

    php artisan migrate

    php artisan db:seed

This creates user:

* mark.smith@project-tools.co.uk
* password: Admin@2018


## 10.	Update Apache paths & permissions

Now we set the Laravel public path in Apache.

Update: `/etc/apache2/sites-available/000-default.conf` with the following: 

    DocumentRoot /var/www/html/public

    <Directory "/var/www/html/public/">
		Options Indexes FollowSymLinks
		AllowOverride All
		AuthType Basic
		AuthName "Restricted Content"
		AuthUserFile /etc/apache2/.htpasswd
		Require valid-user
    </Directory>

Next, change the owner and group of the installed directory back to `www-data`

    sudo chown -R www-data:www-data /var/www/html/

Finally, restart Apache:

    sudo systemctl restart apache2
