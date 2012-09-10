#!/usr/bin/env php

<?php
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('cli_server.color', TRUE);
define('DS', DIRECTORY_SEPARATOR);
$commit = FALSE;
$commit_message = 'Just another commit';
echo exec('clear');
echo PHP_EOL . "\tMarkdown to Static" . PHP_EOL . PHP_EOL;

if (isset($argv[1]) && in_array($argv[1], array('--help', '-help', '-h', 'h', '-?'))) {
	help();
}

if (isset($argv[1]) && $argv[1] == '-m' && isset($argv[2])) {
	$commit = TRUE;
	$commit_message = $argv[2];
} elseif (isset($argv[1])) {
	$commit = FALSE;
} else {
	$commit = promptUser('Do we commit to git?', 'Y');
	$commit = trim($commit);
	if ($commit == 'Y') {
		$commit = TRUE;
		$commit_message = promptUser('Commit message?', $commit_message);
	}
}

$commit_message = trim($commit_message);
if (preg_match('/[^-_@. 0-9A-Za-z]/', $commit_message)) {
	echo PHP_EOL . "\tDon't get fancy, alnum and ^-_@ char only." . PHP_EOL . PHP_EOL;
	exit ;
}

include __DIR__ . '/../lib/RoboTamer/boot.php';
include_once "lib/markdown/markdown.php";
loadFunc('a');

echo PHP_EOL . "\tScaning files ..." . PHP_EOL;
$get_file_list_array = rscandir('md');
set_html_folder_structur();

echo PHP_EOL . "\tRemoving old files ..." . PHP_EOL;
rmhtml();

echo PHP_EOL . "\tCreating new folders ..." . PHP_EOL;
mkdirs();

echo PHP_EOL . "\tGetting last modified info ..." . PHP_EOL;
$modified = gitModified();

/**
 * Matching up the keys for scan and modified
 */
foreach ($modified as $v) {
	$k = array_search($v['file'], $get_file_list_array);
	if ($k !== FALSE)
		$m[$k] = $v;
}
$modified = $m;
unset($m);

$t = time();
foreach ($get_file_list_array as $k => $v) {
	if (!isset($modified[$k])) {
		$modified[$k]['time'] = $t;
		$modified[$k]['date'] = date("Y-m-d", $t);
		$modified[$k]['RFC850'] = date("D, d M Y H:i:s T", $t);
		$modified[$k]['file'] = $v;
	}
}

S::set(
require PHPL . '/composer/vendor/Aura/View/scripts/instance.php', 'V');
S::V()->title()->set('RoboTamer ');
S::V()->metas()->addName('description', 'RoboTamer PHP code');
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

echo PHP_EOL . "\tCreating files ..." . PHP_EOL;

foreach ($put_file_structure_array as $dir) {
	$sidebar = $menu = '';
	$mdir = $dir;
	asort($mdir);
	foreach ($mdir as $k => $menuitem) {
		$name = pathinfo($menuitem, PATHINFO_FILENAME);
		if ($name == 'sidebar') {
			$menu = file_get_contents($get_file_list_array[$k]);
		} elseif ($name != 'index') {
			$sidebar .= '<a href="/' . $menuitem . '" title="' . $name . '">' . $name . '</a><br />';
		}
	}
	$sidebar .= $menu;
	unset($mdir);
	foreach ($dir as $k => $item) {
		S::V()->sidebar = 'Last modified: ' . $modified[$k]['date'];
		S::V()->sidebar .= '<hr />' . $sidebar;
		S::V()->raw = Markdown(file_get_contents($get_file_list_array[$k]));
		file_put_contents($item, S::V()->fetch('layout.php'));
	}
}

###########################################################
#                      BLOG
#----------------------------------------------------------
echo PHP_EOL . "\tCreating Blog ..." . PHP_EOL;

foreach ($get_file_list_array as $k => $file) {
	$i = getHeadline($file);
	if (!empty($i))
		$headline[$k] = $i;
}
$blog = '';

foreach ($headline as $k => $file) {
	$name = pathinfo($file, PATHINFO_FILENAME);
	$blog[$modified[$k]['time']] = $modified[$k]['RFC850'] . ' <a href="/' . $get_file_list_array[$k] . '" title="' . $name . '">' . $name . '</a><hr />' . PHP_EOL;
}

krsort($blog);
$i = '';
foreach ($blog as $v)
	$i .= $v;
$blog = $i;
unset($v, $k, $i, $e);

S::V()->title()->set('RoboTamer Blog');
S::V()->metas()->addName('description', 'News summery about RoboTamer PHP Code');
S::V()->sidebar = '';
S::V()->raw = "<h1>RoboTamer Blog</h1>" . $blog;
file_put_contents('index.html', S::V()->fetch('layout.php'));

###########################################################
#                      GIT
#----------------------------------------------------------
if ($commit === TRUE) {
	echo PHP_EOL . "\tComiting to git ..." . PHP_EOL;
	exec('git add .');
	exec("git commit -m 'Just another update'");
	exec("git push origin");
}
echo PHP_EOL . "\tAll done!" . PHP_EOL . PHP_EOL;
exit(0);

###########################################################
#                      Functions
#----------------------------------------------------------

defined('RT_FOLDER_MD') || define('RT_FOLDER_MD', 'md');
defined('RT_FOLDER_HTML') || define('RT_FOLDER_HTML', 'html');

/**
 * md2static
 */
class md2static {

