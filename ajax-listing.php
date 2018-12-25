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
$html = "";
// $html = '<audio controls>' . "\n";
$base = 'http://' . $_SERVER['HTTP_HOST'] . '/ChatFinal'; 

foreach($files as $dir => $contents) {

    // $html .= '<li><a href="' . $base . "/upload/" . $contents . '">' . $contents . '</a></li>';
    $html .= "<audio preload='none' controls><source src='".$base."/upload/".$contents."'></audio><button style='display: inline-block;width : 100%; background-color : #EB2F00; padding: 10px 20px; border :none; border-radius : 20px'>Delete File</button><br><br>";

    // foreach($contents as $file) {
    
    // 	$html .= '<li><a href="' . $base . $dir . '/' . $file . '">' . $file . '</a></li>';
    
    // }    
}

// $html .= '</audio>';

echo $html;
?>