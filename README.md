Mineshafter-Squared Documentation
=================================

###Project Status: In Early Development
For a more in depth look at what is done and what is planned please reference the [Status](Mineshafter-Squared-Web/blob/master/docs/Status.md) page.

Not much is currently done, feel free to email me if you want to help and need to know what to work on.  A lot of the authentication code I will pull
over from the current site when I have a chance.  I am still working out the new database structure.

Table of Contents
------------------
1.  [Getting Started](#getting-started)
2.  [Contributing](#contributing)
3.  [Coding Philosophy](#our-coding-philosophy)
4.  [The Asset Pipeline](Mineshafter-Squared-Web/blob/master/docs/Assets.md)
    *   [Auto-loading](Mineshafter-Squared-Web/blob/master/docs/Assets.md#what-is-auto-loaded)
    *   [Loading Other Files](Mineshafter-Squared-Web/blob/master/docs/Assets.md#how-to-load-other-files)
    *   [Using LESS](Mineshafter-Squared-Web/blob/master/docs/Assets.md#you-can-use-less)
5.  [CSS and LESS](Mineshafter-Squared-Web/blob/master/docs/CSS.md)
    *   [Autoloaded Files](Mineshafter-Squared-Web/blob/master/docs/CSS.md#auto-loaded-files)
    *   [LESS Utilities](Mineshafter-Squared-Web/blob/master/docs/CSS.md#specific-less-utilities)
        *   [Colors](Mineshafter-Squared-Web/blob/master/docs/CSS.md#colors-colorsless)
6.  [JavaScript](Mineshafter-Squared-Web/blob/master/docs/JavaScript.md)
    *   [Autoloaded Files](Mineshafter-Squared-Web/blob/master/docs/JavaScript.md#auto-loaded-files)
    *   [Object Oriented](Mineshafter-Squared-Web/blob/master/docs/JavaScript.md#object-oriented-javascript)
6.  [Views](Mineshafter-Squared-Web/blob/master/docs/Views.md)
    *   [Default View](Mineshafter-Squared-Web/blob/master/docs/Views.md#default-view)

Getting Started
---------------
To get this project up and running on a Windows machine you will need to install the following:
*   __PHP__ - The project assumes that you have PHP installed at _C:\php_. If you have it installed in a different location, or want to install it elsewhere, you will need to modify the _start-server.bat_ file and replace the two instance of _C:\php_ with your desired location.
*   __MySQL__ - You need to install MySQL and set your database storage location to the database folder in this project.  If you need to set up a root password I am using _ms2dev_ as the MySql password on this project.
    *   You need to copy the contents of **database\data** to **C:\ProgramData\MySQL\MySQL Server 5.5\data**. (You will need to do this anytime there is a database update).
    *   Alternatively you can set **datadir** in your MySql config file to the location of **database\data** on your computer. (This prevents you from having to do anything ever again).
*   __OpenSSL__ - If you are getting errors talking about issues with _curl_ try installing OpenSSL.

[NGINX](http://www.nginx.org/) is the web server of choice and this repo comes with a fully configured NGINX environment. Just double click the **start-server.js** file and navigate to _http://localhost_ in your browser.

### Once The Server is Started
 **Site:** [localhost](http://localhost)
 **Database Management:** [phpMyAdmin](http://localhost:8080)

Contributing
------------
If you want to help develop the site there are a few things I would ask you to do / follow:
*   __[Follow The Code Igniter Style Guide for PHP](http://ellislab.com/codeigniter/user-guide/general/styleguide.html)__ - This is a very good clean coding style and want to keep this project as readable and maintainable as possible.
*   __[Follow the idiomatic.js Style Guide for JavaScript](https://github.com/rwldrn/idiomatic.js)__ - This is another great read for keeping JavaScript style consistent.  When in doubt, follow what this guide says.
*   __Comment Everything__ - Comments help everyone understand what you did, how, and why.  Please try to leave useful comments and keep with the commenting style of the rest of the project.
*   __Create Issues__ - If you find a bug, or have an idea for a feature, please create a GitHub Issue for it.  This will help us keep track of everything that is important in maintaining and evolving the site and service.
*   __Update Documentation__ - If you find an area of the documentation that is hard to follow or is misleading please add to or refine the document.  Also make sure to update documentation for anything you change or add.
*   __Follow Our Coding Philosophy__ - There is a general philosophy we follow when approaching code, it would be nice if you could become familiar with it.

Our Coding Philosophy
---------------------
There are a few guiding principles I like to follow when programming.
*   __Keep It Simple__ - Simple code is preferred over complex and convoluted code.  This is simple to follow, break lines up if they get too long and use short, meaningful names for variables and functions.
*   __HTML is NOT for Structure__ - HTML should describe data, that is it.  Use descriptive HTML 5 tags to describe what data the page is displaying.  Grouping items only as it logically makes sense.
*   __CSS IS for Structure__ - CSS should be used to structure the webpage and control how it looks.  A webpage should be able to entirely change it's layout only by modifying its CSS.  This makes sure the site can be modified to accommodate any future changes with minimal changes anywhere else on the site.