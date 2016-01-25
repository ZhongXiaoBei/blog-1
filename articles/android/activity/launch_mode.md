# 定义 Activity 启动模式 launch mode

Android 提供了两种设置 Activity 启动模式的方式。一种是在 manifest 文件中定义，一种是使用 Intent flags。

## Using the manifest file

> When you declare an activity in your manifest file ,you can specify how the activity should associate with tasks when it starts.

在 Manifest 文件中定义 <activity\> 元素的时候，可以指定 launchMode 属性。

### standard 
 
标准的启动方式，也是默认的启动方式，每次启动都会创建一个新的 Activity 实例，放入栈的顶端。

### singleTop 
 
启动的时候，如果有一个该 Activity 的实例存在于栈的顶端，则重用这个实例。这个被重用的 Activity 实例会收到 Activity.onNewIntent() 的回调。

> Note : When a new instance of an acitivity is created , the user can press the Back button to reture to the previous activity.But when an existing instance of an activity handles a new intent , the user cannot press the Back button to return to the state of the activity before the new intent arrived in onNewIntent().

### singleTask 
 
启动的时候，如果有一个该 Activity 的实例存在于栈中，则重用这个实例。Activity.onNewIntent() 同样会被回调。并且在栈中，位于这个实例以上的其他 activity 会被移除。

> Note : Although the activity starts in a new task , the Back button still returns the user to the previous activity.

### singleInstance 
 
在单独的栈中创建一个实例，只创建一次，其他应用启动该 Activity 的时候，都重用这个实例。

## Using Intent flags

When starting an activity , you can modify the default association of an activity to its taks by including flags in the intent that you deliver to startActivity() . flags 有如下几种取值：

### FLAG\_ACTIVITY\_NEW\_TASK

Start the activity in a new task . 行为和 “singleTask” 的启动模式是一样的。

### FLAG\_ACTIVITY\_SINGLE\_TOP

和 “singleTop” 的启动模式一样，如果栈顶已经有这个 Activity 了，就重用这个 Activity，这个 Activity 会收到 newIntent() 的回调。

### FLAG\_ACTIVITY\_CLEAR\_TOP

这个 flag 没有对应的 luanchMode 。

如果被启动的 Activity 已经存在，那么，位于这个 Activity 上面的其他 Activity 会被销毁，而那个被启动的 Activity 会收到 newIntent() 回调。If the activity being started is already running the current task , then instead of launching a new instance of that activity , all of the other activitys on top of it are destroyed and this intent is delivered to the resumed instance of the activity(now on top) , throgh onNewIntent().

FLAG\_ACTIVITY\_CLEAR\_TOP  is most often used in conjunction with FLAG\_ACTIVITY\_NEW\_TASK . When used together , these flags are a way of locating an existing activity in another task and putting it in a position when it can respond to the intent .

> Note : If the launch mode of the designated activity is "standard",it too is removed from the stack and a new instance is launched in its place to handle the incoming intent . That's because a new instance is always created for a new intent when the launch mode is "standard".


