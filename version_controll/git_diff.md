# git diff 

通过 git diff --help 查询 git 帮助文档可看到

	git diff [--options] <commit> <commit> [--] [<path>...]
	
这个是 diff 两个 commit 之间的内容, 是 commit 的 ID 号，可以通过 git log 查看。获取到两个 commit 的 ID 号后，就可以查看两个 commit 的修改内容了。

	git diff commit-id-1 commit-id-2 
	
或者可以输出到文件里：

	git diff commit-id-1 commit-id-2 >> diff.txt
	