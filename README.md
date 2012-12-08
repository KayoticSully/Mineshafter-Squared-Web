Mineshafter-Squared Documentation
=================================
Getting Started
---------------
To get this project up and running on a Windows maching you will need to install the following:
*   *PHP* - The project assumes that you have PHP installed at _C:\php_. If you have it installed in a different location, or want to install it elsewhere, you will need to modify the _start-server.bat_ file and replace the two instance of _C:\php_ with your desired location.
*   *MySQL* - You need to install mysql and set your databse storage location to the database folder in this project.  If you need to set up a root password I am using _ms2dev_ as the MySql password on this project.
*   *OpenSSL* - If you are getting errors talking about issues with _curl_ try installing OpenSSL.

NGINX is the webserver of choice and this repo comes with a fully configured NGINX enviornment.  Just double click the start-server.js file and navigate to http://localhost in your browser.