

Welcome to the Markdown to Static documentation!
================================================

While everybody is going high-tech, I am going low-tech. 
Markdown to Static is a php script I created in an afternoon because I been frustrated with blogs and wikis.

It takes markdown files and creates static html files according to a layout file.

It is all done with convention rather then configuration.

The script lives in a root document folder. Within that root folder you have following:

 * **md** The Markdown folder where you write your documents. You can have subfolders too
 * **html** The html output that is created with the md2static php script
 * **index.html** This is the blog like page that shows the latest modified files
 * **assets** For images, css, javascript etc
 * **lib** For php markdown etc

When you execute md2static you have the option to either just create the pages or to also add, commit and push the pages up to your host.
Since this is all done in a git repository, and all files are static you can host your site at bidbucket or github.

The script is less the 100 lines thanks to the libraries php-markdown, Aura/View and PHPTamer

Please report bugs __see link on the right__ and if you make it better, please remember to share.

