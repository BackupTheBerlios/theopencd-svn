

/* ScreenShot() takes three arguments:
   X is the width of the screenshot that is to be shown.
   Y is the height of the screenshot to be shown.
   source is the path to the screenshot.

It also measures the resolution of the screen. If the screen is as large or larger
than the screenshot to be shown, ScreenShot() pops up a window that big. If the
screen is smaller than the screenshot, ScreenShot() pops up a window as large as
the screen itself, and enables scroll bars.*/

function ScreenShot(ShotX, ShotY, source){
   // Width and Height of new window;
   var ChildX, ChildY;
   // User can resize/scroll new window?  Default no.
   var resizability = "no";
   var scrollable = "no";
   // Available width and height in pixels -- doesn't count task bar.
   var ScreenX = screen.availWidth;
   var ScreenY = screen.availHeight;
    var buffer = 16;
    
   // Scrollbars appear even if explicitly disabled unless the new window
   // is at least 16 pixels wider than the screenshot in both dimensions.
   // The scrollbars themselves are 16 px.  Could be a moz bug.
   // If the window would bigger than or equal to the screensize after these
   // pixels are added, instead use the screen dimensions minus 100 and make
   // the window resizeable and scrollable.
   if ((ShotX + buffer) >= ScreenX){
      ChildX = ScreenX - 100;
      resizability = "yes";
      scrollable = "yes";
   } else { ChildX = ShotX + buffer;  }
   
   if ((ShotY + buffer) >= ScreenY){
      ChildY = ScreenY - 100;
      resizability = "yes";
      scrollable = "yes";
   } else { ChildY = ShotY + buffer; }

   // Assemble the list of features of the window.
   features = "resizable="+resizability;
   features += ",scrollbars="+scrollable;
   features += ",width="+ChildX;
   features += ",height="+ChildY;

   // Open the window.
   window.open(source, "Thumbnail", features);
}

/*PositionWindow() measures the resolution of the host screen, and uses that information to center the
browser on the screen.  NOTE: check to see if it's possible to make K-Meleon do this itself, so that the
screen doesn't shift noticeably on start.  This is called from the onLoad event.*/

function PositionWindow(){
   var Width, Height, xPos, yPos;
   Width = screen.width;
   Height = screen.height;
   xPos = (Width - 640) / 2;
   yPos = (Height - 480) / 2;
   window.moveTo(xPos, yPos);
}

/* LangWindow() opens the language selection window */
function PickLangWindow()
{
window.open('language_selector.html','mywindow','width=300,height=600,top=100,resizable=yes,scrollbars=yes');
}

function PickLang()
{
// SetLanguage somehow
window.close();
}

/* LangInfoWindow() opens the language information window */
function LangInfoWindow()
{
window.open('LangInfo.html','mywindow','width=600,height=250,top=100,resizable=yes,scrollbars=yes');
}

/* LicenseWindow() opens the language selection window */
function LicenseWindow()
{
window.open('LicenseText.html','mywindow','width=700,height=600,top=100,resizable=yes,scrollbars=yes');
}

/* ComplexWindow() opens the complexity legend window */
function ComplexWindow()
{
window.open('../../info/en/ComplexLegend.html','mywindow','width=500,height=350,top=100,resizable=yes,scrollbars=yes');
}

function ExitProg()
{
// Ask for confirmation
 var where_to= confirm("You are about to exit the CD browser. Click OK to exit.");
 if (where_to== true)
 {
   window.close();
 }
}
