![project tools logo](https://project-tools.co.uk/project-tools.png)

# Email Queue

The Laravel queue is utilised to send notification emails.

The specific command that needs to be run is:

    php artisan queue:work database --queue=emails --tries=3

This command needs to be run using one of the following methods:

1. Supervisor
2. nohup php artisan command

## 1. Supervisor

First, make sure supervisor is installed:

    apt-get install supervisor

Next, create: `/etc/supervisor/conf.d/laravelMailer.conf` with the following:

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


## 2. nohup artisan command

Alternatively, the Laravel queue command can be run with `nohup` and background `&` options and needs to be run from within the installed directory (e.g. **/var/www/html**), to ensure it runs after startup, it is recommended to place the command within: **/etc/rc.local**, remembering to specify the full absolute path for your installed directory:

	#!/bin/sh -e
	#
	# rc.local
	#
	# This script is executed at the end of each multiuser runlevel.
	# Make sure that the script will "exit 0" on success or any other
	# value on error.
	#
	# In order to enable or disable this script just change the execution
	# bits.
	#
	# By default this script does nothing.
	#
	# Adding nohup command for Laravel mail queue

	nohup php /var/www/html/artisan queue:work database --queue=emails --tries=3 &

	exit 0

To invoke the command immediately, run: `sudo /etc/rc.local`

The `php artisan queue` should now be running as a process, in the background. You can check this by running: `ps -aux | grep 'queue'`
