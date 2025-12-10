#!/bin/bash
cd /var/www
/usr/local/bin/php artisan schedule:run >> /var/log/cron_schedule.log 2>&1
