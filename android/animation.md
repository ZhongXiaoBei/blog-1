# Android 动画

一般来说，Android 有好几种动画，但是从官网上，Android 提供了两种动画系统（Animation Systems）。包括属性动画（Property Animation）和视图动画（View Animation）。帧动画（Drawable animation） 是一个附加的动画效果，可以运行你一帧一帧的渲染动画，比较简陋，称不上是一个动画系统。

## Property Animation

Android 3.0(API 11) 引入。属性动画可以修改任何对象（any object）的属性。注意，是任何对象，包括渲染到屏幕上的对象，也就是 View，当然任何对象的意思是包括不显示到屏幕上的对象也可以。

## View Animation

视图动画只能被用在 View 上，在大部分情况下，视图动画是可以满足一般应用的使用场景的。其实他是属于 Android View 系统的一部分，伴随着 Android 的第一版一起发布的。

## Drawable Animation

帧动画就是一帧一帧的渲染图片资源，也就是 drawable resource。比较简单好用，当然功能也比较弱，缺点也是有的。其实它属于 View 系统中背景的一部分。
