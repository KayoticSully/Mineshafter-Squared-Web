Mineshafter-Squared Documentation
=================================

Table of Contents
------------------
1.  [Getting Started](#getting-started)
2.  [Contributing](#contributing)
3.  [The Asset Pipeline](docs/Assets.md)
    *   [Auto-loading](docs/Assets.md#what-is-auto-loaded)
    *   [Loading Other Files](docs/Assets.md#how-to-load-other-files)
    *   [Using LESS](docs/Assets.md#you-can-use-less)
4.  [CSS and LESS](docs/CSS.md)
    *   [Autoloaded Files](docs/CSS.md#auto-loaded-files)
    *   [LESS Utilities](docs/CSS.md#specific-less-utilities)
        *   [Colors](docs/CSS.md#colors-colorsless)
5.  [JavaScript](docs/JavaScript.md)
    *   [Autoloaded Files](docs/JavaScript.md#auto-loaded-files)
    *   [Object Oriented](docs/JavaScript.md#object-oriented-javascript)

Getting Started
---------------
To get this project up and running on a Windows machine you will need to install the following:
*   __PHP__ - The project assumes that you have PHP installed at _C:\php_. If you have it installed in a different location, or want to install it elsewhere, you will need to modify the _start-server.bat_ file and replace the two instance of _C:\php_ with your desired location.
*   __MySQL__ - You need to install MySQL and set your database storage location to the database folder in this project.  If you need to set up a root password I am using _ms2dev_ as the MySql password on this project.
*   __OpenSSL__ - If you are getting errors talking about issues with _curl_ try installing OpenSSL.

NGINX is the web server of choice and this repo comes with a fully configured NGINX environment. Just double click the start-server.js file and navigate to _http://localhost_ in your browser.

Contributing
------------
If you want to help develop the site there are a few things I would ask you to do / follow:
*   __[Follow The Code Igniter Style Guide](http://ellislab.com/codeigniter/user-guide/general/styleguide.html)__ This is a very good clean coding style and want to keep this project as readable and maintainable as possible.
*   __Comment Everything__  Comments help everyone understand what you did, how, and why.  Please try to leave useful comments and keep with the commenting style of the rest of the project.
*   __Create Issues__ If you find a bug, or have an idea for a feature, please create a GitHub Issue for it.  This will help us keep track of everything that is important in maintaining and evolving the site and service.
*   __Update Documentation__ If you find an area of the documentation that is hard to follow or is misleading please add to or refine the document.  Also make sure to update documentation for anything you change or add.