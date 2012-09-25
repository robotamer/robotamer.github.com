GoTamer gowatch
===============

GoTamer gowatch is a fork of bitbucket.org/jzs/buildwatch with some enhancements

It watches your dev folder for modified files, and if a file changes it restarts the process.  

 * `gowatch -test` will run `go test` on the folder 
 * `gowatch -build` will run `go build` on the folder 
 * `gowatch -run [program_name]` will run `go build` and then it will execute [program_name] 

If a file changes while running lets say `gowatch -run [program_name]` it will kill [program_name], run `gowatch -build` on the folder, and then restart [program_name]

### Links
 * [Website](http://www.robotamer.com/html/GoTamer "GoTamer Website")
 * [Pkg Documentationn](http://go.pkgdoc.org/bitbucket.org/gotamer/gowatch "Pkg Documentation")
 * [Repository](https://bitbucket.org/gotamer/gowatch "Repository")
