# startActivityForResult

在项目中，发现很多程序员对 startActivityForResult 的用法很不了解，特别是对 requestCode 和 resultCode 分不清。requestCode 和 resultCode 分不清，导致了代码的耦合度相当大，很多人把 requestCode 当 resultCode 使用了。

咱们现在假设 A startActivityForResult B，A 称为发起方，B 称为响应方。那么代码应该满足以下几个要求：

* 响应方不应该关心 requestCode，requestCode 由发起方自己管理。

    也就是说，requestCode 可以是一个常量，但是这个常量的访问范围肯定是在发起方内，响应方不应该有这个 requestCode 的引用。

* 响应方在 setResult 的时候，resultCode 一般只有 RESULT_OK 和 RESULT_CANCEL 两种

	所以在 onActivityResult 的回调中，一般情况下只需要判断 resultCode

* 在 onActivityResult 中，一般先判断 requestCode，根据 requestCode 交给不同的代码去处理。不要一上来就根据 resultCode == RESULT_CANCEL 就直接 return 了。职责要分清楚，谁发起的请求，谁来接收响应，不要出现一个王母娘娘，