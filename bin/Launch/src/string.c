#include <windows.h>
//#include "string.h"


//BOOL SplitFullPath(LPCTSTR fileSpec, LPTSTR pathOnly, LPTSTR fileNameOnly) {

LPTSTR StrTrimSpace(LPTSTR str) {
   //LPTSTR ptr;
   int len = strlen(str);
   if (len--<1) return str;
   if(str[len]!=' ')  return str;
   str[len] = '\0';
   return StrTrimSpace(str);
}



LPTSTR StrReplace(LPTSTR buf, LPCTSTR target, LPCTSTR replacement) {
   LPTSTR ptr;
   LPTSTR left;
   LPTSTR right;

   if ((ptr = strstr(buf, target)) != NULL) {
      left = strdup(buf);
      left[ptr - buf] = '\0';
      right = strdup(ptr+strlen(target));
      strcpy(buf, left);
      strcat(buf, replacement);
      strcat(buf, right);
      free(right);
      free(left);
      StrReplace(buf, target, replacement);
   }
   return buf;
}


/*

  char *strreplace(char *buf, char *target, char *replacement) {
   char *ptr, *left, *right;

   if ((ptr = strstr(buf, target)) != NULL) {
      left = strdup(buf);
      left[ptr - buf] = '\0';
      right = strdup(ptr+strlen(target));
      strcpy(buf, left);
      strcat(buf, replacement);
      strcat(buf, right);
      free(right);
      free(left);
      strreplace(buf, target, replacement);
   }
   return buf;
}


*/

// Similar to PathRemoveFileSpec
BOOL SplitFullPath(LPCTSTR fileSpec, LPTSTR pathOnly, LPTSTR fileNameOnly) {
   TCHAR buff[MAX_PATH];
   LPTSTR found;

   strcpy(buff, fileSpec);
   found = strrchr(buff, '\\');
   if (!found) return FALSE;
   *found=(TCHAR)NULL;
   found++;

   if (pathOnly) strcpy(pathOnly, buff);
   if (fileNameOnly) strcpy(fileNameOnly, found);

   return TRUE;
}


/*


LPTSTR StripIniComment(LPTSTR iniValue) {
   TCHAR trim[ ] = TEXT(" \0");
   LPTSTR found = StrRChr(iniValue, NULL, ';');

   if (found!=NULL) *found=(TCHAR)NULL;

   StrTrim(iniValue, trim);
   return iniValue;
}


char *strreplace(char *buf, char *target, char *replacement) {
   char *ptr, *left, *right;

   if ((ptr = strstr(buf, target)) != NULL) {
      left = strdup(buf);
      left[ptr - buf] = '\0';
      right = strdup(ptr+strlen(target));
      strcpy(buf, left);
      strcat(buf, replacement);
      strcat(buf, right);
      free(right);
      free(left);
      strreplace(buf, target, replacement);
   }
   return buf;
}


*/

//StrTrim(iniValue, trim);

//launch.obj : error LNK2001: unresolved external symbol _StrTrim
//launch.obj : error LNK2001: unresolved external symbol _StrRChr
//launch.obj : error LNK2001: unresolved external symbol _PathRemoveFileSpec
//launch.obj : error LNK2001: unresolved external symbol _StrCpy
//launch.obj : error LNK2001: unresolved external symbol _PathFileExists
//launch.obj : error LNK2001: unresolved external symbol _StrCat
//Debug/Launch.exe : fatal error LNK1120: 6 unresolved externals
//Error executing link.exe.

//Launch.exe - 7 error(s), 0 warning(s)
