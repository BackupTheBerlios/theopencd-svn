/*
Launch
Copyleft 2003 Brett McNamara, brett@chaingang.org (a.k.a. Baavgai)
--------------------------------------------------------------------------------
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

See http://www.gnu.org for further information.
--------------------------------------------------------------------------------
*/

#include <windows.h>
#include <stdlib.h>
#include <stdio.h>
#include <io.h>
//#include "Shlwapi.h"
#include "language.h"
#include "string.h"

#define PROG_VERSION "v0.3"

#if defined(CUSTOM_ICON)
#include "resource.h"
#endif

char *className="Launch";

// globals
struct {
   TCHAR iniFileName[MAX_PATH];
   TCHAR iniFilePath[MAX_PATH];
   TCHAR executeFile[MAX_PATH];
   TCHAR executeDirectory[MAX_PATH];
   TCHAR executeParameters[MAX_PATH];
   TCHAR moduleFileName[MAX_PATH];
   TCHAR modulePath[MAX_PATH];
   TCHAR moduleDrive[2];
   TCHAR languageId[4];
   TCHAR languageAlias[MAX_PATH];
   BOOL showCommand;
   } gConfig;


void FailOut(LPCSTR message) {
   MessageBox(NULL, message, className, MB_OK);
   exit(1);
}


BOOL FileExists(char *iniFile) {
    struct _finddata_t file_data;
    return ( _findfirst(iniFile, &file_data ) != -1L);
}



// You'd think the API would do this, but no...
LPTSTR StripIniComment(LPTSTR iniValue) {
   //TCHAR trim[ ] = TEXT(" \0");
   LPTSTR found = strrchr(iniValue, ';');

   if (found!=NULL) *found=(TCHAR)NULL;

   StrTrimSpace(iniValue);
   return iniValue;
}


void LoadProfileString(LPCTSTR keyName, LPTSTR valueId) {
   GetPrivateProfileString(className, 
      keyName,  NULL, 
      valueId, 
      MAX_PATH, gConfig.iniFileName
      );
   StripIniComment(valueId);
   StrReplace(valueId, "${cwd}", gConfig.modulePath);
   StrReplace(valueId, "${drive}", gConfig.moduleDrive );
   StrReplace(valueId, "${inipath}", gConfig.iniFilePath);
   StrReplace(valueId, "${langid}", gConfig.languageId);
   StrReplace(valueId, "${langalias}", gConfig.languageAlias);
}


void LoadFilePath() {
   GetModuleFileName(NULL, gConfig.moduleFileName, sizeof(gConfig.moduleFileName));
   SplitFullPath(gConfig.moduleFileName, gConfig.modulePath, NULL);

   gConfig.moduleDrive[0]=gConfig.moduleFileName[0];
   gConfig.moduleDrive[1]=(TCHAR)NULL;

}


void LoadLanguageInfo() {
   TCHAR defLang[MAX_PATH];

   LoadLanguage(gConfig.languageId);

   GetPrivateProfileString("LanguageAlias", 
      "default",  NULL, defLang, 
      MAX_PATH, gConfig.iniFileName
      );
   StripIniComment(defLang);

   if (!defLang) return;

   GetPrivateProfileString("LanguageAlias", 
      gConfig.languageId,  defLang, gConfig.languageAlias, 
      sizeof(gConfig.languageAlias), gConfig.iniFileName
      );

   StripIniComment(gConfig.languageAlias);
}


void LoadConfigFile(LPSTR cmdline) {
   TCHAR messageBuff[MAX_PATH + 100];
   
   LoadFilePath();

   if (cmdline!=NULL && strlen(cmdline)!=0 ) {
      strcpy(gConfig.iniFileName, cmdline);
   } else {
      strcpy(gConfig.iniFileName, gConfig.modulePath);
      strcat(gConfig.iniFileName, "\\launch.ini");
   }

   
   if (!FileExists(gConfig.iniFileName)) {
      sprintf(messageBuff,"Command file (%s) not found.", gConfig.iniFileName);
      FailOut(messageBuff);
   }

   SplitFullPath(gConfig.iniFileName, gConfig.iniFilePath, NULL);
   //PathRemoveFileSpec( StrCpy(gConfig.iniFilePath, gConfig.iniFileName) );


   LoadLanguageInfo();

   LoadProfileString("ExecuteFile", gConfig.executeFile);
   LoadProfileString("ExecuteDirectory", gConfig.executeDirectory);
   LoadProfileString("ExecuteParameters", gConfig.executeParameters);
   LoadProfileString("ExecuteParameters", gConfig.executeParameters);
   gConfig.showCommand = GetPrivateProfileInt(className,"ShowCommand", 0, gConfig.iniFileName);
}

