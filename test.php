<?php 


include __DIR__ . '/../lib/RoboTamer/boot.php';

$scan = rscandir('md');
//print_r($scan);
define('DS', DIRECTORY_SEPARATOR);
foreach( $scan as $mdfile ){
	$pathinfo = pathinfo($mdfile);
	$newbase  = 'html'.strstr( $pathinfo['dirname'], '/');
	if($pathinfo['extension'] = 'md'){
		$htmlfile[$pathinfo['dirname']][] = $newbase . DS . $pathinfo['filename'] . '.html';
	}elseif(strpos($mdfile, 'sidebar.html') > 0 ){
		$htmlfile[$pathinfo['dirname']]['sidebar'] = strstr( 'html'.strstr( $mdfile, '/') , '.html', TRUE).'.html';	
	}
}

foreach($htmlfile as $dir){

}

print_r($htmlfile);

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

?>