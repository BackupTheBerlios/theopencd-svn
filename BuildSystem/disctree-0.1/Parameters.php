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

$Distro = 'ubuntu';
$GeneralInputDir = 'GeneralIn/';
$DistroDirIn = 'DistrosIn/'.$Distro;
$DistroDirOut = 'DistrosOut/'.$Distro;
$MainTextFileName = 'MainTextArea.html';
$ScrTextFileName = 'ScreenShotText.html';
include $DistroDirIn.'/DistroParameters.php';

$DebugFlag = false;

?>
