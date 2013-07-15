GoTamer sbs
===========

sbs stands for Struct to Byte slice and back to Struct

sbs can encode a struct to a byte slice and back.

This is useful if you need to save data in a key value database for example, such as the leveldb, because the leveldb only takes bytes as values.

sbs encodes your struct first to a Gob, then it convers it to a byte slice, and it reverses the process for encoding.


#### Example
```
type Foo struct {
	A int
	B string
}

p := &Foo{111,"A string"}

byteslice, err := sbs.Enc(p)
...

foo := new(Foo)
structobject, err := sbs.Dec(foo, byteslice)
...
```

Code is available at <https://bitbucket.org/gotamer/sbs>

________________________________________________________

#### The MIT License (MIT)

Copyright © 2013 Dennis T Kaplan <http://www.robotamer.com>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
