CSS / LESS
==========

[Less](http://lesscss.org/) is used during development.  [Bootstrap](http://twitter.github.com/bootstrap/index.html)
is incorporated into application.css at less compile time.  There are a few
extra helpful tools that we built in that can be leveraged.

Auto loaded files
-----------------
All Less files are compiled down into a few CSS.
*   /assets/css/application.css
For bootstrap integration and any global styles for the site layout or general look.

*   /assets/css/{controler_name}.css
For anything more specific to the specific controller.

>   Note: {controler_name} is a placeholder for what controller is currently
>   getting loaded.  For example if the "home" controller is loaded for any given
>   page, then home.css will get loaded if it exists.

Further Explanation
--------------------
These compiled files are the only files that will be included on a page.  The LESS versions
of these files should be used to import and include any other less files that are relevant to
either the site as a whole or that individual page.  Smaller Less files should be used to group
styles that are related to eachother.  This way small chunks of styles can be included where
they are needed, but only ever have one copy of it.

This also keeps a constant number of styles that are linked to a page inorder to reduce
load time and keep page complexity down.  It also allows for style optimization
to be done at compile time, which is important for keeping source files organized while
yet having a very compressed and fast application.

Specific Less Utilities
------------------------
The following sections outline the different less files that exists and what utilities they
contain.  Please keep this updated with new styles as they are made.

### Colors (colors.less)
A few color classes were made to make managing background and text colors
of major sections and links.
*   .bg-graphite
*   .bg-graphite-lite
*   .bg-grass
*   .bg-sky
*   .bg-redstone

All of these use the `.bg-color(@bg, @text)` less function where `@bg`
is the background color and `@text` is the text color.  This function works
well with the bootstrap and less color modification functions. 