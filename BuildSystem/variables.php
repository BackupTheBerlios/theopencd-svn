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
$InputDir = 'in_data/';
$OutputDir = 'out_data/'.'run1';
$DirBaseLocation = $InputDir.'DIR_STRUCTURE/';
$GPLFileName = $InputDir.'GPLnotice.html';
$TopFileName1 = $InputDir.'BeforeTextArea1.html';
$AfterTextFileName1 = $InputDir.'AfterText1.html';
$TopFileName2 = $InputDir.'BeforeTextArea2.html';
$AfterTextFileName2 = $InputDir.'AfterText2.html';

$MainTextFileName = 'MainTextArea.html';
$ScrTextFileName = 'ScreenShotText.html';
$apps = array('7zip','abiword','audacity','celestia','clamwin','dia',
'firefox','gaim','openoffice','pdfcreator','thunderbird','tuxpaint');
$CurrentLanguage = 'en';

?>
