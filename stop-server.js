var objShell = WScript.CreateObject("WScript.Shell")
objShell.Run("cmd.exe /c taskkill /f /IM nginx.exe", 0);
objShell.Run("cmd.exe /c taskkill /f /IM php-cgi.exe", 0);