<?php
// Make app destination directory structure 

$dest = $DistroDirOut.'/programs/'.$app;

if (!is_dir($dest)) mkdir($dest); 
if ($DebugFlag) echo '[MakeInstallStuff]; '. $dest;
// Create launch files
$InstallerLoc = 'INST_EXECs/'.$app;
$InstallFile = FindInstallFile($InstallerLoc);
//echo $InstallerLoc.$InstallFile."<b>  Found. </b><br> \n"; 
$OutString = 'ExecuteFile=${cwd}\\..\..\\disctree\\'.$app.'\\install\\' . $InstallFile;
//echo $OutString;
$out = fopen($DistroDirOut.'/disctree/'.$app.'/install/installer.lch', "w");
fwrite($out, "[Launch] \n");  
fwrite($out,$OutString);  
fclose($out);

// Create web launch files
$OutString = 'ExecuteFile=' . $websiteURL;
//echo $OutString;
$out = fopen($DistroDirOut.'/disctree/'.$app.'/install/web_page.lch', "w");
fwrite($out, "[Launch] \n");  
fwrite($out,$OutString);  
fclose($out);            

// Copy a light-weight install exe
if (!copy($GeneralInputDir.'/DummyInstallFile.exe', $DistroDirOut.'/programs/'.$app.'/'.$InstallFile)) {
    echo "failed to make dummy file $InstallFile...<br />\n"; }

?>