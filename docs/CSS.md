CSS / LESS
==========

[Less](http://lesscss.org/) is used during development.  [Bootstrap](http://twitter.github.com/bootstrap/index.html)
is incorporated into application.css at less compile time.  There are a few
extra helpful tools that we built in that can be leveraged.

Auto-Less Compilation
----------------------
Less Files are automatically compiled to css for you while the website is in *development* mode.  The corresponding LESS
file of a CSS file that would be [Auto-Loaded](Assets.md) will be auto-compiled along with any LESS scripts that are imported
into those files. (If this is confusing please let me know, but I think you get the idea).

Auto loaded files
-----------------
All Less files are compiled down into a few CSS.
*   __/assets/css/application.css__ For bootstrap integration and any global styles for the site layout or general look.
*   __/assets/css/{controler_name}.css__ For anything more specific to the individual controller.

>   Note: {controler_name} is a placeholder for what controller is currently
>   getting loaded.  For example if the "home" controller is loaded for any given
>   page, then home.css will get loaded if it exists.

### Further Explanation
These compiled files are the only files that will be included on a page.  The *LESS* versions
of these files should be used to *import* and include any other *less* files that are *relevant* to
either the site as a whole or that individual page.  **Small Less files** are preferred and should
be used to group  styles that are related to each other.  This way small chunks of styles can be
included only where they are needed.  This keeps CSS code manageable and easy to maintain.

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