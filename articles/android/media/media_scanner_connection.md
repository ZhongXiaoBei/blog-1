# Android MediaScannerConnection 

今天被 MediaScannerConnection 差点搞死了，结果只是很简单的一个问题。


<!--more-->

## ACTION_MEDIA_MOUNTED 不能使用
在 Android 4.4 之后，ACTION_MEDIA_MOUNTED 这个广播只能由系统发出，APP 只能监听，不能广播，所以通过发送广播的方式来让系统扫描文件的做法已经是走不通了。

下面是一个老外写的。

> From the SDK standpoint, this was a broadcast that developers were meant to consume, by having a BroadcastReceiver listening for it. However, many blog posts, StackOverflow answers, and the like advocated having apps send that broadcast, as it triggered a complete re-scan of external storage, for the purposes of MediaStore.

> Sending such a broadcast would trigger warnings in LogCat in Android 4.3, but now, as of Android 4.4, I can confirm that your app will crash with a SecurityException for trying to send it. Instead, use MediaScannerConnection or ACTION_MEDIA_SCANNER_SCAN_FILE to request indexing of new files.

在　4.4　以后，会因为权限不够抛出运行时异常，如下：

    E/AndroidRuntime(23718): java.lang.SecurityException: Permission Denial: not allowed to send broadcast android.intent.action.MEDIA_MOUNTED from pid=23718, uid=10097

## MediaScannerConnection 
Android 认为，使用 MediaScannerConnection 会更加廉价，也就是系统的开销少，原因有两个，个人猜测，未详细看代码，只是猜测。

1. 如果是通过广播 ACTION_MEDIA_MOUNTED 的话，很多 APP 都会直接广播一个目录，于是系统就一直在扫描整个目录。而　MediaScannerConnection　每次只能扫描一个文件，这样的约束条件可能一定程度上能减少扫描的次数和个数。

3. MediaScannerConnection　使用了比　ACTION_MEDIA_MOUNTED　更高效或更轻便的实现。


## MediaScannerConnection 两种使用方式

1. 创建　MediaScannerConnection　对象，调用　scanFile() 方法。

    public void scanFile(String path, String mimeType)

创建　MediaScannerConnection　对象的时候需要实现　MediaScannerConnection.MediaScannerConnectionClient　接口，这个接口只有两个方法。在调用　MediaScannerConnection.connect()　方法后，MediaScannerConnectionClient　接口的　onMediaScannerConnected()　方法会被回调，然后就可以调用　MediaScannerConnection.scanFile(String,String)　方法了。在扫描完成后，MediaScannerConnectionClient　的方法　onScanCompleted(String path, Uri uri)　会被回调，在这个方法里，一般调用MediaScannerConnection.disconnect()　方法。　

这个方法一次只能扫描一个文件，path 必须是一个具体的文件，不能是目录。在创建一个　MediaScannerConnection　对象后，如果要多次调用　scanFile() 方法，就不要在　onScanCompleted() 方法里调用　disconnect()　方法。

2. 使用　MediaScannerConnection.scanFile() 静态方法。

    public static void scanFile(Context context, String[] paths, String[] mimeTypes,
                OnScanCompletedListener callback) 

这是一个静态方法，使用就比较简单了。OnScanCompletedListener　可实现可不实现，它只有一个方法，在扫描完成的时候回调。scanFile　静态方法可以一次传递多个文件，如果　mimeTypes　不为空，就必须于 paths　的长度一致。mimeTypes　可以为空。

## MimeType　的选择。
今天就差点死在这里了，如果 MimeType ,将会使用文件的后缀名来判断文件的类型，但是千万别用　\*/\* ，我以为使用这个它会自动判断文件的类型的，结果不是这样子的。使用　\*/\* 的结果就是扫描完成后，相册里的东东全部没有出现在　MediaStore　里，也就是没有被当成多媒体文件扫描进多媒体数据库里。

## 一个完成的代码

下面的代码是我今天修改来的代码，递归实现扫描某个目录。

    package com.binkery.app.filemanager.utils;
    
    import java.io.File;
    
    import android.content.Context;
    import android.media.MediaScannerConnection;
    import android.net.Uri;
    
    public class MediaScanner {
    
    	private static final String TAG = MediaScanner.class.getSimpleName();
    
    	private MediaScannerConnection mConn = null;
    	private SannerClient mClient = null;
    	private File mFile = null;
    	private String mMimeType = null;
    
    	public MediaScanner(Context context) {
    		if (mClient == null) {
    			mClient = new SannerClient();
    		}
    		if (mConn == null) {
    			mConn = new MediaScannerConnection(context, mClient);
    		}
    	}
    
    	class SannerClient implements
    			MediaScannerConnection.MediaScannerConnectionClient {
    
    		public void onMediaScannerConnected() {
    
    			if (mFile == null) {
    				return;
    			}
    			scan(mFile, mMimeType);
    		}
    
    		public void onScanCompleted(String path, Uri uri) {
    			mConn.disconnect();
    		}
    
    		private void scan(File file, String type) {
    			Logs.i(TAG, "scan " + file.getAbsolutePath());
    			if (file.isFile()) {
    				mConn.scanFile(file.getAbsolutePath(), null);
    				return;
    			}
    			File[] files = file.listFiles();
    			if (files == null) {
    				return;
    			}
    			for (File f : file.listFiles()) {
    				scan(f, type);
    			}
    		}
    	}
    
    	public void scanFile(File file, String mimeType) {
    		mFile = file;
    		mMimeType = mimeType;
    		mConn.connect();
    	}
    
    }
