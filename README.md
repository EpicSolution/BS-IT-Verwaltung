# BS-IT-Verwaltung
Verwaltung der It Infrastruktur der Martin Segitz Schule 

Installation
------------

### Lokal MySQL Server starten mit docker

Docker installieren: https://docs.docker.com/get-started/#images-and-containers

```bash
$ bin/mysql start
```

dann diesen Teil in parameters.yml reinkopieren

parameters:
    database_host: 127.0.0.1
    database_port: 3306
    database_name: IT_Verwaltung
    database_user: root
    database_password: root
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: ThisTokenIsNotSoSecretChangeIt

### Lokal Webserver starten

```bash
$ composer install
$ php bin/console server:start
$ open http://localhost:8000/
```

### Assets Instrallieren

css, img, js unter src/AppBundle/Resources/public ablegen

dann diesen Befehl ausführen 

```bash
$ php bin/console assets:install
```

### User angelegen per Befehl

```bash
$ php bin/console fos:user:create
```
### Datenbank anlegen
```bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:create
```


