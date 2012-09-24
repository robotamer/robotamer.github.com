GoTamer JGDB
=============

JGDB stands for Json Git Database
---------------------------------

This code is in Alpha state and only here for the good people from go-nuts who are helping to implement this
------------------------------------------------------------------------------------------------------------

About the implementation:
-------------------------
I am using a backend that supports stings as well as numbers as key, as well as as values.
The backend is json.

There are two types of backends the *List* and the *Object* type database.  
The major distinction between those backends is that one, the *List type* uses a single file as backend with each record placed in one line.  
Where as the *Object* type keeps each record in a separate file. The object type is/will keep track of these records with an index file, and also optionally with a strtree for fast in memory access. 

### How the List type works:
1. The user creates a struct to his/her needs
2. The database inherits that struct via the *Struct Interface*
3. The database converts that struct to include the map id using *jsonListStruct*
4. jsonListStruct struct is used to Marshal the data in to a json file

### What is planed so far:
1. Create a cache system with a user defined limit that keeps the most asked for items in memory.
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

When it comes to the delete operation, every node will before deleting a record, add a file based lock system, each node will be able to lock a file at pull time.
This means other nodes can still modify and commit all other files, just not then one locked by a node.
The lock will have a time limit as it does only takes a short time to perform a full cycle of pull, save, add, commit and push with git. 


### What I need help with
 * I need a way to iterate and find items in the database. If you are inspecting the code, the implementation is in the List type database. [list.go](https://bitbucket.org/gotamer/jgdb/src/c84756c2ff6b/list.go) The problem is that I need to keep the Struct interface, and need to implement the iteration without adding other interfaces. At leased I think that this is the problem. Help would be very welcome on this. There is something we have been playing with at [go play](http://play.golang.org/p/Bg7PrF5m53 "Go Play"). The disgusting about this is at [Go Nuts](https://groups.google.com/forum/?fromgroups=#!topic/golang-nuts/XuWuPBbT66g)



### Links
 * [Pkg Documantation](http://go.pkgdoc.org/bitbucket.org/gotamer/jgdb "GoTamer Pkg Documentation")
 * [Repository](https://bitbucket.org/gotamer/jgdb "GoTamer Repository")
 
