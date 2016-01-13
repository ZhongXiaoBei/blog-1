# mDNS原理的简单理解

mDNS multicast DNS , 使用5353端口。

在局域网内，你要通过一台主机和其他主机进行通信，你需要知道对方的ip地址，但是有些时候，你并不知道对方的ip地址，因为一般使用DHCP动态分配ip地址的局域网内，各个主机的IP地址是由DHCP服务器来帮你分配IP地址的。所以在很多情况下，你要知道对方的IP地址是比较麻烦的。

鉴于发现这篇文章最近的浏览量比较多，晚上也有不少转载，特别声明一下，文章水平可能不大够，只是我当时的一些理解，所以希望大家以批判的角度来看，然后又什么问题欢迎讨论。真心不希望误导大家^_^

mDNS就是来解决这个问题的。通过一个约定俗成的端口号，5353。（这个端口号应该是由IETF组织约定的。）每个进入局域网的主机，如果开启了mDNS服务的话，都会向局域网内的所有主机组播一个消息，我是谁，和我的IP地址是多少。然后其他也有该服务的主机就会响应，也会告诉你，它是谁，它的IP地址是多少。当然，具体实现要比这个复杂点。

比如，A主机进入局域网，开启了mDNS服务，并向mDNS服务注册一下信息：我提供FTP服务，我的IP是192.168.1.101，端口是21。当B主机进入局域网，并向B主机的mDNS服务请求，我要找局域网内FTP服务器，B主机的mDNS就会去局域网内向其他的mDNS询问，并且最终告诉你，有一个IP地址为192.168.1.101，端口号是21的主机，也就是A主机提供FTP服务，所以B主机就知道了A主机的IP地址和端口号了。

大概的原理就是这样子，mDNS提供的服务要远远多于这个，当然服务多但并不复杂。

在Apple 的设备上（电脑，笔记本，iphone，ipad等设备）都提供了这个服务。很多Linux设备也提供这个服务。Windows的设备可能没有提供，但是如果安装了iTunes之类的软件的话，也提供了这个服务。

这样就可以利用这个服务开发一些局域网内的自动发现，然后提供一些局域网内交互的应用了。

jmDNS 是一个 JAVA 平台的，提供 mDNS 服务的第三方库。在这个 jar 包引入到 Android 项目里，就可以获得 mDNS 服务了。Android 在 3.x 还是 4.x 之后已经提供局域网内自动发现的 API 了，所以不需要使用 jmDNS 第三方库就能实现了。

下文是来自http://www.multicastdns.org/ 的说明。

> Multicast DNS is a way of using familiar DNS programming interfaces, packet formats and operating semantics, in a small network where no conventional DNS server has been installed.
> Multicast DNS is a joint effort by participants of the IETF Zero Configuration Networking (zeroconf) and DNS Extensions (dnsext) working groups. The requirements are driven by the Zeroconf working group; the implementation details are a chartered work item for the DNSEXT group. Most of the people working on mDNS are active participants of both working groups.
> While the requirements for Zeroconf name resolution could be met by designing an entirely new protocol, it is better to provide this functionality by making minimal changes to the current standard DNS protocol. This saves application programmers from having to learn new APIs, and saves application programmers from having to write application code two different ways — one way for large configured networks and a different way for small Zeroconf networks. It means that most current applications need no changes at all to work correctly using mDNS in a Zeroconf network. It also means that engineers do not have to learn an entirely new protocol, and current network packet capture tools can already decode and display DNS packets, so they do not have to be updated to understand new packet formats.