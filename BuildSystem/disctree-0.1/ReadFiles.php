<?php
// Get files into an arrays 

$GPLFileName = $GeneralInputDir.'GPLnotice.html';
if ($DebugFlag) echo "Reading <b>".$GPLFileName."</b><br>\n"; 
$GPLTextLines = file($GPLFileName);

$HeaderFileName = $GeneralInputDir.'/HTMLfileHeader.html';
if ($DebugFlag) echo "Reading <b>".$HeaderFileName."</b><br>\n"; 
$HeaderTextLines = file($HeaderFileName);

$TabAreaFileName1 = $GeneralInputDir.'TabArea1.html';
if ($DebugFlag) echo "Reading <b>".$TabAreaFileName1."</b><br>\n";
$TabAreaLines1 = file($TabAreaFileName1);

$TabAreaFileName2 = $GeneralInputDir.'TabArea2.html';
if ($DebugFlag) echo "Reading <b>".$TabAreaFileName2."</b><br>\n";
$TabAreaLines2 = file($TabAreaFileName2);

$MenuBlockFileName = $DistroDirIn.'/MenuBlock.html';
if ($DebugFlag) echo "Reading <b>".$MenuBlockFileName."</b><br>\n";
$MenuBlockLines = file($MenuBlockFileName);

$IconBlockFileName = $GeneralInputDir.'IconBlock.html';
if ($DebugFlag) echo "Reading <b>".$IconBlockFileName."</b><br>\n";
$IconBlockLines = file($IconBlockFileName);

// Formating stuff
$AfterTextStuff1 = array('</td></tr></table>','</div></div><div id=right_edge>',
    '<div id=top_right_corner></div>','<div id=bottom_right_corner></div></div>',
    '<p id="copy_text" class="cr_text">DiscTree Browser. © TheOpenCD project 2004.</p>',
    '<!-- ************ END TAB SECTION *********** -->');
$AfterTextStuff2 = array('</div></div><div id=right_edge>',
    '<div id=top_right_corner></div>','<div id=bottom_right_corner></div></div>',
    '<p id="copy_text" class="cr_text">DiscTree Browser. © TheOpenCD project 2004.</p>',
    '<!-- ************ END TAB SECTION *********** -->');
    
echo "<hr>\n";
?>
