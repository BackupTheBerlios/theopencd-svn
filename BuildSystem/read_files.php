<?php
// Get files into an arrays 
echo "Reading <b>".$GPLFileName."</b><br>\n"; 
$GPLTextLines = file($GPLFileName);

echo "Reading <b>".$TopFileName1."</b><br>\n";
$TopFileLines1 = file($TopFileName1);
echo "Reading <b>".$AfterTextFileName1."</b><br>\n";
$AfterTextFileLines1 = file($AfterTextFileName1);

echo "Reading <b>".$TopFileName2."</b><br>\n";
$TopFileLines2 = file($TopFileName2);
echo "Reading <b>".$AfterTextFileName2."</b><br>\n";
$AfterTextFileLines2 = file($AfterTextFileName1);
echo "<hr>\n";
?>
