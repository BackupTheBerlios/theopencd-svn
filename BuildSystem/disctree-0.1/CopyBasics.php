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

if (!is_dir($DistroDirOut)) mkdir($DistroDirOut); 
if (!is_dir($DistroDirOut.'/disctree/')) mkdir($DistroDirOut.'/disctree/');
if (!is_dir($DistroDirOut.'/programs/')) mkdir($DistroDirOut.'/programs/');

$source = $DistroDirIn.'/INFO_INC';
$dest = $DistroDirOut.'/disctree';
// Copy info and inc
if ($DebugFlag) echo "Copying <b>$source</b> to <b>$dest</b> ...  <br> \n";
if (!deepcopy($source, $dest)) {
    echo "Failed to copy $source ";
    exit;
}
                   

?>
