# Ergastolator Website Redesign v20 Source Code

### Requirements

* A web server with mod_rewrite enabled
* At least PHP 5.5 (it might change after designing the dashboard)
* The following PHP modules: curl, session, mysqli (it might change after designing the dashboard)

### Installation
Just upload all the files in your public_html / htdocs / yourdomain folder. If you don't want the registration and login feature, remove register.php, registerSuccess.php, login.php and activate.php from the files list. If you want to use the registration feature, sign up for a Google account, go to google.com/recaptcha and click on "Admin console", then add a new website, and on the register.php file, on `data-sitekey` change the default value to the new site key, and on `secret` put the new secret key, then change the mails and messages added in there with your own (if you at least know how to code using PHP). After that, if you don't want to use the registration feature, don't edit the database. If you want to use it, use this command on the phpMyAdmin / MySQL CLI interface on the database to add the necessary table and fields:
```
CREATE TABLE users (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT;
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        activation_code VARCHAR(50) DEFAULT ''
);
```
and edit the inc/dbconfig.php file to include the new database host, database name, username and password. That's it for now!