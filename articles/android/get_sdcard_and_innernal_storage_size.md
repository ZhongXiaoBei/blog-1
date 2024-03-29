# 获取 sdcard 和 内部存储的空间大小

Android 从某个版本开始（具体哪个忘了），会虚拟出一个 sdcard 出来，当你使用  Environment.getExternalStorageDirectory() 获取的目录，其实是位于手机内存存储的空间，也就是 ROM 里的空间，并不是用户插入的 sdcard ，要获取用户的 sdcard 目录，可以使用反射来实现。


<!--more-->

	StorageManager sm = (StorageManager) context.getSystemService(Context.STORAGE_SERVICE);
    String[] paths = (String[]) sm.getClass().getMethod("getVolumePaths", null).invoke(sm, null);

这里获取到的目录，都是手机系统的厂商定制的，鬼知道这些目录会被叫什么名字，一般有 
 /storage/sdcard1 也见过 /storage/ext_sd 之类的，还有 /storage/usb ，或者 /storage/usbotg 。

这个数组里，会有一个和 Environment.getExternalStorageDirectory() 相同的目录，这个是系统虚拟出来的。其他的就可能是咱们要的 sdcard 了，但不全是。所有，你需要根据这个目录 new 一个 File 出来，判断这个 File 是否存在，是否可读或可写，那些不存在并且不可读可写的，都是当前没有被挂载的，剩下的就是当前已经挂载的了。

还有另外一个方法，在 stackoverflow 上看的，可以把 /mnt 目录下的子目录都列出来。这样也可以获取到 sdcard 的目录，链接在这：<http://stackoverflow.com/questions/11281010/how-can-i-get-external-sd-card-path-for-android-4-0>

    File storageDir = new File("/mnt/");
    if(storageDir.isDirectory()){
        String[] dirList = storageDir.list();
        //TODO some type of selecton method?
    }

获取到 sdcard 的路径后，咱们会关心的大小，网上有很多使用 StatFs 来获取大小的。大概是这样子的：

    StatFs stat = new StatFs(path);
    long blockSize = stat.getBlockSize();
    long totalBlocks = stat.getBlockCount();

这里方法很多，不一一列举，但是这些方法都是过期的，推荐使用新的方法。新的方法是 getBlockSizeLong getAvailableBlocksLong，方法也不少，大多是在过期的方法后面加上 Long，但是这些方法需要在 API 18 后才可以用，于是你需要写两份，还需要判断当前 SDK 版本。

其实，通过 File.getTotalSpace() 等方法就可以获取对应的大小，没必要那么费劲。咱们可以看一下 File 的源代码。


    /**
     * Returns the total size in bytes of the partition containing this path.
     * Returns 0 if this path does not exist.
     *
     * @since 1.6
     */
    public long getTotalSpace() {
        try {
            StructStatVfs sb = Libcore.os.statvfs(path);
            return sb.f_blocks * sb.f_bsize; // total block count * block size in bytes.
        } catch (ErrnoException errnoException) {
            return 0;
        }
    }

    /**
     * Returns the number of usable free bytes on the partition containing this path.
     * Returns 0 if this path does not exist.
     *
     * <p>Note that this is likely to be an optimistic over-estimate and should not
     * be taken as a guarantee your application can actually write this many bytes.
     * On Android (and other Unix-based systems), this method returns the number of free bytes
     * available to non-root users, regardless of whether you're actually running as root,
     * and regardless of any quota or other restrictions that might apply to the user.
     * (The {@code getFreeSpace} method returns the number of bytes potentially available to root.)
     *
     * @since 1.6
     */
    public long getUsableSpace() {
        try {
            StructStatVfs sb = Libcore.os.statvfs(path);
            return sb.f_bavail * sb.f_bsize; // non-root free block count * block size in bytes.
        } catch (ErrnoException errnoException) {
            return 0;
        }
    }

    /**
     * Returns the number of free bytes on the partition containing this path.
     * Returns 0 if this path does not exist.
     *
     * <p>Note that this is likely to be an optimistic over-estimate and should not
     * be taken as a guarantee your application can actually write this many bytes.
     *
     * @since 1.6
     */
    public long getFreeSpace() {
        try {
            StructStatVfs sb = Libcore.os.statvfs(path);
            return sb.f_bfree * sb.f_bsize; // free block count * block size in bytes.
        } catch (ErrnoException errnoException) {
            return 0;
        }
    }

这里有三个方法，它是通过获取 StructStatVfs 的方法去计算的，跟 StatFs 是一样的。查看一下 StatFs 源代码就知道了。

    public class StatFs {
        private StructStatVfs mStat;

	public StatFs(String path) {
            mStat = doStat(path);
        }

        private static StructStatVfs doStat(String path) {
            try {
                return Libcore.os.statvfs(path);
            } catch (ErrnoException e) {
                throw new IllegalArgumentException("Invalid path: " + path, e);
            }
        }
    }

跟 File 用的是一样一样滴。

再回到 File 来，三个方法，getTotalSpace() 就是获取全部空间，这个没有问题。getUsableSpace() 和 getFreeSpace() 的区别是什么呢？看注释，getUsableSpace() 大概的意思是说，返回一个非 root 用户可用的空间大小，但管你是使用 root 身份还是其他被限定配额的用户身份，这里获取到的都是同样的大小。而 getFreeSpace() 获取的是 root 用户可以使用的空间，文档上这么写的，我也不是很理解，可能需要去看看 Linux 文件系统相关的知识补充一下。

所有，最后，通过 File 的 getTotalSpace() 和 getFreeSpace() 可以获取到 sdcard 的空间和可用的空间。英语不好，可能翻译不对，File 的源码把注释也扣过来了。