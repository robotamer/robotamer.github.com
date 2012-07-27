#!/usr/bin/env php

<?php
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$commit = FALSE;
$commit_message = 'Just another commit';
echo exec('clear');
if (isset($argv[1]) && in_array($argv[1], array('--help', '-help', '-h', 'h', '-?'))) {
	help();
}

if (isset($argv[1]) && $argv[1] == '-m' && isset($argv[2])) {
	$commit = TRUE;
	$commit_message = $argv[2];
}else{
	$commit = promptUser('Do we commit to git?', 'Y');
	$commit = trim($commit);
	if($commit == 'Y'){
		$commit = TRUE;
		$commit_message = promptUser('Commit message?', $commit_message);
	}
}

$commit_message = trim($commit_message);
if (preg_match('/[^-_@. 0-9A-Za-z]/', $commit_message)) {
	echo PHP_EOL . "\tDon't get fancy, alnum char only.".PHP_EOL.PHP_EOL;
	exit;
}

include __DIR__ . '/../lib/RoboTamer/boot.php';
include_once "lib/markdown/markdown.php";
loadFunc('a');
rmhtml();
mkdirs();
$scan = rscandir('md');
$modified = gitModified();

/**
 * Matching up the keys for scan and modified
 */
foreach($modified as $v){
	$k = array_search($v['file'], $scan);
	if($k !== FALSE) $m[$k] = $v;
}
$modified = $m;
unset($m);

S::set(require PHPL . '/composer/vendor/Aura/View/scripts/instance.php', 'V');
	S::V()->title()->set('RoboTamer ');
	S::V()->metas()->addName('description', '');
	S::V()->metas()->addName('copyright', 'Copyright 1998 - 2012');
	S::V()->metas()->addName('rating', 'General');
	S::V()->metas()->addName('author', 'Dennis T Kaplan');
	S::V()->metas()->addName('robots', 'index');
	S::V()->metas()->addName('viewport', 'width=device-width, initial-scale=1.0');
	S::V()->metas()->addHttp('Window-Target', '_top');
	S::V()->metas()->addHttp('Content-Type', 'text/html; charset=utf-8');
	S::V()->metas()->addHttp('Content-Language', 'en-US');
	S::V()->styles()->add('http://robotamer.bitbucket.org/assets/css/robotamer.css');
	S::V()->sidebar = '';

define('DS', DIRECTORY_SEPARATOR);
foreach( $scan as $k=>$mdfile ){
	$pathinfo = pathinfo($mdfile);
	$newbase  = 'html'.strstr( $pathinfo['dirname'], '/');
	if($pathinfo['extension'] = 'md' || $pathinfo['extension'] = 'php'){
		$htmlfile[$pathinfo['dirname']][$k] = $newbase . DS . $pathinfo['filename'] . '.html';
	}
}

foreach($htmlfile as $dir){
	$sidebar = $menu = '';
	$mdir = $dir;
	asort($mdir);
	foreach($mdir as $k => $menuitem){
		$name = pathinfo($menuitem, PATHINFO_FILENAME);
		if($name == 'sidebar'){
			$menu = file_get_contents($scan[$k]);
		}elseif($name != 'index'){
			$sidebar .= '<a href="/'.$menuitem.'" title="'.$name.'">'.$name.'</a><br />';
		}
	}
	$sidebar .= $menu;
	unset($mdir);
	foreach($dir as  $k => $item){
		S::V()->sidebar = 'Last modified: '. $modified[$k]['date'];
		S::V()->sidebar .= '<hr />' . $sidebar;
		S::V()->raw = Markdown(file_get_contents($scan[$k]));
		file_put_contents($item, S::V()->fetch('layout.php'));
	}
}

if($commit === TRUE){
	exec('git add .');
	exec("git commit -m 'Just another update'");
	exec("git push origin");
}else{
	echo PHP_EOL . "\tAll done!".PHP_EOL.PHP_EOL;
}

function rscandir($path = 'md', &$list = array()) {
	$path = empty($path) ? __DIR__ : $path;
	$scan = @scandir($path);

	foreach ($scan as $file) {

		if ($file == '.' || $file == '..' || $file == 'assets') continue;

		if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
			rscandir($path . DIRECTORY_SEPARATOR . $file, $list);
		} else {
			$list[] = $path . DIRECTORY_SEPARATOR . $file;
		}
	}
	return $list;
}


function mkdirs($path = 'md') {

	$scan = @scandir($path);
	foreach ($scan as $file) {

		if ($file == '.' || $file == '..' || $file == 'assets') continue;

		$mddir = $path . DIRECTORY_SEPARATOR . $file;
		if (is_dir($mddir)) {
			$htmldir = 'html'.strstr( $mddir, '/');
			if(!is_dir($htmldir)) mkdir($htmldir, 0755); 
			mkdirs($mddir);
		}
	}
}

function rmhtml($path = 'html') {

	$scan = rscandir($path);

	foreach ($scan as $file) {
		unlink($file);
	}
}

function help() {

	$i = <<<EOT

	php md2static.php <option> [arguments]

	<-h>  Print this help
	<-m> [message]   Use the given [message] as the git commit message.


EOT;
	echo $i;
	exit ;
}

function gitModified(){

	exec('git ls-tree -r --name-only HEAD md | while read filename; do echo "$(git log -1 --format="%at" -- $filename) $filename"; done', $m);

	foreach($m as $v){
		$modified[] = explode(' ', $v);
	}
	
	foreach($modified as $k=>$v){
		$modified[$k]['date']   = date ("Y-m-d" , $v[0]);
		$modified[$k]['RFC850'] = date("D, d M Y H:i:s T" , $v[0]);
		$modified[$k]['time'] = $v[0];
		$modified[$k]['file'] = $v[1];
		unset($modified[$k][0], $modified[$k][1]);
	}
	return $modified;
}

//#######################################################################
//# Function: Prompt user and get user input, returns value input by user.
//#           Or if return pressed returns a default if used e.g usage
//# $name = promptUser("Enter your name");
//# $serverName = promptUser("Enter your server name", "localhost");
//# Note: Returned value requires validation 
//#.......................................................................
function promptUser($promptStr,$defaultVal=false){;

  if($defaultVal) {                             // If a default set
     echo $promptStr. "[". $defaultVal. "] : "; // print prompt and default
  }
  else {                                        // No default set
     echo $promptStr. ": ";                     // print prompt only
  } 
  $name = chop(fgets(STDIN));                   // Read input. Remove CR
  if(empty($name)) {                            // No value. Enter was pressed
     return $defaultVal;                        // return default
  }
  else {                                        // Value entered
     return $name;                              // return value
  }
}
//========================================= End promptUser ============

?>