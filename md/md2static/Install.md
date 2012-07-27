Markdown to Static Installation
===============================

Markdown to Static is component based, why keep reinventing the wheel, right?

I don't maintain a separate repo for the md2static.php file, so the best is to just clone my site that should get you started fairly quickly.

 * git clone [my site](http://bitbucket.org/robotamer/robotamer.bitbucket.org)
 * git clone [PHP Tamer](http://robotamer.bitbucket.org/html/PHPTamer)
 * Install [Aura/View](http://github.com/auraphp/Aura.View)
 
Now you have to add PHPTamer to your php include path, unless you cloned it in to a predefined include path.

There is also a function included in PHPTamer/functions called addInclude() to runtime add include paths easily.

