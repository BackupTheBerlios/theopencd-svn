#include <windows.h>
//#include "language.h"

LPTSTR LoadLanguage(LPTSTR langId) {
   //TCHAR buff[MAX_PATH];
   BYTE langb[10];
   DWORD buffSize = sizeof(langId);
   HKEY myKey = NULL;
   DWORD dwType = REG_SZ;
   LPCSTR key1 = "Control Panel\\International";


   int err = RegOpenKeyEx(HKEY_CURRENT_USER, key1, 0, KEY_QUERY_VALUE, &myKey);
   if(err == 0) {
      err = RegQueryValueEx(myKey, "sLanguage", 0, &dwType, langb, &buffSize);
      wsprintf(langId, "%s", langb);
   } else {
      langId[0]='\0';
   }
   RegCloseKey(myKey);

   return langId;
}


