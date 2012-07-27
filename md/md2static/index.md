

Welcome to the Markdown to Static documentation!
================================================

While everybody is going high-tech, I am going low-tech. 
Markdown to Static is a php script I created in an afternoon because I been frustrated with blogs and wikis.

It takes markdown files and creates static html files according to a php layout file.  

It is all done with connvention rather then configuration.

The script lives in a root document folder. Within that root folder you have following folders:

 * **md** The Markdown folder where you write your documents. You can have subfolders too.
 * **html** The html output that is created with the md2static php script
 * **assets** For images, css, javascript etc
 * **lib** For php markdown etc

Once the files are created, since this is all done in a git repository you can just push the changes up to bidbucket or github with a simple command like:

    git push


 The script is less the 100 lines thanks to the libraries php-markdown, Aura/View and PHPTamer

Please report bugs __see link on the right__ and if you make it better, please remember to share.


![RoboTamer](/assets/img/robotamer.gif "RoboTamer")