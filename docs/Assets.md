The Asset Pipeline
==================
The asset pipeline was inspired by my work with *Ruby on Rails* (RoR), although
it is nothing at all like RoR's asset pipeline.  I believe this pipeline
gives you much more control over what assets are loaded.  It is far from
perfected, but its a start.

For more information on **JavaScript**, **CSS**, **Less**, and **Bootstrap** and how they
are used within this project please refer to:
*   [JavaScript](KayoticSully/Mineshafter-Squared-Web/blob/master/docs/JavaScript.md)
*   [CSS](KayoticSully/Mineshafter-Squared-Web/blob/master/docs/CSS.md)

What is Auto-loaded?
--------------------
The assets pipeline will automatically load **application.css / application.js** and
the **css / js** file named after the controller that was loaded.

For example, on any page within the **home** controller the following files will be auto-loaded:
*   assets/css/application.css
*   assets/css/__home__.css
*   assets/javascript/application.js
*   assets/javascript/__home__.js

How to load other files?
------------------------
In order to load other asset files there are two arrays built into the MS2 Controller
class. ```php $this->javascripts```, ```php $this->css```, ```php $this->assets```
can be overriden or appended to.  This will cause the files to be loaded in the layout.
Only *file names / file paths*  relative to either *assets/javascript* or *assets/css*
should be used.  File extensions should be left off as well.

For example:
```php
// If you wanted to load both *my_awesome_asset.js* and *my_awesome_asset.css*
$this->assets[] = "my_awesome_asset";

// If you just want to load *my_awesome_asset.js*
$this->javascripts[] = "my_awesome_asset";

// If you just want to load *my_awesome_asset.css*
$this->css[] = "my_awesome_asset";
```

To keep code clean if you need to load more than one *javascript* or *css* file you can just override the *javascripts* and *css*
variables.  If you need to add more than one file to the *asset* variable do not override it unless you do not want to load
the auto-loaded files.  Instead you can do this: ```php $this->assets = array_merge($this->assets, array('awesome_asset_one', 'awesome_asset_two'));```

You can use LESS!
------------------
The asset pipeline will auto-compile less files into css for you.

Less files are stored in **assets/less**.  Anytime the pipeline comes across a possible css file, it checks for
and compiles it's less file.  The resulting css file is stored in **assets/css**.  Less compilation will **only**
happen when in **development** mode, and even then the Less file will only be compiled if the original source has
changed.