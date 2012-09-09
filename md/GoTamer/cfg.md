gotamer/cfg
===========

gotamer/cfg is a json configuration package for Go
You define your config items in your Go applications main package as a struct
gotamer/cfg creates a json template file for you, according to the struct 
definition in your main application, if it doesn't already exist.


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
		err := cfg.Get(Cfg)
		if err != nil {
			println("Handle your errors: ", err)
			return
		}
		fmt.Printf("%s", Cfg)
	}


###Links
 * [Pkg Documantation](http://go.pkgdoc.org/github.com/gotamer/cfg "GoTamer Pkg Documentation")
 * [Repository](https://bitbucket.org/gotamer/cfg "GoTamer Repository")



###Note
Had some help creating this package, you can read all about it at 
[Go Nuts](https://groups.google.com/forum/?fromgroups=#!topic/golang-nuts/3iYS3UNYJUo "Go Nuts")


_________________________________________________________


Copyright (c) 2012 The GoTamer Authors. All rights reserved.
============================================================
Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are
met:

   * Redistributions of source code must retain the above copyright
notice, this list of conditions and the following disclaimer.
   * Redistributions in binary form must reproduce the above
copyright notice, this list of conditions and the following disclaimer
in the documentation and/or other materials provided with the
distribution.
   * Neither the name of GoTamer nor the names of its
contributors may be used to endorse or promote products derived from
this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
"AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.