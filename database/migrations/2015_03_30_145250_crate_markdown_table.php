<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateMarkdownTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("markdown", function(Blueprint $table)
			{
                $table->increments('id');
				$table->text('body');
				$table->softDeletes();
                $table->timestamps();
			});
		self::initialize();
	}


    private function initialize()
    {
    	\DB::table('markdown')->insert(['body' => '### 本文采用Markdown语法书写

>也可以参考以下几个网站
>
>`文中所有参考图片皆来自网络，感谢大神们的提供`
>
>*  [Markdown官方说明](http://daringfireball.net/projects/markdown/syntax)
>
>*  [Markdown中文说明](http://wowubuntu.com/markdown/)
>
>*  [其他](http://www.jianshu.com/p/1e402922ee32/)或者[百度](https://www.baidu.com)`Markdown`
>
>*  [Markdown js解析器](https://github.com/gamelife1314/showdown)-->拷贝自大神
>
>*  [Markdown php解析器](https://github.com/gamelife1314/php-markdown)-->拷贝自大神
***
###标题

####[atx](http://docutils.sourceforge.net/mirror/setext.html)样式
>   *    `#` 一级标题
>   *    `##` 二级标题
>   *    `###` 三级标题
>   *    `####` 四级标题
>   *    `#####` 五级标题
>   *    `######` 六级标题
>
>  ![图片说明](image/markdown/head.jpg)
####[Setex](http://www.aaronsw.com/2002/atx/)样式
>   *    利用`=`和`-`分别表示最高阶标题和第二阶标题
>   *    例如。。。。。(不知道如何编辑，如果大家觉得上面的方法不方便，[请看](http://wowubuntu.com/markdown/))
***
###区块引用
>Markdown 标记区块引用是使用类似 email 中用`>`的引用方式。如果你还熟悉在 email 信件中的引言部分，
>你就知道怎么在 Markdown 文件中建立一个区块引用，那会看起来像是你自己先断好行，然后在每行的最前面加上`>`,例如 ：
>1.    `> This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,`
>
>      `>consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.`
>
>      `> Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.`
>
>      `>`
>
>      `> id sem consectetuer libero luctus adipiscing.`
>
>######`>`引用的区块内也可以使用其他的 Markdown 语法，包括标题、列表、代码区块，更详细的使用请见[这里](http://wowubuntu.com/markdown/))
>
>![图片说明](image/markdown/quote.jpg)
***
###列表
>在 Markdown 下，列表的显示只需要在文字前加上 `-` 或 `*`或`+` 即可变为无序列表，有序列表则直接在文字前加`1.` `2.` `3.` 符号要和文字之间加上一个字符的空格。
>
>
>例如：![list](image/markdown/list.jpg)
***
###图片和链接
>1.  图片为：`![]()`
>
>2.  链接为：`[]()`
>
>链接或者文字都是用 [方括号] 来标记，`()`里面为图片或链接地址,如果你还想要加上链接的 title 文字，只要在网址后面，用双引号把 title 文字包起来即可
>例如:
>
>*		`[an example](http://example.com/ "Title")`
>
>*		`[This link](http://example.net/) has no title attribute.`
>
>*		`![Alt text](/path/to/img.jpg)`
>
>*		`![Alt text](/path/to/img.jpg "Optional title")`
>
>![图片说明](image/markdown/image.jpg)

***
###粗体与斜体
>Markdown 的粗体和斜体也非常简单，用两个`*`包含一段文本就是粗体的语法，用一个`*`包含一段文本就是斜体的语法。
***
###代码框
>如果你是个程序猿，需要在文章里优雅的引用代码框，在 Markdown下实现也非常简单，只需要用两个`把中间的代码包裹起来
>
>![图片说明](image/markdown/code.jpg)
***
###分割线
>你可以在一行中用三个以上的星号`*`、减号`-`、底`-`来建立一个分隔线,行内不能有其他东西
***
###反斜杠
>Markdown 可以利用反斜杠来插入一些在语法中有其它意义的符号，例如：如果你想要用星号加在文字旁边的方式来做出强调效果（但不用 `<em>` 标签），你可以在星号的前面加上反斜杠：
>`\*literal asterisks\*`
>
>Markdown 支持以下这些符号前面加上反斜杠来帮助插入普通的符号
>
>*		`\`   反斜线
>
>*		``` 反引号
>
>*		`*`   星号
>
>*		`_`   底线
>
>*      `{}`  花括号
>
>*      `[]`  方括号
>
>*      `()`  括弧
>
>*      `#`   井字号
>
>*      `+`   加号
>
>*      `-`   减号
>
>*      `.`   英文句点
>
>*      `!`   惊叹号
']);
    }
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("markdown");
	}

}
