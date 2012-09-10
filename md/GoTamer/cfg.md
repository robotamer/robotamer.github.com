gotamer/cfg
===========

gotamer/cfg is a json configuration package for Go
You define your config items in your Go applications main package as a struct
gotamer/cfg creates a json template file for you, according to the struct 
definition in your main application, if it doesn't already exist.

Here is an example of how to use it:

	package main

	import (
		"gotamer/cfg" // Or bitbucket.org/gotamer/cfg
		"fmt"
	)

	var Cfg JsonCfg

	type JsonCfg struct{
		Appl       string
		Hostname   string
		ListenAddr string
		IpAddr     string
		Debug      uint
	}

	func main() {
		cfg.APPL = "cafemaker"
		err := cfg.Get(&Cfg)
		if err != nil {
			println("CONFIG: ", err)
			return
		}
	}


### Links
 * [Pkg Documantation](http://go.pkgdoc.org/bitbucket.org/gotamer/cfg "GoTamer Pkg Documentation")
 * [Repository](https://bitbucket.org/gotamer/cfg "GoTamer Repository")

_________________________________________________________

### Note & Credits
Had some help creating this package, you can read all about it at 
[Go Nuts](https://groups.google.com/forum/?fromgroups=#!topic/golang-nuts/3iYS3UNYJUo "Go Nuts")



