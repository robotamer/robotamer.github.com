<?php
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include __DIR__ . '/../lib/RoboTamer/boot.php';
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

include_once "php-markdown/markdown.php";

foreach( $scan as $mdfile ){
	$htmlfile = strstr( 'html'.strstr( $mdfile, '/') , '.md', TRUE).'.html';

	S::V()->raw = Markdown(file_get_contents($mdfile));
	file_put_contents($htmlfile,S::V()->fetch('layout.php'));
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

		if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
			$dir = $path . DIRECTORY_SEPARATOR . $file;
			$dir = 'html'.strstr( $dir, '/');
			if(!is_dir($dir)) mkdir($dir, 0755); 
			mkdirs($path . DIRECTORY_SEPARATOR . $file);
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