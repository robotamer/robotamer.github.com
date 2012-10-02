GoTamer Cfg
===========

gotamer/cfg is a json configuration package for Go
You define your config items in your Go applications main package as a struct
gotamer/cfg creates a json template file for you, according to the struct 
definition in your main application, if it doesn't already exist.


package cfg
    import "gotamer/cfg"

gotamer/cfg is a json configuration package

 * You define your config items in your application as a struct.
 * You can save a json template of your struct
 * You can save runtime modifications to the config

### FUNCTIONS

	func Load(filename string, o interface{}) (err error)
Load gets your config from the json file, and fills your struct with the option

	func Save(filename string, o interface{}) (err error)	
Save will save your struct to the given filename, this is a good way to create a json template


### Links
 * [Repository](https://bitbucket.org/gotamer/cfg "GoTamer Repository")
