#include <windows.h>

LPTSTR StrTrimSpace(LPTSTR str);

LPTSTR StrReplace(LPTSTR buf, LPCTSTR target, LPCTSTR replacement);

BOOL SplitFullPath(LPCTSTR fileSpec, LPTSTR pathOnly, LPTSTR fileNameOnly);
