# Project title.

The-Social-Network

The title of this project is a tribute to the film of the same name which tells the story of the creation of the platform which brought us into the era of modern social networks.


# Project description.

A social network implemented with basics web languages and basic features.


# Technologies and tools used.

- HTML.
- Bootstrap.
- PHP programming language.
- JavaScript programming language.
- jQuery.
- Chart.js .
- MySql (with phpMyAdmin).


# Getting start with the web application.

- Install all the tools by yourself.

The project was developed using XAMPP's all-in-one web package, so you will need to install it to be able to launch the application.
Once XAMMP is installed, you have two choices: use a virtual host or not.

If you choose to use a virtual host, you will need to change the XAMPP configuration files to be able to add one (find out how to do this on the internet). The port used for the development phase is port 4000, but you can use another (if this is the case you will have to change the port number on line 7 of the config.php file in the config subfolder of the directory models).

If you choose not to use a virtual host, you will need to clone the repository into the xampp htdocs folder on your computer. In this case you will need to change the value of the usingPort variable in the config.php file from True to False.

Concerning the database, an initialization sql file (db.sql) is available. You just have to import it into XAMPP to create and initialize the database.

You may need to change the second and third elements of the localDatabaseAccess array in the database.php file in the lib subfolder of the models directory. This information corresponds to the username and password to connect to the database.

- Use Docker.

To make things easier, you can use Docker to install all the necessary tools. You will need to edit the database.php file, replacing line 11 with : private $localDatabaseAccess = ["mysql:host=db;dbname=mbeck_selatchom_database;charset=utf8", "root", "pass"];
Then you just have to execute the commands: docker-compose build then docker-compose up from the root of the project.


# Deployment.

The site is available here : https://tsn-thesocialnetwork.000webhostapp.com/
copy this link into your web browser.


## Authors.

- MBECK MBOH Lula Jonathan (Luljn) : Full-stack developer and Database administrator.
- SELATCHOM GOHUI O'neal Landry (OnealSel) : Back-End developer and Database administrator.