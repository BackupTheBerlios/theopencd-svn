<?php
// Make app destination directory structure 

if (!is_dir($AppDir)) mkdir($AppDir); 
if (!is_dir($AppDir.'/install')) mkdir($AppDir.'/install'); 
if (!is_dir($AppDir.'/images')) mkdir($AppDir.'/images'); 
if (!is_dir($AppDir.$Language)) mkdir($AppDir.$Language); 

// copy images accross
if (file_exists($AppDir.'/images')) {
    $source = 'AppData/'.$app.'/images';
    $dest = $AppDir.'/images';
    // Copy info and inc
    if ($DebugFlag) echo "Copying <b>$source</b> to <b>$dest</b> ...  <br> \n";
    if (!deepcopy($source, $dest)) {
        echo "Failed to copy $source ";
        exit;
    }
                   
} else {
    echo "The file <b>".$dest."</b> does not exist. Stopping. [MakeDirStructure]";
    exit;
}

?>