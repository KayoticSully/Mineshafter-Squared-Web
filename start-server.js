var objShell = WScript.CreateObject("WScript.Shell");
objShell.Run("cmd.exe /c nginx.exe", 0);
objShell.Run("cmd.exe /c c:\\php\\php-cgi.exe -b 127.0.0.1:9123 -c conf\\php.ini", 0);
objShell.Run("cmd.exe /c c:\\php\\php-cgi.exe -b 127.0.0.1:9124 -c conf\\php.ini", 0);
objShell.Run("cmd.exe /c c:\\php\\php-cgi.exe -b 127.0.0.1:9125 -c conf\\php.ini", 0);
objShell.Run("cmd.exe /c c:\\php\\php-cgi.exe -b 127.0.0.1:9126 -c conf\\php.ini", 0);
objShell.Run("cmd.exe /c c:\\php\\php-cgi.exe -b 127.0.0.1:9127 -c conf\\php.ini", 0);