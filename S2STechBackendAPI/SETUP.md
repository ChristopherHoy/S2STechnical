

# Backend Setup
## 1. MYSQL Setup

#### Installing the MYSQL Server on Ubuntu / Debian
Follow these steps to install mysql server on debial/ubuntu. Taken from [Percona Docs](https://www.percona.com/doc/percona-server/8.0/installation/apt_repo.html)
```
sudo apt install gnupg2
```
```
wget https://repo.percona.com/apt/percona-release_latest.$(lsb_release -sc)_all.deb
```
```
sudo dpkg -i percona-release_latest.$(lsb_release -sc)_all.deb
```
```
sudo percona-release setup ps80
```
```
sudo apt install percona-server-server
```

#### Create User, and database <a name="createUser">
Start the mysql server:
```
sudo service mysql start
```
```
mysql
```
<br>

Execute the following within MYSQL. This will create the required database user and grant them the correct permissions. This will also create the required database. Note that `custom_password` should be replaced with a custom password.  
```
CREATE USER 's2stechnical'@'localhost' identified by 'custom_password';
```
```
CREATE DATABASE S2STechnical;
```
```
GRANT ALL ON S2STechnical.* TO 's2stechnical'@'localhost';
```
```
FLUSH PRIVILEGES;
```


## 2. Install PHP and composer
#### Install PHP and extensions
```
sudo apt update
```
```
sudo apt install php php-cli php-fpm php-json php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-pear php-bcmath
```
#### Install composer
```
cd ~
```
```
sudo apt install curl
curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
```
```
HASH=`curl -sS https://composer.github.io/installer.sig`
```
```
php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```
```
sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

## 3. Install required packages
Navigate to the root of the project and execute the following:
```
composer update
```
```
composer install
```
If you run into an update it might be due to a missing factories folder. Just run this and then re-run `composer update` and `composer install`
```
mkdir database/factories
```

## 4. Create .env and create APP_KEY
#### Create .env
```
cp .env.example .env
```
<br>

Modify the following section of the .env file. Add the password used when the MySQL user was  [created](#createUser).
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=S2STechnical
DB_USERNAME=s2stechnical

# Modify this entry use the password created when creating database user
DB_PASSWORD=
```

#### Generate app key and run migrations
```
php artisan key:generate
```
```
php artisan migrate
```

## 5. Start the development server
```
php artisan serve
```
