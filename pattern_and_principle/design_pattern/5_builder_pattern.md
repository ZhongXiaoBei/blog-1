# 建造者模式（Builder Pattern），也叫生成器模式。

## 定义
Separate the construction of a complex object from its representation so that the same construction process can create different representations.
将一个复杂对象的构建与它的表示分离，使得同样的构建过程可以创建不同的表示。

## 四个角色

 - Product 产品类
 - Builder 抽象建造者
 - ConcreteBuilder 具体建造者
实现抽象类定义的所有方法，并且返回一个组建好的对象。
 - Director 导演类

建造者模式关注的是零件类型和装配工艺顺序，与工厂方法模式还是有些区别的。

23种设计模式：
<http://blog.binkery.com/pattern_and_principle/design_pattern/summary.html>