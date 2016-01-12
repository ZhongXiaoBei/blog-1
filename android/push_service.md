# Android 消息推送

基于 Android/iOS 的应用，都是采用 CS 结构的方式。一般来说消息的传递都是由 Client 端向 Server 端发放请求，Server 端响应 Client 端的请求。这种方式成为 pull，由 Client 端向 Server 端拉取数据。和 pull 相反，push 是由 Server 端向 Client 端主动推送数据。咱们这里分享的就是推送的实现方法。

## 实现方式

大体上，实现推送有这么几种方式，不定期补充。

 * 轮询。轮询其实还是 pull 方式，就是客户端定时的给服务端发送请求，以达到 push 的方式。这种方式的最大问题是消耗，成本太大。就好比你在等待心仪的男/女神给你发短信，你每隔一分钟从口袋里掏出手机查看短信一样，然并卯，累的口袋和手机都不高兴了。
 
 * 短信截获。这是一个技术可行方案。通过监听手机的短信端口，当服务器通过短信的方式给客户端推送消息的时候，客户端可以截获短信。但是这种方案有几种局限性。首先，国内的各种内置的安全软件，特别是各个系统自带的安全软件，很可能截获你的短信。
 
 * 长连接，我理解就是 socket 连接。在客户端和服务端之间建立一个长连接。这种方案的缺点是对于移动应用，网络情况复杂，实现不了完全可靠的长连接。长连接同样会增加客户端 CPU 的工作量，同时也对服务端的并发连接数提出了一些挑战。但，目前大多数的应用还都是基于长连接的方式来设计推送的。
 
## 解决方案

### Google 云推送服务，GCM Google Cloud Messaging 。
这个是由 Google 提供的服务，应该是一个不错的选择，但是不是很符合国情。

 * Android 2.2 以上，并且安装后 Google Play Store
 * 如果需要使用 Google Play Services，那么要求运行上 Android 2.3 以上。
 * GCM需要依赖 Google 帐号和 Google Services 保持连接。所以需要 Google 帐号
 
一个完整的 GCM 服务包括客户端和服务端。

由于那堵墙和国内各厂商手机对原生环境的改动，这个方案很难在国内落地。

### MQTT协议

MQTT是一个轻量级的消息发布/订阅协议，它是实现基于手机客户端的消息推送服务器的理想解决方案。

当然这也是需要客户端和服务器都按照这个协议实现了。

### RSMB
Really Small Message Broker (RSMB) ，他是一个简单的MQTT代理

### XMPP

XMPP(可扩展通讯和表示协议)是基于可扩展标记语言（XML）的协议，它用于即时消息（IM）以及在线探测。这个协议可能最终允许因特网用户向因特网上的其他任何人发送即时消息。

### 第三方推送 SDK

这个方案是很简单有效的。

### 自己实现

这个方案不是一般人，一般公司应该做的。