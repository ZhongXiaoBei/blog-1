# 三星 4.3 系统数字选择器长按空指针

原因：Samsung Android 4.3 数字选择器的bug。时间选择器和日期选择器是对数字选择器的封装，所有也有同样的问题。在长按增加或者减少数字的时候会出现一个空指针异常（NullPointException），最终导致程序崩溃。

下面是一些链接：

*  stackoverflow  <http://stackoverflow.com/questions/20836979/npe-in-changecurrentbyonefromlongpresscommand-on-samsung-devices-w-android-4-3>
*  Google code：这里讨论的结果是：不是Android 的bug ，是三星的bug。<https://code.google.com/p/android/issues/detail?id=65444#makechanges>
*  三星开发者论坛：有开发者分别提交了两个相同的bug report，但是并没有人提供解决方案 <http://developer.samsung.com/forum/board/thread/view.do?boardName=General&messageId=275587&frm=7&tagValue=androidnumberpicker&curPage=1>
<http://developer.samsung.com/forum/board/thread/view.do?boardName=SDK&messageId=281265&startId=zzzzz~&searchType=ALL&searchText=ChangeCurrentByOneFromLongPressCommand#>