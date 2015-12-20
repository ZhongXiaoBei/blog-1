# 网络常用配置

## windows 上的 dns 缓存

显示已有缓存

	ipconfig /displaydns
	
清空缓存。在执行完清空操作后，Windows 系统会自动从 hosts 文件中生成 dns 缓存。

	ipconfig /flushdns
	
## Linux dnsmasq 服务

启动 dnsmasq 服务
	
	$ sudo /etc/init.d/dnsmasq restart
	
更多 dnsmasq 配置 <http://blog.binkery.com/linux/dnsmasq.html>