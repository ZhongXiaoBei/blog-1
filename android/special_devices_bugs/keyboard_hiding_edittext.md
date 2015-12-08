# WebView 输入文本的时候，页面空白

这是一个 Anroid WebView 已知的bug，大概原因是全屏模式下，软键盘弹出后，高度计算错误。link ： https://code.google.com/p/android/issues/detail?id=5497

在 Android 4.4 以后，Translucent 样式下，也同样存在这个问题。http://stackoverflow.com/questions/19897422/keyboard-hiding-edittext-when-androidwindowtranslucentstatus-true

解决办法：

不使用全屏模式，不使用 Translucent 样式。