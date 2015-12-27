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
####[2015.12.25]首页晒单没批准就显示Bug。
**修改index.action.php文件的第94行代码为：**
```php
$shaidan=$this->db->GetList("select * from `@#_shaidan` a left join `@#_member` b on  a.sd_userid=b.uid where grade!='D'  order by `sd_id` DESC LIMIT 1");
```
```php
$shaidan_two=$this->db->GetList("select * from `@#_shaidan` a left join `@#_member` b on  a.sd_userid=b.uid where grade!='D'  order by `sd_id` DESC LIMIT 1,6");
```

##未完待续-2015.12.25 By Dogod
