# Android 帧动画 Drawable Animation

帧动画让你可以一帧一帧的渲染资源文件里的图片，就像播放电影一样的。

## AnimationDrawable

AnimationDrawable 是帧动画的基础。

首先，你需要在 res/drawable/ 目录下创建一个 xml 文件。可以看出，帧动画是属于 draweble 系统的一部分。

xml 的结构是这样子的，根元素是 <animation\-list\> ，子元素是一个一个 <item\> 。一个 item 就是一帧。下面是官网的例子，直接抠过来了。

    <animation-list xmlns:android="http://schemas.android.com/apk/res/android"
        android:oneshot="true">
        <item android:drawable="@drawable/rocket_thrust1" android:duration="200" />
        <item android:drawable="@drawable/rocket_thrust2" android:duration="200" />
        <item android:drawable="@drawable/rocket_thrust3" android:duration="200" />
    </animation-list>

大概就是这样子，每个元素都有一些可以设置的属性，这里就先不依依描述了。大概就是可以定义动画的循环次数，还是无限循环啊，还有时长啊，之类的。


定义完动画 xml 文件，下面说说怎么使用。

    ImageView rocketImage = (ImageView) findViewById(R.id.rocket_image);
    rocketImage.setBackgroundResource(R.drawable.rocket_thrust);
    rocketAnimation = (AnimationDrawable) rocketImage.getBackground();
    rocketAnimation.start();

上面还是 Android 官网的列子。可以看出，帧动画是被当成背景使用的，所以，帧动画属于 View backgrond 系统的一部分。
在获取到一个 AnimationDrawable 对象后，通过调用 start() 方法就可以让动画动起来了。
