# Java 基础之异常抛出

在 Java 里，除了对异常的捕获外，你还可以抛出异常，还可以创造异常。抛出异常的作用就是告诉你的调用者，程序出现了不正常的情况了，得不要期望的结果了。


## throws 声明抛出异常

在你实现的方法里，如果有你处理不了的异常，你应该选择把异常交给你的调用者，而不是让异常在你手上烂掉。比如调用者告诉你文件的路径，让你返回文件的内容，但是这个文件不存在，如果你这是简单的返回一个空 null 给调用者，它可能会以为文件的内容就是空，而不知道真实原因是文件不存在。总之好处多多，但是需要看你项目的需求了。

语法如下：很简单，就是在方法名的后面添加 throws 子句， throws 后面列出异常的类名。

    public void methodname() throws AExcpetion,BException{
    
    }


## throw 抛出异常
throws 是写在方法名的后面的，用来声明这个方法将会抛出的异常。throw 是用来抛出异常的。还是拿文件不存在这个问题举例，你可以这样子做：

    public String readFile(String path) throws FileNotFoundException{
        File file = new File(path);
        if(!file.exist()){
            throw new FileNotFoundException("File not found");
        }
        // 如果文件存在
        // read file and return 
    }

当然，你也可以这样子写：

    public String readFile(String path) throws FileNotFoundException{
        try{
            FileInputStream fis = new FileInputStream(path);
            // read file and return
        }catch(FileNotFoundException e){
            throws e;
        }
    }

这个异常不是你产生的，可是你捕获到了，但你又不知道怎么处理，那你就可以把这个异常抛出去，让调用者来处理。

 - 当你的代码块里存在异常你又不愿意去 catch ，那么你可以在你的方法上添加 throws 子句。
 - 你可以 throw 一个异常，让你的调用者来处理
 - throw 后面的语句就不会执行了。包括 return 。
 - 如果你在 try-catch-finally 的 finally 里有工作需要处理，那么不要在 catch 语句块里 throw 异常。因为这样会导致 finally 语句块不被执行。