	/**
	 * Single dimensional array of the destination folder structure
	 */
	private $array_list_html;

	/**
	 * Single dimensional array of the markdown folder structure
	 * [2] => md/PHPTamer/RTCrypter.md
	 */
	private $array_list_md;

	/**
	 * Multidimensional array of the destination folder structure
	 */
	private $array_tree_html;

	function __construct() {

	}

	public function run() {
		if (!$this->folder_md)
			$this->set_folder_md();
		if (!$this->folder_html)
			$this->set_folder_html();
		$this->array_md = $this->rscandir($this->folder_md);
		$this->set_html_tree_list();
	}

	public function set_folder_md($path = FALSE) {
		$this->folder_md = ($path === FALSE) ? RT_FOLDER_MD : $path;
	}

	public function set_folder_html($path = FALSE) {
		$this->folder_html = ($path === FALSE) ? RT_FOLDER_HTML : $path;
	}

	/**
	 * Scans given path recursively and returns
	 * a single dimensional array, like a list of all files
	 *
	 * @param  string  a directory on the local file system
	 * @return array   single dimensional
	 */
	function rscandir($path, &$list = array()) {

		$scan = @scandir($path);

		foreach ($scan as $item) {

			if ($item == '.' || $item == '..')
				continue;

			if (is_dir($path . DIRECTORY_SEPARATOR . $item)) {
				rscandir($path . DIRECTORY_SEPARATOR . $item, $list);
			} else {
				$list[] = $path . DIRECTORY_SEPARATOR . $item;
			}
		}
		return $list;
	}

	function set_html_tree_list() {

		foreach ($this->array_list_md as $k => $item) {

			$pathinfo = pathinfo($item);

			if ($pathinfo['extension'] = 'md' || $pathinfo['extension'] = 'php') {

				$newbase = $this->folder_html . strstr($pathinfo['dirname'], '/');

				$this->array_list_html[$k] = $newbase . DS . $pathinfo['filename'] . '.html';

				$this->array_tree_html[$pathinfo['dirname']][$k] = $newbase . DS . $pathinfo['filename'] . '.html';
			}
		}
	}

	private function rmhtml($force = FALSE) {

		$dir = $this->folder_html;

		if (is_dir($dir)) {
			if ($force === TRUE && strtolower(PHP_OS) == 'linux') {
				exec("rm -rf $dir");
			} else {
				$scan = rscandir($path);

				foreach ($scan as $file) {
					unlink($file);
				}
			}
		}
	}

	private function mkdirs() {

		if (!is_dir($this->folder_md)) {
			trigger_error('Could not find the markdown folder, are you running this file from your root doc folder?', E_USER_ERROR);
			exit(1);
		}
		if (!is_dir($this->folder_html)) {
			mkdir($this->folder_html, 0755);
		}

		$scan = @scandir($this->folder_md);
		foreach ($scan as $item) {

			if ($item == '.' || $item == '..' || $item == 'assets')
				continue;

			$mddir = $this->folder_md . DIRECTORY_SEPARATOR . $item;
			if (is_dir($mddir)) {
				$htmldir = $this->folder_html . strstr($mddir, '/');
				if (!is_dir($htmldir))
					mkdir($htmldir, 0755);
				mkdirs($mddir);
			}
		}
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

function gitModified() {

	exec('git ls-tree -r --name-only HEAD md | while read filename; do echo "$(git log -1 --format="%at" -- $filename) $filename"; done', $m);

	foreach ($m as $v) {
		$modified[] = explode(' ', $v);
	}

	foreach ($modified as $k => $v) {
		$modified[$k]['date'] = date("Y-m-d", $v[0]);
		$modified[$k]['RFC850'] = date("D, d M Y H:i:s T", $v[0]);
		$modified[$k]['time'] = $v[0];
		$modified[$k]['file'] = $v[1];
		unset($modified[$k][0], $modified[$k][1]);
	}
	return $modified;
}

/**
 * Fun goto commend (I know, I know but it's fun)
 */
function getHeadline($file) {
	$line = '';
	$i = 0;
	$name = pathinfo($file, PATHINFO_FILENAME);
	$i = substr($name, 0, 1);
	$e = strtoupper($i);
	if ($i == $e) {
		$handle = @fopen($file, "r");
		if ($handle) {
			a:
			$i++;
			$line = fgets($handle, 4096);
			$line = trim($line);
			if ($i > 5)
				trigger_error("File $file seams empty." . PHP_EOL, E_USER_NOTICE);
			if (empty($line))
				goto a;
			fclose($handle);
		}
		return $line;
	}
}

//#######################################################################
//# Function: Prompt user and get user input, returns value input by user.
//#           Or if return pressed returns a default if used e.g usage
//# $name = promptUser("Enter your name");
//# $serverName = promptUser("Enter your server name", "localhost");
//# Note: Returned value requires validation
//#.......................................................................
function promptUser($promptStr, $defaultVal = false) {;

	if ($defaultVal) {// If a default set
		echo $promptStr . "[" . $defaultVal . "] : ";
		// print prompt and default
	} else {// No default set
		echo $promptStr . ": ";
		// print prompt only
	}
	$name = rtrim(fgets(STDIN));
	// Read input. Remove CR
	if (empty($name)) {// No value. Enter was pressed
		return $defaultVal;
		// return default
	} else {// Value entered
		return $name;
		// return value
	}
}

//========================================= End promptUser ============
?>