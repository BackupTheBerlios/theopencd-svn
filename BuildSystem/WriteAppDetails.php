<?php
fwrite($out,  '      <p id="space_text" class="info_text1">Disk space</p>'." \n");
fwrite($out,  '      <p id="space_info" class="info_text2">'.$DiscSize."</p> \n");
fwrite($out,  '      <p id="licence_text" class="info_text1"><a href="javascript:LangInfoWindow()">Language Information</a></p> '." \n");
fwrite($out,  '      <p id="hardness_text" class="info_text1">Complexity</p>'." \n");
fwrite($out,  '      <p id="hardness_info" class="info_text2"><a href="javascript:ComplexWindow()">'." \n");
fwrite($out,  '        <img alt="Complexity Rating" src="../../inc/skins/default/lights/'.$ComplexityRating.'of5lights.png" /></a></p>'." \n");
fwrite($out,  '      <p id="licence_text" class="info_text1">License</p>'." \n");
fwrite($out,  '      <p id="licence_info" class="info_text2"><a href="javascript:LicenseWindow()">'.$License.'</a></p>'." \n");
fwrite($out,  '</div>'." \n");
fwrite($out,  '<!-- *********************************** -->'." \n");
fwrite($out,  '</body>'." \n");
fwrite($out,  '</html>'." \n");
?>