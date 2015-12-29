# ContextImpl: Failed to ensure directory

在通过 context.getExternalCacheDir() 或者 context.getCacheDir() 类似的方法获取文件的时候，可能会报以下的错误：

    ContextImpl: Failed to ensure directory: /storage/sdcard1/Android/data/com.binkery.allinone/cache

在 Stackoverflow 上找到的答案，基本可以忽略这个错误提示。
## Answer 1 :

This happened to me when uninstalling the app and reinstalling it. But probably the resources of the app (com.xxxx.app in your case) had a reference not released.

The solution was quite simple: just stop and relaunch the emulator, or reboot the phone should do the trick.

## Answer 2 :

This is because you are connected to your development machine, and cannot write to the emulated storage on it.
        
link ：<http://stackoverflow.com/questions/27736608/android-failed-to-ensure-directory-when-getexternalfilesdirnull>