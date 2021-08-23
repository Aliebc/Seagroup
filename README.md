# Seagroup - 清华网盘批量添加用户解决方案

* 编写语言：PHP
* 操作平台：Windows/Linux/MacOS
* 作者：Aliebc Xiang

## 适用场景

考虑到经管学院的学术网盘运营，需要维持庞大的群组用户数量，一次性获得全部用户是必要的，但由于技术的原因，需要一个便捷的方式进行实现。

## 使用预备

前置安装项：PHP 7 （macOS内置，因此推荐使用macOS或Linux的同学运行）

参见：<https://www.php.net/manual/en/install.php>

## 使用方法

获得TOKEN:

在登录清华网盘（已经登录的退出重新登录）的时候打开浏览器开发调试工具(F12)，在如下图所示的一项请求中找到相应Cookie的一项，在用户名之后@的一项即为Cookie

![](https://pic3.zhimg.com/80/v2-d6948fc688a3fdaad572bc4c1e10e5b5_1440w.png)

验证Token(curl命令可以在macOS和Linux中的命令行原生运行）:

`curl -H 'Authorization: Token d9299edf7fa7197b3932d4c982*******' https://cloud.tsinghua.edu.cn/api2/auth/ping/`

`"pong"`

若返回"pong"，则代表正确

使用Token:

在文件seagroup.conf中 将你的TOKEN复制替代原有的

`TOKEN 这里替换成你的TOKEN`

`TOKEN d9299edf7fa7197b3932d4c982********`

获得群组号码：

![](https://pica.zhimg.com/80/v2-11bfa2c6f95ebfd8d7373b3fa2e6a90f_1440w.png)

打开群组后地址栏就可以看见群组号，更新配置文件中的GROUP_ID

添加学生：

文本形式打开seagroup.sh

修改注释那一行的

```
$res=Addmembers(2020011629,2020011857);//这里替换成起始学号和结束学号，之后直接运行程序即可

```

运行程序:

```
cd 文件夹路径
./seagroup.sh 或 php seagroup.sh

```



