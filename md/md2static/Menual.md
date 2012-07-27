Markdown to Static
==================

Menual
--------

There are two ways to use Markdown to Static

 * Giving a command and argument at the command line
 * Interactive answering a couple of questions on the command line

The options have to do with git, if you like to commit and what the commit message should be.

###Interactive

    php md2static.php 
	
You will be asked:

1. Do we commit to git?[Y] :
2. Commit message?[Just another commit] :

###Command line

To commit to git:

    php md2static.php -m My commit message

Not to commit to git:

    php md2static.php -s
	
Actually any command without an argument will just create and save the pages but not add, commit and push to git 

That is it, could it be any simpler?