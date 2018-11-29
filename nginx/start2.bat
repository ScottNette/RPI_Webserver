@ECHO OFF
ECHO Starting PHP FastCGI...
set PATH=C:\PHP7.1;%PATH%
E:\WebServer\nginx\php\php-cgi.exe -b 127.0.0.1:9000 -c E:\WebServer\nginx\php\php.ini
ping 127.0.0.1 -n 1>NUL
echo Starting nginx
ping 127.0.0.1 >NUL
echo Starting Mysql...
start E:\WebServer\nginx\mysql\bin\mysqld.exe
EXIT