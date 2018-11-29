@ECHO OFF
taskkill /f /IM nginx.exe
taskkill /f /IM php-cgi.exe
taskill /f /IM mysqld.exe
EXIT