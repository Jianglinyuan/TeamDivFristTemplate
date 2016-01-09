@(Divteam)[Teamplate|Bug修复]

(2016-1-8 18:07 begin)

#### 1\. `controller\go\index.action.php`->`function dataserver`:

* 将“没有这个商品”下面的一段代码注释掉：
```php
		if(!$item){
			_message("没有这个商品!");
		}
		// if(empty($item['q_end_time']) && $item['q_showtime'] == 'Y'){
		// 	header("location: ".WEB_PATH."/dataserver/".$item['id']);
		// 	exit;
		// }
```	

* 还有“该商品正在进行中”下面那一段也注释掉：
```php
		if(empty($item['q_user_code'])){
			_message("该商品正在进行中...",WEB_PATH.'/goods/'.$itemid);
		}
		// if(isset($item['q_showtime']) && $item['q_showtime'] == 'Y'){
		// 	header("location: ".WEB_PATH."/dataserver/".$item['id']);
		// 	exit;
		// }
```

* 找到`$itemlist`的定义，在`select`里加上`, q_showtime`：
```php
$itemlist = $this->db->GetList("select id,sid,q_uid,qishu,q_showtime from `@#_shoplist` where `sid`='$item[sid]' order by `qishu` DESC");
```

* 在期数显示的那段代码下方的第一个`if`，括号中增加是否正在倒计时的判断：
```php
		//期数显示
		$itemlist = $this->db->GetList("select id,sid,q_uid,qishu,q_showtime from `@#_shoplist` where `sid`='$item[sid]' order by `qishu` DESC");
		$loopqishu='<ul class="Period_list">';
		//没有获奖者，且未进入倒计时动画 => 显示商品详情页面
		if(empty($itemlist[0]['q_uid']) && $itemlist[0]['q_showtime']=='N') {
			$loopqishu.='<li><a href="'.WEB_PATH.'/goods/'.$itemlist[0]['id'].'"><b class="period_Ongoing">'."第".$itemlist[0]['qishu']."期<i></i></b></a></li>";
			unset($itemlist[0]);
		}
```

#### 2\. `controller\adminwei\setting.action.php`->`function config`:

将倒计时300秒上限改为3599秒（59分59秒）：
```php
			if($goods_end_time >= 3599){

				$goods_end_time = 3599;

			}
```	

#### 3\. `controller\adminwei\tpl\config.system.tpl.php`:

第35行，将提示也更新一下：
```php
<span>单位(秒),不低于30秒，不大于3599秒（59分59秒）</span>
```
(2016-1-8 18:07 end)



#移动搜索页面及退出登陆使用说明

1. 添加mobile.action.php 到 controller/search 文件夹
2. 替换param.inc.php 到data/config/ 文件夹下同名文件
3. 替换user.action.php至 controller/member 文件夹同名文件

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
##[2015.12.31]163模板修改说明##
**在common/global.fun.php文件合适位置增加下面函数：**
```php
function qubiaoqian($string){
	return strip_tags($string);
}
```
**index.action.php文件修改过多，我还是拿出来给大家替换一下最好**

##即将更新彩票代码。
##未完待续-2015.12.21 By Dogod
