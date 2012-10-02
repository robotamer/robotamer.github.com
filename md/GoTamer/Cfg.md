GoTamer Cfg
===========

gotamer/cfg is a json configuration package for Go
You define your config items in your Go applications main package as a struct
gotamer/cfg creates a json template file for you, according to the struct 
definition in your main application, if it doesn't already exist.


		<div id="short-nav">
			<dl>
			<dd><code>import "/home/tamer/code/go/src/gotamer/cfg"</code></dd>
			</dl>
			<dl>
			<dd><a href="#pkg-overview" class="overviewLink">Overview</a></dd>
			<dd><a href="#pkg-index">Index</a></dd>
			</dl>
		</div>
		<!-- The package's Name is printed as title by the top-level template -->
		<div id="pkg-overview" class="toggleVisible">
			<div class="collapsed">
				<h2 class="toggleButton" title="Click to show Overview section">Overview ▹</h2>
			</div>
			<div class="expanded">
				<h2 class="toggleButton" title="Click to hide Overview section">Overview ▾</h2>
				<p>gotamer/cfg is a json configuration package</p>
<pre>* You define your config items in your application as a struct.
* You can save a json template of your struct
* You can save runtime modifications to the config
</pre>

			</div>
		</div>
		
	
		<h2 id="pkg-index">Index</h2>
		<!-- Table of contents for API; must be named manual-nav to turn off auto nav. -->
		<div id="manual-nav">
			<dl>
				<dd><a href="#Load">func Load(filename string, o interface{}) (err error)</a></dd>
				<dd><a href="#Save">func Save(filename string, o interface{}) (err error)</a></dd>
		</dl>
			<h4>Package files</h4>
			<p>
			<span style="font-size:90%">
			
				<a href="/target/cfg.go">cfg.go</a>
			
			</span>
			</p>
			<h2 id="Load">func <a href="/target/cfg.go?s=550:603#L7">Load</a></h2>
			<pre>func Load(filename string, o interface{}) (err error)</pre>
			<p>Load gets your config from the json file, and fills your struct with the option</p>
			<h2 id="Save">func <a href="/target/cfg.go?s=806:859#L16">Save</a></h2>
			<pre>func Save(filename string, o interface{}) (err error)</pre>
			<p>Save will save your struct to the given filename, this is a good way to create a json template</p>
		</div>


### Links
 * [Repository](https://bitbucket.org/gotamer/cfg "GoTamer Repository")
