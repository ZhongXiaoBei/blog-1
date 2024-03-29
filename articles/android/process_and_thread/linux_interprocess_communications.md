# Linux 进程间通信

Android 是基于 Linux 系统的，学习 Android 的进程间通信，需要对 Linux 的进程间通信有点了解，所有咱们从 Linux 进程间为啥需要通信讲起。


程序的执行过程大概是这样的：运算器从存储器读取指令，进行运算，然后把结构存放回存储器。比如汇编了有个 mov 指令，大概长这个样子：

    mov a 0

意思是说把 0 这个值赋给 a 这个地址，这条指令结束后，a 这个地址的值变成了 0 

Note：上面的表述是很不严谨的，详细的过程可以看看计算机组成原理，冯诺伊曼体系结构以及汇编语言等相关书籍。

咱们再回到比汇编语言更高级的语言上，比如 C 或者 C++ ，C 和 C++ 有个概念叫指针。指针可以理解为内存地址，咱们在操作指针的时候，其实操作的是内存地址。指针的指针的意思是指针指向的内存单元存放的数据也是一个内存地址，这个内存地址指向的内存单元存放的数据才是最终的数据。

在写 C/C++ 程序的时候，有个东西叫野指针，当出现野指针的时候就会出现意想不到的结果，你打算修改一个变量的值，你以为你当前手里的指针表示的是这个变量，其实这个指针已经不知道指向哪了（别问我为什么，因为出bug了），于是你修改了这个变量，结果是你想要修改的变量没有别修改，修改的是一个未知的内存单元。

如果出现这种情况，会产生什么样的结果？一是你自己的程序出现问题了，你要修改的变量没有被修改，你还以为它被修改了。同时，真正被你修改的内存单元，可能是另外一个程序要使用的，而这个程序在访问这个内存单元的时候，它以为它获取到它想要的值，其实这个值已经不知道变成什么鬼了。

就好比你回家把你家的灯的开关打开了，结果隔壁老王家的灯泡亮了。万一隔壁老王正在换灯泡，他以为灯是关着的， 其实灯是开着的，老王很可能会崩溃的。

操作系统上跑着 N 多个应用程序，它肯定不希望应用程序之间相互干扰，所有操作系统会为每个应用程序分配指定的内存，并且不允许它们之间直接访问对方的内存。

咱们可以把每个应用程序理解为进程，其实并不是。在进程启动的时候，操作系统会为进程分配内存空间，相互之间不干预。但是问题来了，进程之间是需要合作的，很多时候，一个单独的进程并不能完成所有的工作，或者说一个进程要独立完成所有工作，那么这个进程就会异常复杂。

以下内容来自 wikipedia <https://en.wikipedia.org/wiki/Inter-process_communication> :

> In computer science, inter-process communication (IPC) refers specifically to the mechanisms an operating system provides to allow processes it manages to share data. Typically, applications can use IPC categorized as clients and servers, where the client requests data and the server responds to client requests.[1] Many applications are both clients and servers, as commonly seen in distributed computing. Methods for achieving IPC are divided into categories which vary based on software requirements, such as performance and modularity requirements, and system circumstances, such as network bandwidth and latency.

Linux 进程间通信的方式有很多种

## 管道 pipe

管道就是在进程间创建一个标准的输入输出，A 进程往管道里写字节流，B 进程从管道里读字节流，这是单向的，如果需要双向的就需要建立两个管道。可以把它理解为水管。

> Simply put, a pipe is a method of connecting the standard output of one process to the standard input of another. Pipes are the eldest of the IPC tools, having been around since the earliest incarnations of the UNIX operating system. They provide a method of one-way communications (hence the term half-duplex) between processes.

## 有名管道 Named pipe

有名管道跟管道的原理基本一样，区别是可以理解为它是写在一个临时文件里的，只要有写权限，都可以往里写，只要有读权限，都可以往外读。

> A named pipe works much like a regular pipe, but does have some noticeable differences.

* Named pipes exist as a device special file in the file system.
* Processes of different ancestry can share data through a named pipe.
* When all I/O is done by sharing processes, the named pipe remains in the file system for later use.

## 信号 Signal

一个进程可以向其他进程发送一个信号，用来告诉对方自己发生了某些变化。信号可以传递的信息量是很少的，一般只用于对外发布自己的状态变化。

可以理解跟 Android 里的广播相似的机制，但确实跟广播不一样。

## 消息队列 Message queue

进程可以创建和打开一个消息队列，并且往队列里添加消息。同样，其他拥有这个队列访问权限的进程也可以往里添加消息。拥有读权限的进程可以从消息队列里取走消息。这种通信方式也是单向的。

## 共享内存 Shared memory

共享内存的意思是同一个内存被映射到两个或者多个进程的内存空间里，当有一个进程修改了这块内存的内容，其他进程也能同时看到内存内容的变化。多个进程操作同一块内存，就需要有同步机制。共享内存的方式是效率最高的一种。

> Shared memory can best be described as the mapping of an area (segment) of memory that will be mapped and shared by more than one process. This is by far the fastest form of IPC, because there is no intermediation (i.e. a pipe, a message queue, etc). Instead, information is mapped directly from a memory segment, and into the addressing space of the calling process. A segment can be created by one process, and subsequently written to and read from by any number of processes.

## 信号量 Semaphore

信号量，也叫信号灯。大体上是为了解决多个进程对同一个资源的占用问题。这种通信机制包括一个信号量的变量，一个进程队列，以及 PV 操作。P 操作的时候，如果信号量变量不为 0 ，则占用一个资源，同时变量减一，如果信号量为 0 ，则进入等待队列。V 操作的时候，如果等待队列有进程，则把资源交给队列里的一个进程，如果队列里没有进程，就直接释放该资源，同时信号量变量加一。

这跟去停车场停车一样的道理，每进去一辆车，入口的显示空余车位的数字牌子就 -1，如果空余车位为 0，那么入口就开始排队，这就是 P 操作。如果有车出停车场，空余出来车位了，那么这个车位就交给一个在入口等待的车辆，如果入口没有等待的车辆，数字牌子就 +1，这就是 V 操作。

## 套接字 Socket

一个进程可以创建一个 Socket 的服务端，并且绑定到某个端口上，其他进程可以通过 ip 地址和端口号与这个进程建立连接。Socket 方式可以实现不同主机上不同进程的通信，这是其他同步禁止不能做到的。

> A data stream sent over a network interface, either to a different process on the same computer or to another computer on the network. Typically byte-oriented, sockets rarely preserve message boundaries. Data written through a socket requires formatting to preserve message boundaries.

上面很多分析是基于个人理解，应该会有很多错误，而且不严谨。

## 参考资料

[6 Linux Interprocess Communications](http://www.tldp.org/LDP/lpg/node7.html)