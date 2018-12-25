<?php
    
    $log = array();
    
    $files = scandir('upload');

    $files_only = array_slice($files, 2);
    array_unshift($files_only, '');
    $input_params = implode(' -i ', $files_only);

    $files_only = array_slice($files, 2);
    $files_count = count($files_only);
    echo implode('|', $files_only);

    $command = "ffmpeg $input_params -filter_complex amix=inputs=$files_count:duration=longest -y ../upload/zutput.mp3";
    echo $command;

    $out = [];
    $status = 0;
    chdir('upload');
    exec($command, $out, $status);
    $out = implode('', $out);
    echo $out;

?>
