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
fwrite($out,'<table cellPadding="10"><tr><td> <!-- The table ensures proper spacing --> '." \n");
fwrite($out, "  <h1>".$AppTitle."</h1> \n");
fwrite($out,'   <table cellPadding="5"> '." \n");
foreach ($ScrTextLines as $ST_num => $Stext) {
    $ImgName = "'../images/screen_0".($ST_num+1).".png'";
    $TmbName = "'../images/thumb_0".($ST_num+1).".png'";
    fwrite($out,'     <tr><td> '." \n");
    fwrite($out,'       <a href="javascript:ScreenShot(800,600,'.$ImgName.');">  '." \n");
    fwrite($out,'         <img border="0" height="98" width="130" alt="thumb" src='.$TmbName.' /></a></td>  '." \n");
    fwrite($out,'        <td>'.$Stext.'</td></tr> '." \n");    
    }
fwrite($out,'    </table></table>  <!-- end dummy table --> '." \n");
?>