# osTicket-v1.9
osTicket v1.9.12 with setup

Install and enable required PHP IMAP module on Ubuntu Server
$ apt-get install php5-imap
$ php5enmod imap

MariaDB create database and user and grant privileges, change PASSWORD
CREATE USER 'osticket_app'@'localhost' IDENTIFIED BY 'PASSWORD';
GRANT ALL PRIVILEGES ON osticket.* TO 'osticket_app'@'localhost';

Install required osTicket plugins to folder:
include/plugins

Install languages (de, es, ro) to folder:
include/i18n
use extract.php to extract from language phar file

Change CSS to match crobo

Admin Panel:
Enable API 
Configure email POP for tech-support@crobo.com

Configure cron to run every 5 min to fetch emails:

*/5 * * * * nobody php /var/www/crobo.com/subdomains/ticket/api/cron.php
