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
    
    include 'variables.php';
    include 'read_files.php';
    include 'out_dir_prep.php';

    foreach ($apps as $app_num => $app) {
        // Work out locations and read the text file
        include $InputDir.$app.'/AppData.php';
        $CurrentInDir = $InputDir.$app.'/'.$CurrentLanguage.'/';
        $TextIn1 = $CurrentInDir.$MainTextFileName;
        $TextIn2 = $CurrentInDir.$ScrTextFileName;
        $OutputFile1 = $OutputDir.'/programs/'.$app.'/'.$CurrentLanguage.'/'.'descr.html';
        $OutputFile2 = $OutputDir.'/programs/'.$app.'/'.$CurrentLanguage.'/'.'screen.html';
        echo "Reading <b>".$TextIn1." </b> ... <br>";
        $MainTextLines = file($TextIn1);
        $ScrTextLines = file($TextIn2);

        // Write the main description file
        $out = fopen($OutputFile1, "w");
        foreach ($GPLTextLines as $line_num => $line) {
            fwrite($out, $line, strlen($line));       }        
        foreach ($TopFileLines1 as $line_num => $line) {
            fwrite($out, $line, strlen($line));       }
        fwrite($out, "  <h1>".$AppName."</h1> \n");
        foreach ($MainTextLines as $line_num => $line) {
            fwrite($out, $line, strlen($line));        }
        foreach ($AfterTextFileLines1 as $line_num => $line) {
            fwrite($out, $line, strlen($line));        } 
        include 'WriteAppDetails.php';
        fclose($out);
        echo " .. Wrote <b>".$OutputFile1." </b>";  
        
        // Write the screen shot file
        $out = fopen($OutputFile2, "w");
        foreach ($GPLTextLines as $line_num => $line) {
            fwrite($out, $line, strlen($line));       }        
        foreach ($TopFileLines2 as $line_num => $line) {
            fwrite($out, $line, strlen($line));       }
        include 'ScreenTextInsert.php';
        foreach ($AfterTextFileLines2 as $line_num => $line) {
            fwrite($out, $line, strlen($line));        }         
        include 'WriteAppDetails.php';
        fclose($out);
        echo "and <b>".$OutputFile2." </b><br> \n"; 
    }

?>
