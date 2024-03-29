# 依赖倒置原则（Dependence Inversion Principle），简称DIP



## 定义

High level modules should depend upon low level modules. Both should depend upon abstractions. Abstractions should not depend upon details. Details should depend upon abstractions.

- 高层模块不应该依赖低层模块，两者都应该依赖于抽象（抽象类或接口）
- 抽象（抽象类或接口）不应该依赖于细节（具体实现类）
- 细节（具体实现类）应该依赖抽象

## 高层模块和低层模块
每个逻辑的现实都是由原子模块组成，不可分割的原子模块称为低层模块，低层模块组合成高层模块。

要理解好依赖倒置原则，就要理解好面向接口编程。两个具体实现类直接相互依赖的话，大大降低了灵活性和扩展性，比如人吃食物，食物是抽象类或者接口，面条饺子米饭是具体实现类，如果具体实现类之间相互依赖的话，人吃食物就变成了人吃苗条，人吃饺子，人吃米饭，本来一个方法，现在要写三个方法，而且三个方法根本不够，随便拿个饭店的菜单瞅瞅。

## 依赖的三种写法
1. 构造函数传递依赖对象
2. setter 方法传递依赖对象
3. 接口声明依赖对象

## 规则
 - 每个类尽量都有接口或者抽象类，或者都有
 - 变量的表面类型尽量使接口或者抽象类
 - 任何类型都不应该从具体类派生
 - 尽量不要覆写基类的方法
 - 结合里氏替换原则使用