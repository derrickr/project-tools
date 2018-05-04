![project tools logo](https://project-tools.co.uk/project-tools.png)

# Laravel .env file

An example **.env** file is located within the root of the Laravel install, called: **.example.env** Copy this file and save as **.env** in the root of the Laravel installation directory.

Whilst in the root of your installation, use the following command to generate a new **app_key** for your installation: `php artisan key:generate`

The output of the above should generate your new key:
`Application key [Idgz1PE3zO9iNc0E3oeH3CHDPX9MzZe3] set successfully.`
which should then be pasted into your **.env** file:

	APP_NAME="Project Tools"
	APP_ENV=production
	APP_KEY=Idgz1PE3zO9iNc0E3oeH3CHDPX9MzZe3
	APP_DEBUG=false
	APP_LOG_LEVEL=debug
	APP_URL='Insert your IP or domain name here'

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=Insert your database name here
	DB_USERNAME=Insert your database user name here
	DB_PASSWORD=Insert your database user's password here

	BROADCAST_DRIVER=log
	CACHE_DRIVER=file
	SESSION_DRIVER=file
	QUEUE_DRIVER=sync

	REDIS_HOST=127.0.0.1
	REDIS_PASSWORD=null
	REDIS_PORT=6379

	MAIL_DRIVER=smtp
	MAIL_HOST=Insert your SMTP mail provider here
	MAIL_PORT=2525
	MAIL_USERNAME=Insert your mail user name here
	MAIL_PASSWORD=Insert your mail user's password here
	MAIL_ENCRYPTION=null

	PUSHER_APP_ID=
	PUSHER_APP_KEY=
	PUSHER_APP_SECRET=

It has been recommended to keep the **APP_DEBUG** setting in sync with the **APP_ENV** setting, i.e. false for production and true for development / local.

All other above settings should be self explanatory.