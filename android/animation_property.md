# Property Animation

The property animation system is a robust framework that allows you to animate almost anything. You can define an animation to change any object property over time, regardless of whether it draws to the screen or not. 

## API

### Duration 时长

你可以定义动画的时长，默认是 300 毫秒。

### Time interpolation 时间差值

你可以定义属性的变化的时间差值，也就是说在 duration 的周期内，一个属性数值的变化不一定需要是匀速的。

### Repeat count and behavior 重复次数和行为

你可以自己定义重复的次数。你还可以让动画以相反的方向倒退回来。当然，你还可以让它来回折腾。

### Animator sets

你一次不仅仅能够更改一个属性，完全可以同时更改多个属性，好像是一个动画集合一样。

### Frame refresh delay 帧速

默认的，10 毫秒刷新一帧，当然，你可以自己修改刷新的频率。当然，不是你想刷多块就刷多块的。

## 属性动画是怎么工作的  How Property Animation Works

首先，属性动画修改的是对象的属性的值，是真的修改。然后你需要用到 ValueAnimator 这个类。下面是官方的一个例子：

    ValueAnimator animation = ValueAnimator.ofFloat(0f, 1f);
    animation.setDuration(1000);
    animation.start();

这样子，一个 float 值就在 1000 毫秒内从 0.0 变化到了 1.0.然后呢，然后就没了。那么这个值变化更我有毛关系啊。到目前为止，没有毛关系。Android 文档里出现了一个东西 Animation Listeners。

## Animation Listeners 

刚才看了，属性动画，属性自己动了，跟咱没啥关系，不过 Android 给 ValueAnimator 提供了一些监听机制。

### Animator.AnimatorLister

可以看出，这个接口是属于 Animator 的，这个接口的主要作用从方法的名字可以看出，在动画状态变化的时候可以接收到各种回调。

 * onAnimationStart()
 * onAnimationEnd()
 * onAnimationRepeat()
 * onAnimationCancel()

### ValueAnimator.AnimatorUpdateListener

这个是 ValueAnimator 的接口，在数值变化的时候可以收到方法回调。

 * onAnimationUpdate() 

## ObjectAnimatior 

刚才讲的是 ValueAnimator，可以看出，就是一个 Value 的动画。咱们要的是对象的动画，那么就是这个了，ObjectAnimator。

ObjectAnimator 和 ValueAnimator 的 API 稍微有点不一样。下面是例子：

    ObjectAnimator anim = ObjectAnimator.ofFloat(foo, "alpha", 0f, 1f);
    anim.setDuration(1000);
    anim.start();

foo 是一个对象，alpha 是它的属性。其实 foo 这个对象有没有 alpha 这个属性不是特别重要，重要的是，foo 需要有 setAlpha() 和 getAlpha() 这两个方法。可以看出，它应该是通过反射调用方法的方式来修改对象的属性的。

## Animator

Animator 是属性动画的基类。它有这么几个子类：ValueAnimator,ObjectAnimator,AnimatorSet。前两个刚才说了，AnimatorSet 也可以猜出来了，就是一个集合的意思，也就是说，动画可以很多个，同时修改一个对象的多个属性。或者同时修改多个对象的多个属性。


## Interpolators

An interpolator define how specific values in an animation are calculated as a function of time. 差值器其实提供的是一个算法，一个变化算法，比如线性差值器，数字的变化随着时间的变化是线性的，等比例的，匀速的。

Android 在 android.view.animation 包下提供了好多些已经实现的差值器，基本够用了，如果不够用，你还可以继承 TimeInterpolator 自己实现一个。自己实现只需要重写一个方法 getInterpolation(float input)，input 的取值将在 0 到 1 之间。

## TypeEvaluator

估值器。刚才说的是差值器，Interpolators 计算的是一个变化的速率问题，并没有计算出一个最终的结果。TypeEvaluator 就是干这件事的。咱们以 IntEvaluator 为例子：

    public class IntEvaluator implements TypeEvaluator<Integer>{
        
        public Integer evaluate(float fraction,Integer startValue,Integer endValue){
            int startInt = startValue;
            return (int)(startInt + fraction * (endValue - startInt));
        }
    }

这里，float fraction 的值，就是差值器输出的值，start 和 end 就是动画开始的数值和目标的数值。

是不是有点重复？确实有点重复，但是，这样的设计更加通用，我估计你在理解这个属性动画的时候，满脑子应该就是在模拟一个物体的位移，从一个位置移动到另外一个位置，然后移动的速度从匀速到各种变速，这样去理解。但是属性动画要实现的不仅仅是位移，它可以修改任何属性，属性的类型也不仅仅限制在数值类型。


