<?php
fwrite($out,'<table cellPadding="10"><tr><td> <!-- The table ensures proper spacing --> '." \n");
// <h1>Dia</h1>
fwrite($out,'   <table cellPadding="5"> '." \n");
fwrite($out, "  <h1>".$AppName."</h1> \n");
foreach ($ScrTextLines as $ST_num => $Stext) {
    $ImgName = "'../images/screen_0".($ST_num+1).".png'";
    $TmbName = "'../images/thumb_0".($ST_num+1).".png'";
    fwrite($out,'     <tr><td> '." \n");
    fwrite($out,'       <a href="javascript:ScreenShot(800,600,'.$ImgName.');">  '." \n");
    fwrite($out,'         <img border="0" height="98" width="130" alt="thumb" src='.$TmbName.' /></a></td>  '." \n");
    fwrite($out,'        <td><p>Figure text goes here, and some more figure text goes here.</p></td></tr> '." \n");    
    }
fwrite($out,'    </table> '." \n");
fwrite($out,'   </td></tr></table>  <!-- end dummy table --> '." \n");
?>