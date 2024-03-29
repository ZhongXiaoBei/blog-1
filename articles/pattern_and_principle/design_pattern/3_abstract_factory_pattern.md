# 设计模式 3 抽象工厂模式

抽象工厂模式（Abstract Factory Pattern）是三种工厂模式中抽象程度最高，使用于产品类的继承关系比较复杂的情况。

## 定义
Provide an interface for creating families of related or dependent objects without specifying their concrete classes.
提供一个创建一系列相关或相互依赖对象的接口，而无须指定它们的具体类。

## 产品族
产品族（Product Family），为了介绍抽象工厂模式，我们要先介绍一下产品族。所谓产品族，是指位于不同产品等级结构，功能相关联的产品组成的家族。在工厂方法模式中，我们的所有的产品都是继承于同一个抽象产品，不管汉堡还是盖饭 ，都是继承于食物这个产品。但现实中可能会更加复杂一些，在餐厅中，除了食物，他们还售卖饮料。不管是食物还是饮料，都有高糖的和低糖的，低糖的适合糖尿病人，于是低糖的食物和低糖的饮料就属于低糖的这一个产品族，虽然他们分别属于食物和饮料两个不同的产品类。

## 要素
和工厂方法模式大致一样，抽象工厂模式由四个要素组成。

 - 抽象工厂（Abstract Factory）角色：担任这个角色的是工厂方法模式的核心，它是与应用系统商业逻辑无关的。

 - 具体工厂（Concrete Factory）角色：这个角色直接在客户端的调用下创建产品的实例。这个角色含有选择合适的产品对象的逻辑，而这个逻辑是与应用系统的商业逻辑紧密相关的。

 - 抽象产品（Abstract Product）角色：担任这个角色的类是工厂方法模式所创建的对象的父类，或它们共同拥有的接口。

 - 具体产品（Concrete Product）角色：抽象工厂模式所创建的任何产品对象都是某一个具体产品类的实例。这是客户端最终需要的东西，其内部一定充满了应用系统的商业逻辑。

## 优缺点
 - 优点：抽象工厂模式是工厂方法模式的进一步抽象，把具有相同属性的一些产品进一步抽象出一个产品族来，对它们进行约束。
 - 缺点：个人感觉缺点就是抽象无止境，每当需求变更的时候，如果要新增一个产品，那么可能需要修改的工厂的实现，也可能带来再一次的抽象重构。

工厂模式的目的是解耦生产者和消费者，至于具体选择哪个就看需求了，即使选择好了，开发过程中重构着重构着就变了，也可能需求一变也就跟着变了，所以不要太纠结。

23种设计模式：
<http://blog.binkery.com/pattern_and_principle/design_pattern/summary.html>