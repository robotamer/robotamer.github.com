<?php 


include __DIR__ . '/../lib/RoboTamer/boot.php';

$scan = rscandir('md');
//print_r($scan);
define('DS', DIRECTORY_SEPARATOR);
foreach( $scan as $k=>$mdfile ){
	$pathinfo = pathinfo($mdfile);
	$newbase  = 'html'.strstr( $pathinfo['dirname'], '/');
	if($pathinfo['extension'] = 'md' || $pathinfo['extension'] = 'php'){
		$htmlfile[$pathinfo['dirname']][$k] = $newbase . DS . $pathinfo['filename'] . '.html';
	}elseif($pathinfo['filename'] == 'sidebar'){
		$htmlfile[$pathinfo['dirname']]['sidebar'] = strstr( 'html'.strstr( $mdfile, '/') , '.html', TRUE).'.html';	
	}
}

foreach($htmlfile as $dir){
	$sidebar = '';
	foreach($dir as $menuitem){
		$infoinfo = pathinfo($dir);
		$name = $pathinfo['filename'];
		$sidebar .= '<a href="/'.$menuitem.'" title="'.$name.'">'.$name.'</a><br />';		
	}
	foreach($dir as $k => $item){
		$infoinfo = pathinfo($dir);
		$f['get'][] = $scan[$k];
		$f['put'][] = $item;
	}
}

print_r($scan);
print_r($htmlfile);
print_r($f);
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

?>