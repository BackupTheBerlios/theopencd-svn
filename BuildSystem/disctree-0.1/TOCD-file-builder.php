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

include 'Parameters.php';
include 'ReadFiles.php';
include 'CopyBasics.php';
include 'FindInstallFile.php';

    foreach ($apps as $app_num => $app) {
        foreach ($LanguagesToInclude as $L_num => $Language) {
            // Work out locations and read the text file
            include 'AppData/'.$app.'/AppData.php';
            $CurrentInDir = 'AppData/'.$app.'/'.$Language.'/';
            $TextIn1 = $CurrentInDir.$MainTextFileName;
            $TextIn2 = $CurrentInDir.$ScrTextFileName;
            $AppDir = $DistroDirOut.'/disctree/'.$app.'/';
            $OutputFile1 = $AppDir.$Language.'/'.'descr.html';
            $OutputFile2 = $AppDir.$Language.'/'.'screen.html';
            if ($DebugFlag) echo "Reading <b>".$TextIn1." </b> ... <br>";
            $MainTextLines = file($TextIn1);
            $ScrTextLines = file($TextIn2);
            include 'MakeDirStructure.php';
            
            // Write the main description file
            $out = fopen($OutputFile1, "w");
            foreach ($GPLTextLines as $line_num => $line) 
                fwrite($out, $line, strlen($line)); 
            foreach ($HeaderTextLines as $line_num => $line) {
                if (substr_count($line,'ReplaceWithProjectTitle')) {
                    $line = str_replace('ReplaceWithProjectTitle', $DistroName , $line); }
                fwrite($out, $line, strlen($line)); 
            }
            foreach ($TabAreaLines1 as $line_num => $line) 
                fwrite($out, $line, strlen($line)); 
            fwrite($out, "  <h1>".$AppTitle."</h1> \n");
            foreach ($MainTextLines as $line_num => $line) 
                fwrite($out, $line, strlen($line)); 
            foreach ($AfterTextStuff1 as $line_num => $line) 
                fwrite($out,$line." \n");                         
            foreach ($MenuBlockLines as $line_num => $line) 
                fwrite($out, $line, strlen($line));   
            foreach ($IconBlockLines as $line_num => $line) 
                fwrite($out, $line, strlen($line));             
            include 'WriteAppDetails.php';
            fclose($out);
            if ($DebugFlag) echo " .. Wrote <b>".$OutputFile1." </b>";  
            
            // Write the screen shot file
            $out = fopen($OutputFile2, "w");
            foreach ($GPLTextLines as $line_num => $line) 
                fwrite($out, $line, strlen($line));       
            foreach ($HeaderTextLines as $line_num => $line)  {
                if (substr_count($line,'ReplaceWithProjectTitle')) {
                    $line = str_replace('ReplaceWithProjectTitle', $DistroName , $line); }
                fwrite($out, $line, strlen($line)); 
            }       
            foreach ($TabAreaLines2 as $line_num => $line) 
                fwrite($out, $line, strlen($line));   
            include 'ScreenTextInsert.php';
            foreach ($AfterTextStuff2 as $line_num => $line) 
                fwrite($out,$line." \n");    
            foreach ($MenuBlockLines as $line_num => $line) 
                fwrite($out, $line, strlen($line));  
            foreach ($IconBlockLines as $line_num => $line) 
                fwrite($out, $line, strlen($line));                   
            include 'WriteAppDetails.php';
            fclose($out);
            if ($DebugFlag) echo "and <b>".$OutputFile2." </b><br> \n"; 
            
            include 'MakeInstallStuff.php';
        }
    }

// Launch button
$JavaCall = "javascript:window.open('".$DistroDirOut."/disctree/info/en/welcome.html'".
        ",'Test','width=780,height=570,top=100,resizable=yes,scrollbars=yes');";
echo '<hr>';
echo '<FORM>';
echo '<INPUT type="button" value="View results" name="TestButton" onClick="'.$JavaCall.'">';
echo '</FORM>';

?>

