# Resources

* [docs](https://www.anuko.com/time-tracker/features.htm) - detailed documentation about this project (needs updating).
* [forum](https://www.anuko.com/forum/viewforum.php?f=4) - general discussion.


# Reporting Bugs

* GitHub users: create a [new issue](https://github.com/anuko/timetracker/issues) here.
* Forum users: post a [new topic](https://www.anuko.com/forum/viewforum.php?f=4) here.
* Or, send us a [message](https://www.anuko.com/contact.htm).


# Reporting Security Issues

* Use the [contact form](https://www.anuko.com/contact.htm) to report a vulnerability.
* Or send an encrypted email to security_at_anuko_dot_com. Public key to be published soon.


# Setting up a Dev Environment

Docker users: install both docker and docker-compose, then run a dev instance:
```bash
docker-compose up
```
Create configuration file and replace DSN string:
```bash
cp ./WEB-INF/config.php.dist ./WEB-INF/config.php && RUN sed -i "s|mysqli://root:no@localhost/dbname|mysqli://anuko_user:anuko_pw@anuko_db/timetracker|g" ./WEB-INF/config.php
```
Navigate to: http://localhost:8080 to use Time Tracker. Default credentials for initial login are:
```
usr: admin
psw: secret
```

Without docker, perform a manual install of a web server, php, database server, and Time Tracker. Full installation and setup guide can be found [here](https://www.anuko.com/time-tracker/install-guide/index.htm).
