# Toast

Toast 是 Android 中经常用到的一个组件，被用在一些简单的文案提示上，也是开发过程中的一些临时的调式手段。

## Toast 的实现的大概分析

在 Toast 的 makeText 方法中，Toast 会去 inflate 一个 layout，这个 layout 是一个 LinearLayout 里，包含了一个 TextView ，TextView 的 id 是 message。所以，每次都是用 makeText 并不是一个好主意。

在 show 方法里，它把一个内部的封装类 TN 的一个实例，放入到一个 service 的队列里。

最终，是通过 WindowManager 把这个 Layout 添加到屏幕上的。

这当中，涉及到进程间的通信，以及消息队列的管理。

## Toast 的优化

一般来说，可以不需要每次都通过 makeText 的方式。但是，其实呢，真的可以忽略这点性能。不过呢，作为一个项目，确实应该统一管理 Toast，所以封装一个 Toast 的工具类也是有必须要的。