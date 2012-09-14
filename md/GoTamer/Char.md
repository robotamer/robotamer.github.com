GoTamer Char
============

gotamer/char was my first Go package. One day I got to get in there in clean it up, but it works for the meantime 

####Converts characters from 

 * string to byte 
 * string to int 
 * byte   to string 
 * byte   to int 


Here is a little test program

	package main

	import "gotamer/char"

	func main() {

		var b byte
		var c string
		var i int

		a := char.NewString("h")
		b  = a.GetByte()
		c  = a.GetString()
		i  = a.GetInt()
		print(b, "\t", c, "\t", i, "\n")	
	}


###Links
 * [Pkg Documantation](http://go.pkgdoc.org/bitbucket.org/gotamer/char "GoTamer Pkg Documentation")
 * [Repository](https://bitbucket.org/gotamer/char "GoTamer Repository")

