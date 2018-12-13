<?php
header('Content-Type: text/html');
$dir = getcwd().DIRECTORY_SEPARATOR . "/upload/";
$start = $dir;

// if(preg_match('/^[a-z0-9-_]+$/', $dir)) {

// 	$start = $dir;

// } else {

// 	echo '<p>Error</p>' . "\n";
// 	exit();


// }

function directoryIteratorToArray(DirectoryIterator $it) 
{
    $result = array();
    foreach ($it as $key => $child) {
        if ($child->isDot()) {
            continue;
        }
        $name = $child->getBasename();
        if ($child->isDir()) {
         $js = strpos($name, 'js');
         if($js === false) {
            $subit = new DirectoryIterator($child->getPathname());
            $result[$name] = directoryIteratorToArray($subit);
            
         }
        } else {
        
         if(!preg_match('/^\./', $name)) {
            $result[] = $name;
            
         }
        }
    }
    return $result;
}

$files = directoryIteratorToArray(new DirectoryIterator($start));
$html = '<ul>' . "\n";
$base = 'http://' . $_SERVER['HTTP_HOST'] . '/Chat';

foreach($files as $dir => $contents) {

    $html .= '<ul>';

    $html .= '<li><a href="' . $base . "/upload/" . $contents . '">' . $contents . '</a></li>';

    // foreach($contents as $file) {
    
    // 	$html .= '<li><a href="' . $base . $dir . '/' . $file . '">' . $file . '</a></li>';
    
    // }
    
    $html .= '</ul>';
}

$html .= '</ul>';

echo $html;
?>