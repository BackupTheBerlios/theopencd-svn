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
function FindInstallFile($mypath) {
    if ($handle = opendir($mypath)) {
       while (false !== ($file = readdir($handle))) {
           if ($file != "." && $file != "..") {
                //echo "$file<br>\n";
                if (strpos ( $file, '.exe' )) { 
                    $InstallFile = $file;
                    return $InstallFile;
                }
           }
       }
       closedir($handle);
    }
return false;
}
?>