# 代理模式(Proxy Pattern)

## 定义
Provide a surrogate or placeholder for another object to control access to it .
为其他对象提供一种代理以控制对这个对象的访问。

代理模式也叫委托模式。

 - Subject 抽象主题角色
抽象主题类可以是抽象类也可以是接口，是一个最普通的业务类型定义，无特殊要求。
 - RealSubject 具体主题角色
也叫被委托角色，被代理角色。是业务逻辑的具体执行者。
 - Proxy 代理主题角色
也叫委托类，代理类。

代理模式分为普通代理和强制代理。普通代理就是调用者需要知道代理角色的存在，并且使用代理角色。强制代理是调用者直接调用真实角色，而不关心代理是否存在，代理的产生由真实角色决定，对调用者透明。


强制代理就是要从真实角色获取到代理角色，不允许直接访问真实角色。代理角色由真实角色来指派。

23种设计模式：
<http://blog.binkery.com/pattern_and_principle/design_pattern/summary.html>

