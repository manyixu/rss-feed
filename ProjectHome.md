项目介绍：

twitter-rss.php ： 过滤Twitter的RSS Feed中的用户名、所有回复给他人（包括RT）的信息，只保留自己的信息，然后重新以RSS Feed的方式输出，供其第三方应用程序使用。

sinarss.php : 这个新浪微博RSS的原理很简单，就是当用户访问的时候，抓取新浪微博的用户页面，将里面的信息进行过滤，按照标准RSS的格式生成一个RSS Feed，这个程序目前支持新浪微博的认证用户和草根用户，但两者调用方法略有不同。sinarss.php是用于新浪认证用户的。sinarss2.php用于新浪草根用户的。sinarss.php的调用方法举例： sinarss.php?username=williamlong

sinarss2.php : 功能和上一个一样，但是用于新浪草根用户的。sinarss.php的调用方法举例： sinarss2.php?id=1494759712

详细安装和部署说明，请参见以下文章：

1、新浪微博的RSS Feed功能 - http://www.williamlong.info/archives/2080.html

2、Twitter的RSS Feed过滤工具 - http://www.williamlong.info/archives/1781.html

代码下载请访问这里： http://code.google.com/p/rss-feed/source/browse/trunk