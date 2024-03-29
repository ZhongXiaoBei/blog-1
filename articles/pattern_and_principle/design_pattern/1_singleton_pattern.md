# 设计模式 1 单例模式

单例模式是很常用的一种设计模式，很多教程教材也都是从单例模式开始的，所以我不知道是因为常用才放在最开始的位置，还是放在最开始的位置才使得单例模式的使用频率高，因为很多人看书学习也都只是学到前几个，越后面的看的人越少了。希望我的这次学习整理不是这样的。


<!--more-->

## 定义

Ensure a class has only one instance , and provide a global point of access to it .

确保一个类只有一个实例，而且自行实例化并向整个系统提供这个实例。

## 要素

一个类是否是单例模式，需要满足下面几个要素。

 - 构造器私有化。目的是为了不让这个类以及这个类的内部类以外的所有类实例化这个类。
 - 定义一个该类的私有静态变量。静态说明这个实例化对象是类来维护。私有是不让外部直接访问，。
 - 以自己实例为返回值的静态的公有的方法。暴露给外部调用的方法，通过这个方法，可以获得该类的一个实例化对象。

## 简单实现

写了那么多些东西，可能表述不清楚，下面是代码：

    public class A{
        private A(){}
        private static A instance = null;
        public static synchronized A getInstance(){
            if(instance == null){
                instance = new A();
            }
            return instance;
        }
    }

这是一个很简单的代码实现。instance 是 A 类的一个实例，它会在 getInstance() 第一次被调用的时候去实例化，再次调用的时候，这个 instance 已经不为空了，就直接返回。

## 优缺点

单例模式的优点：

1. 确保对象唯一（废话）
2. 节省开销。有些对象是比较重的，不希望调用者经常去创建这个对象。或者整个对象会占用比较多的内存空间，而且每个对象功能都是一样的，那么不希望有多个对象同时存在。

缺点：

1. 不能及时销毁。一般来说这个对象一旦被创建了，就不销毁了，因为这个对象会被使用多少次，什么时候会被使用，是不确定的。那么就有可能这个对象在程序启动的时候被创建了，使用了，然后就没有然后了，它就一直孤零零的在内存里闲着。

## 更多的写法

单例虽然简单，但是有很多讲究的。

 - 懒汉
 
上面的代码就是懒汉写法，使用 synchronized 修饰是为了线程不安全。如果你确定不需要线程安全的情况下，可以不用 synchronized ，或者觉得修饰整个方法不好的话，也可以只修饰一部分语句块。

 - 饿汉
 
饿汉是线程安全的。区别就是在定义静态变量的时候就去实例化对象。这就在类加载的时候实例化对象，就没有线程安全的问题了。

 - 双重校验锁
 
双重校验锁是懒汉的升级版。对整个方法进行同步明显不符合有洁癖的程序员的癖好，所以，把需要进行同步的代码控制在最小的范围。下面是双重校验锁的简单实现。

    public class Singleton {  
        private volatile static Singleton singleton;  
        private Singleton (){}  
        public static Singleton getSingleton() {  
        if (singleton == null) {  
            synchronized (Singleton.class) {  
            if (singleton == null) {  
                singleton = new Singleton();  
            }  
            }  
        }  
        return singleton;  
        }  
    }  

 - 枚举
 
枚举的写法比较少见，但确实是一个可行的方案。枚举是一个很棒的设计，在很多情况下，能很好效的规范代码，减少代码复杂程度，但是一直不被大家推荐。

<http://www.hollischuang.com/archives/197> 这里有一篇文章分析了枚举实现单例的好处，除了枚举类型也是通过 ClassLoader 的方法确保单例外，枚举还有一个优势就是面对序列化的问题，在反序列化的时候，确保得到的肯定是同一个对象，这是枚举类型特有的处理方式。

代码如下：


    public enum Singleton {  
        INSTANCE;  
        public void whateverMethod() {  
        }  
    } 

 - 静态内部类
 
静态内部类是更先进的一种写法，据说在一些服务器容器的框架里，这样的写法是很常见的。除了静态内部类和枚举的方式外，其他的几种单例实现方式，都需要自己做好线程安全的工作，或者根本不关心线程安全。而静态内部类的方式把线程安全的问题交给了类加载器了，ClassLoader 在加载类的时候，本身已经做好了线程安全工作。相同的 ClassLoader 是不会加载一个类两次的，所以这种方法是成本低效果好的一个好办法。

    public class Singleton {  
        private static class SingletonHolder {  
            private static final Singleton INSTANCE = new Singleton();  
        }  
        private Singleton (){}  
        public static final Singleton getInstance() {  
            return SingletonHolder.INSTANCE;  
        }  
    }  

各种写法都有优劣，没有绝对，所以要根据项目的需求来决定。

23种设计模式：<http://blog.binkery.com/pattern_and_principle/design_pattern/summary.html>

## 其他文章推荐
参考了很多文章，他们写得都挺好，不像我东说一句西说一句，完全乱七八糟。

 - 23种设计模式（1）：单例模式 http://blog.csdn.net/zhengzhb/article/details/7331369