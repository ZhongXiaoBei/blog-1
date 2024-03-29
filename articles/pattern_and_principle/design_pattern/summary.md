# 23种设计模式

设计模式分创建型模式，结构型模式和行为型模式三大类，共有 23 种设计模式。这里做一个简单的整理，有空我会逐个去学习的，然后分别整理出文档处理，虽然写得不好，但是还是要写的。


## 创建型模式

对类的实例化过程的抽象。一些系统在创建对象时，需要动态地决定怎样创建对象，创建哪些对象，以及如何组合和表示这些对象。创建模式描述了怎样构造和封装这些动态的决定。包含类的创建模式和对象的创建模式。

1. [单例模式](http://blog.binkery.com/pattern_and_principle/design_pattern/1_singleton_pattern.html)

	保证一个类只有一个实例，并提供一个访问它的全局访问点。

2. [抽象工厂](http://blog.binkery.com/pattern_and_principle/design_pattern/3_abstract_factory_pattern.html)

	提供一个创建一系列相关或相互依赖对象的接口，而无须指定它们的具体类。

3. [工厂方法](http://blog.binkery.com/pattern_and_principle/design_pattern/2_2_factory_method_pattern.html)

	定义一个用于创建对象的接口，让子类决定实例化哪一个类，Factory Method 使一个类的实例化延迟到了子类。

	[简单工厂方法](http://blog.binkery.com/pattern_and_principle/design_pattern/2_1_simple_factory_pattern.html) 虽然不属于 23 种设计模式之一，但也是运用很多的一种设计，可以在对抽象要求不那么高的情况下使用。

4. [生成器模式/建造者模式](http://blog.binkery.com/pattern_and_principle/design_pattern/5_builder_pattern.html) 

	将一个复杂对象的构建与他的表示相分离，使得同样的构建过程可以创建不同的表示。

5. [原型](http://blog.binkery.com/pattern_and_principle/design_pattern/7_prototype_pattern.html)

	用原型实例指定创建对象的种类，并且通过拷贝这些原型来创建新的对象。


## 结构型模式：
描述如何将类或对象结合在一起形成更大的结构。分为类的结构模式和对象的结构模式。类的结构模式使用继承把类，接口等组合在一起，以形成更大的结构。类的结构模式是静态的。对象的结构模式描述怎样把各种不同类型的对象组合在一起，以实现新的功能的方法。对象的结构模式是动态的。

1. [Composite 组合模式](http://blog.binkery.com/pattern_and_principle/design_pattern/8_composite_pattern.html)

	将对象组合成树形结构以表示部分整体的关系，Composite使得用户对单个对象和组合对象的使用具有一致性。

2. FAÇADE 外观
	
	为子系统中的一组接口提供一致的界面，facade提供了一高层接口，这个接口使得子系统更容易使用。

3. [代理模式 Proxy](http://blog.binkery.com/pattern_and_principle/design_pattern/6_proxy_pattern.html) 

	为其他对象提供一种代理以控制对这个对象的访问

4. Adapter 适配器 

	将一类的接口转换成客户希望的另外一个接口，Adapter模式使得原本由于接口不兼容而不能一起工作那些类可以一起工作。

5. Decorator 装饰
	
	动态地给一个对象增加一些额外的职责，就增加的功能来说，Decorator模式相比生成子类更加灵活。 

6. Bridge 桥接

	将抽象部分与它的实现部分相分离，使他们可以独立的变化。

7. [Flyweight 享元](http://blog.binkery.com/pattern_and_principle/design_pattern/9_flyweight_pattern.html)

	享元模式以共享的方式高效的支持大量的细粒度对象。享元模式能做到共享的关键是区分内蕴状态和外蕴状态。内蕴状态存储在享元内部，不会随环境的改变而有所不同。外蕴状态是随环境的改变而改变的。

## 行为型模式：

对在不同的对象之间划分责任和算法的抽象化。不仅仅是关于类和对象的，并是关于他们之间的相互作用。类的行为模式使用继承关系在几个类之间分配行为。对象的行为模式则使用对象的聚合来分配行为。

1. Iterator 迭代器

	提供一个方法顺序访问一个聚合对象的各个元素，而又不需要暴露该对象的内部表示。

2. Observer 观察者

	定义对象间一对多的依赖关系，当一个对象的状态发生改变时，所有依赖于它的对象都得到通知自动更新。

3. [模板方法 Template Method](http://blog.binkery.com/pattern_and_principle/design_pattern/4_template_method_pattern.html)  

	定义一个操作中的算法的骨架，而将一些步骤延迟到子类中，Template Method使得子类可以不改变一个算法的结构即可以重定义该算法得某些特定步骤。

4. Command 命令 

	将一个请求封装为一个对象，从而使你可以用不同的请求对客户进行参数化，对请求排队和记录请求日志，以及支持可撤销的操作。 

5. State 状态 

	允许对象在其内部状态改变时改变他的行为。对象看起来似乎改变了他的类。

6. Strategy 策略模式 

	定义一系列的算法，把他们一个个封装起来，并使他们可以互相替换，本模式使得算法可以独立于使用它们的客户。

7. China of Responsibility 职责链

	使多个对象都有机会处理请求，从而避免请求的送发者和接收者之间的耦合关系

8. Mediator 中介者
用一个中介对象封装一些列的对象交互。

9. Visitor 访问者模式

	表示一个作用于某对象结构中的各元素的操作，它使你可以在不改变各元素类的前提下定义作用于这个元素的新操作。

10. Interpreter 解释器

	给定一个语言，定义他的文法的一个表示，并定义一个解释器，这个解释器使用该表示来解释语言中的句子。

11. Memento 备忘录

	在不破坏对象的前提下，捕获一个对象的内部状态，并在该对象之外保存这个状态。
