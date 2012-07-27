#!/usr/bin/php

<?php
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include __DIR__ . '/../lib/RoboTamer/boot.php';
include_once "lib/markdown/markdown.php";
loadFunc('a');
rmhtml();
mkdirs();
$scan = rscandir('md');

S::set(require PHPL . '/composer/vendor/Aura/View/scripts/instance.php', 'V');
	S::V()->title()->set('RoboTamer ');
	S::V()->metas()->addName('description', '');
	S::V()->metas()->addName('copyright', 'Copyright 1998 - 2012');
	S::V()->metas()->addName('rating', 'General');
	S::V()->metas()->addName('author', 'Dennis T Kaplan');
	S::V()->metas()->addName('robots', 'index');
	S::V()->metas()->addName('viewport', 'width=device-width, initial-scale=1.0');
	S::V()->metas()->addHttp('Content-Type', 'text/html; charset=utf-8');
	S::V()->styles()->add('http://robotamer.bitbucket.org/assets/css/robotamer.css');
	
S::V()->title()->set('RoboTamer');
S::V()->metas()->addName('description', '');
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
		S::V()->sidebar = $sidebar;
		S::V()->raw = Markdown(file_get_contents($scan[$k]));
		file_put_contents($item, S::V()->fetch('layout.php'));
	}
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
?>