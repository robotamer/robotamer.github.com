GoTamer JGDB
=============

JGDB stands for Json Git Database
---------------------------------

About the implementation:
-------------------------

### Object Types

 * Tuple (In Memory Database) *Beta*
 * List (Single file persistent database) *Beta*
 * Object (Multi file persistent database) *Alpha*
 * Cache (Cache for Tuple) *Not yet implemented*

### Backends

 * Json *Beta*
 * Glob *Not yet implemented*
 * SQLite *Not yet implemented*

The major distinction between *List* and *Object* is that one, the *List type* uses a single file as backend with each record placed in one line.  
Where as the *Object* type keeps each record in a separate file. The object type is/will keep track of these records with an index file, and also optionally with a strtree for fast in memory access. 

### How the List type works:
1. The user creates a struct to his/her needs
2. The database inherits that struct via an *Interface*
3. The database converts that struct to include the map id using *jsonListStruct*
4. jsonListStruct struct is used to Marshal the data in to a json file

### What is planed so far:
1. Create a cache system with a user defined limit that keeps the most asked for items in a Tuple.
2. Create the git backup 
3. Distribute with git push and pull 

### Disadvantage:
git is not the fastest distribution system

### Advantage:
1. All data is kept in plain text/json
2. Backups are incremental, I can't think of anything better then git to make backups.
3. Distributed system. without the need for the master and slave concept.
4. Every node is independent
5. Database can get very big, bigger then what the memory can hold, and we will read less active data with io.Reader and bufio


### FAQ
> To get a proper distributed system you need a merge strategy for your git repositories. How would you solve conflicts?

As with everything I am open to suggestions, meanwhile I am planing following:  
The strategy will differ by List or Object type database.   
For example the List type database will not have any update only insert and delete. 
The insert operation will easily be resolved by git, when nodes do their pull, save, add, commit and push cycle.

When it comes to the delete operation, every node will before deleting a record, add lock on the file it plans to modify. Each node will be able to lock a file at pull time.
This means other nodes can still modify and commit all other files, just not the one locked by a node.
The lock will have a time limit as it does only takes a short time to perform a full cycle of pull, save, add, commit and push with git. 


### Links
 * [Website](http://www.robotamer.com/html/GoTamer/JGDB.html "GoTamer Website")
 * [Forum](http://www.robotamer.com/forum.html "GoTamer Forum")
 * [Pkg Documantation](http://go.pkgdoc.org/bitbucket.org/gotamer/jgdb "GoTamer Pkg Documentation")
 * [Repository](https://bitbucket.org/gotamer/jgdb "GoTamer Repository")
 * [Bug Tracking](https://bitbucket.org/gotamer/jgdb/issues "Bug Tracking")
 
