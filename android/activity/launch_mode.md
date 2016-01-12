# Activity launch mode 启动模式

Activity 有四种启动模式，定义在 Android.R.styleable.AndroidManifestActivity_launchMode 里，四种模式分别为 standard , singleTop ， singleTask ， singleInstance

 - standard 
 
	标准的启动方式，也是默认的启动方式，每次启动都会创建一个新的 Activity 实例，放入栈的顶端。

 - singleTop 
 
	启动的时候，如果有一个该 Activity 的实例存在于栈的顶端，则重用这个实例。这个被重用的 Activity 实例会收到 Activity.onNewIntent() 的回调。

 - singleTask 
 
	启动的时候，如果有一个该 Activity 的实例存在于栈中，则重用这个实例。Activity.onNewIntent() 同样会被回调。并且在栈中，位于这个实例以上的其他 activity 会被移除。

 - singleInstance 
 
	在单独的栈中创建一个实例，只创建一次，其他应用启动该 Activity 的时候，都重用这个实例。

除了在 AndroidMenifest 文件里定义外，启动模式也可以在运行时被修改，Intent.FLAG\_ACTIVITY\_SINGLE_TOP ， FLAG\_ACTIVITY\_NEW\_TASK ， FLAG\_ACTIVITY\_MULTIPLE\_TASK 。