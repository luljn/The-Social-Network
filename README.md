# Project title.

The-Social-Network

The title of this project is a tribute to the film of the same name which tells the story of the creation of the platform which brought us into the era of modern social networks.


# Project description.

A social network implemented with basics web languages and basic features.


# Technologies and tools used.

- HTML. <a href="https://developer.mozilla.org/fr/docs/Web/HTML"><img src="https://skillicons.dev/icons?i=html" width="30" height="30"/></a>
- CSS. <a href="https://developer.mozilla.org/fr/docs/Web/CSS"><img src="https://skillicons.dev/icons?i=css" width="30" height="30"/></a>
- Bootstrap. <a href="https://getbootstrap.com/"><img src="https://skillicons.dev/icons?i=bootstrap" width="30" height="30"/></a>
- PHP programming language. <a href="https://www.php.net/"><img src="https://skillicons.dev/icons?i=php" width="30" height="30"/></a>
- JavaScript programming language. <a href="https://developer.mozilla.org/fr/docs/Web/JavaScript"><img src="https://skillicons.dev/icons?i=js" width="30" height="30"/></a>
- jQuery. <a href="https://jquery.com/"><img src="https://skillicons.dev/icons?i=jquery" width="30" height="30"/></a>
- Chart.js . <a href="https://www.chartjs.org/"><img src="https://www.chartjs.org/media/logo-title.svg" alt="chartjs" width="30" height="30"/></a>
- MySql (with phpMyAdmin). <a href="https://www.mysql.com/"><img src="https://skillicons.dev/icons?i=mysql" width="30" height="30"/></a>


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


## Authors.

- MBECK MBOH Lula Jonathan (Luljn) : Full-stack developer and Database administrator.
- SELATCHOM GOHUI O'neal Landry (OnealSel) : Database administrator.