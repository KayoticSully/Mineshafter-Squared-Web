Views
======

Default Views
--------------
By default the view file at **views/{controller}/{function}.php** will be used if no other
view is rendered within the controller's function.  This is a simple convention that is easily
overriden for debugging or any other reason.

To pass data to the default view, set the controller variable ```$this->variables``` equal to an
associative array where the key is the variable used in the view and the value is that variable's value.