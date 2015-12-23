#移动端 Bug 或其他问题汇总（持续更新）


###总体
---
* 在后台更改SEO相关信息

###首页
---
* header中返回按钮位置偏移（本页是否需要返回按钮？）

###所商品页面
---
* 返回按钮位置偏移

###最新揭晓页面
---
* 返回按钮位置偏移

###购物车页面
---
* 暂无

###登陆页面
---
* 登陆前：忘记密码按钮位置偏移
* 微信登陆及QQ登陆失效
* 进入QQ登陆页面后无法返回首页（或登陆页面）
* 移动端手机注册提示系统短消息配置不正确

###限时揭晓页面
---
* 暂无

###幸运晒单页面
---
* 整体格式混乱，需重新排版

###新手指南页面
---
* 无返回按钮
* 底部导航栏显示不正确

###在线充值
---
* 暂无
 

@(Divteam)[Teamplate|Bug修复]
~~是branch，不是brancth，挖鼻 @linyuan~~
#使用说明
 
- **修改配置文件** ：修改/data/config/templates.inc.php文件下的代码如下：
```php
<?php 
 defined('G_IN_SYSTEM') or exit('No permission resources.');
 return array (
  'xiaomi' => 
  array (
    'name' => 'Div-Xiaomi',
    'dir' => 'xiaomi',
    'html' => 'tiansjhtml',
    'author' => 'DivTeam',
  ),
)
 ?>
```
以及同文件夹下的system.inc.php文件如下代码行：
```php
<?php 

'templates_name' => 'xiaomi',//当前模板方案

 ?>
```


#与模板相关Bug修复（更新中）
#####- ①找到\controller\go\index.action.php文件。
**第27行改为**
```php
$shoplistrenqi2=$this->db->GetList("select * from `@#_shoplist` where `renqi`='1' and `q_uid` is null ORDER BY id DESC LIMIT 0,8");
```
**23行修改为**
 
```php
$shoplist=$this->db->GetList("select * from `@#_shoplist` where `q_uid` is null ORDER BY `shenyurenshu` ASC LIMIT 0,8");

```
#####- ②找到controller\go\lib\my.fun.php、controller\home\lib\my.fun.php、controller\mobile\lib\my.fun.php
**找到里面相同的代码段**
```php
function width($p,$t,$w){
//原来的函数代码我忘了什么样子的了。
}
```
**将这三个文件中的width函数修改为：**
```php
  function width($p,$t,$w){
   	if($p<=0){return 0;}
    return $p/$t*$w;
  }
```
####【2015.12.21】修复了【单页面模板】【帮助页面】【各种介绍页面】无法访问的Bug。
##未完待续-2015.12.20by Dogod
