<!--***************************************************************************
 *
 *   PHP file-builder for TheOpenCD installer
 *   Copyright 2004, TheOpenCD Project
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************-->

<?php
include 'deepcopy.php';

// If the program directory already exists then do nothing, 
// otherwise copy it accross and check for errors as you go

if (file_exists($OutputDir)) {
    $source = $DirBaseLocation;
    $dest = $OutputDir;
    if (file_exists($dest.'/programs')) {
        echo "<b>$dest.'/programs'</b> already exists. Skipping copy and proceeding ... <br> \n";
        } else {
        echo "Copying <b>$source</b> to <b>$dest</b> ...  <br> \n";
        if (!deepcopy($source, $dest)) {
            echo "Failed to copy $source ";
            exit;
            }
        }            
    } else {
    echo "The file <b>$OutputDir</b> does not exist. Stopping.";
    exit;
    }
?>