// should do this is a resource file, but not today
void StartError(int result) {
   TCHAR message[MAX_PATH];

   switch (result) {
      case 0: 
         strcpy(message, "The operating system is out of memory or resources."); break;
      //case ERROR_FILE_NOT_FOUND: 
      //   strcpy(message, "The specified file was not found."); break;
      //case ERROR_PATH_NOT_FOUND: 
      //   strcpy(message, "The specified path was not found."); break;
      case ERROR_BAD_FORMAT: 
         strcpy(message, "The .exe file is invalid (non-Microsoft Win32® .exe or error in .exe image)."); break;
      case SE_ERR_ACCESSDENIED: 
         strcpy(message, "The operating system denied access to the specified file."); break;
      case SE_ERR_ASSOCINCOMPLETE: 
         strcpy(message, "The file name association is incomplete or invalid."); break;
      case SE_ERR_DDEBUSY: 
         strcpy(message, "The Dynamic Data Exchange (DDE) transaction could not be completed because other DDE transactions were being processed."); break;
      case SE_ERR_DDEFAIL: 
         strcpy(message, "The DDE transaction failed."); break;
      case SE_ERR_DDETIMEOUT: 
         strcpy(message, "The DDE transaction could not be completed because the request timed out."); break;
      case SE_ERR_DLLNOTFOUND: 
         strcpy(message, "The specified dynamic-link library (DLL) was not found."); break;
      case SE_ERR_FNF: 
         strcpy(message, "The specified file was not found."); break;
      case SE_ERR_NOASSOC: 
         strcpy(message, "There is no application associated with the given file name extension. This error will also be returned if you attempt to print a file that is not printable."); break;
      case SE_ERR_OOM: 
         strcpy(message, "There was not enough memory to complete the operation."); break;
      case SE_ERR_PNF: 
         strcpy(message, "The specified path was not found."); break;
      case SE_ERR_SHARE: 
         strcpy(message, "A sharing violation occurred."); break;
      default:
         strcpy(message, "Unknown error");
   }
   FailOut(message);
}

void StartProgram(void) {
   int result = (int)ShellExecute(
      (HWND)NULL,
      (LPCTSTR)"open",                     // lpOperation
      (LPCTSTR)gConfig.executeFile,        // lpFile
      (LPCTSTR)gConfig.executeParameters,  // lpParameters
      (LPCTSTR)gConfig.executeDirectory,   // lpDirectory
      (INT)SW_SHOWNORMAL | SW_RESTORE
   );
   if (!(result>32)) StartError(result);
}


void ShowStartProgram(void) {
   TCHAR messageBuff[(MAX_PATH + 20) * 5];
   sprintf(messageBuff,
      "Launch %s\nLaunchFile=%s\nCWD=%s\nExecuteFile=%s\nExecuteDirectory=%s\nExecuteParameters=%s\nLanguageId=%s\nLanguageAlias='%s'\n",
      PROG_VERSION,
      gConfig.iniFileName,
      gConfig.modulePath,
      gConfig.executeFile,
      gConfig.executeDirectory,
      gConfig.executeParameters,
      gConfig.languageId,
      gConfig.languageAlias
   );

   MessageBox(NULL, messageBuff, className, MB_OK);


}


int APIENTRY WinMain(HINSTANCE hinstance, HINSTANCE hprevious, LPSTR cmdline, int cmdshow) {
   LoadConfigFile(cmdline);
   if (gConfig.showCommand) ShowStartProgram();
   StartProgram();

   return 0;
}

