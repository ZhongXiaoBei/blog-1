# netstat

netstat 应该就是 net status 的缩写了，在 linux 系统上，可以用来查看网络状态。

## 简介
Netstat 命令用于显示各种网络相关信息，如网络连接，路由表，接口状态 (Interface Statistics)，masquerade 连接，多播成员 (Multicast Memberships) 等等。


<!--more-->


## 常见参数
*     -r, --route              显示路由信息，路由表
*     -i, --interfaces         display interface table
*     -g, --groups             display multicast group memberships
*     -s, --statistics         按各个协议进行统计(like SNMP)
*     -M, --masquerade         display masqueraded connection
*     -v, --verbose            be verbose
*     -W, --wide               don't truncate IP addresses
*     -n, --numeric            don't resolve names
*     --numeric-hosts          don't resolve host names
*     --numeric-ports          don't resolve port names
*     --numeric-users          don't resolve user names
*     -N, --symbolic           resolve hardware names
*     -e, --extend             显示扩展信息，例如uid等
*     -p, --programs           显示建立相关链接的程序名（PID/Program name）
*     -c, --continuous         每隔一个固定时间，执行该netstat命令。
*     -l, --listening          仅列出有在 Listen (监听) 的服務状态
*     -a, --all, --listening   显示所有选项，默认不显示LISTEN相关(default: connected)
*     -o, --timers             display timers
*     -F, --fib                display Forwarding Information Base (default)
*     -C, --cache              display routing cache instead of FIB
*     -t (tcp)                 仅显示tcp相关选项
*     -u (udp)                 仅显示udp相关选项

建议使用的时候加上 sudo，因为有些信息是需要比较高的权限才能获取到的。