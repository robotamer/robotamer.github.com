SESSION
=======

Session for go consists of a way to preserve certain data across subsequent accesses in network related applications. 

 * Custom backends to store session data locally. 
 * Flash messages: session values that last until read. 
 * Low dependency and therefore versitile, for example, it does not depened on the go http pkg 

Built-in backends to store sessions locally: 
 * storeMap => A in memory map[string]sessions store 
 * storeLeveldb => Stores session data in a leveldb 

Simple Sample code the uses the default storeMap backend: 
```
package main

import(
	"bitbucket.org/gotamer/net/session"
	"fmt"
)

func main(){
	id := save()
	load(id)
}

func save() string {
	sess := session.New()
	sess.Set("Alias","GoTamer")
	err := sess.Save()
	Check(err)
	fmt.Println("Session Saved", sess)
	sid, err := sess.Id()
	Check(err)
	return sid
}

func load(sid string){
	sess, err := session.Load(sid)
	Check(err)
	fmt.Println("Session Load: ", sess)
}

```

Sample code the uses the leveldb backend: 
```
package main

import(
	"bitbucket.org/gotamer/net/session"
	"fmt"
)

var path = "/tmp/sessions"

func init(){
	session.StoreLeveldb(path)	
}

func main(){
	id := save()
	load(id)
}

func save() string {
	sess := session.New()
	sess.Set("Alias","GoTamer")
	err := sess.Save()
	Check(err)
	fmt.Println("Session Saved", sess)
	sid, err := sess.Id()
	Check(err)
	return sid
}

func load(sid string){
	sess, err := session.Load(sid)
	Check(err)
	fmt.Println("Session Load: ", sess)
}

```

Additional backends can be created by simply implementing following interfaces: 
```
type Store interface {
	Save(session *sessionObject) (err error)
	Load(sid string) (session *sessionObject, err error)
	Delete(sid string) (err error)
}
```

Some code has been borrowed from http://www.stathat.com/src/bingo witch is licensed also under MIT. 

Code is available at <https://bitbucket.org/gotamer> 
________________________________________________________

#### The MIT License (MIT)

Copyright © 2013 Dennis T Kaplan <http://www.robotamer.com>  
Copyright (C) 2012 Numerotron Inc.  

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
