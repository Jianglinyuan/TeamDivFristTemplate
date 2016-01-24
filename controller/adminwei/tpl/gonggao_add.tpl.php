<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<link type="text/css" rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/materialize/css/materialize.min.css" media="screen,projection" />
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<style>
table th{ border-bottom:1px solid #eee; font-size:12px; font-weight:100; text-align:right; width:200px;}
table td{ padding-left:10px;}
input.button{ display:inline-block}
</style>
</head>
<body>
<div class="header lr10">
	<a href="http://127.0.0.1/index.php/adminwei/gonggao">公告管理</a>
	<a href="http://127.0.0.1/index.php/adminwei/gonggao/add">增加公告</a>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<!--start-->
    <div class="row">
<form name="myform" action="" method="post" enctype="multipart/form-data" class="col s12">
<!--   <table width="100%" cellspacing="0">
		<tr>
			<td width="120" align="right">幻灯名称:</td>
			<td>
				<input type="text" name="title" value="" class="input-text wid300" />
			</td>
		</tr>
		<tr>
			<td width="120" align="right">幻灯链接:</td>
			<td>
				<input type="text" name="link" value="" class="input-text wid300"/>
			</td>
		</tr>
		<tr>
        	<td width="120" align="right"></td>
            <td>		
            <input type="submit" class="button" name="submit" value="提交" >
            </td>
		</tr>
</table> -->

        <div class="row">
          <div class="input-field col s6">
            <input id="input_text" type="text" length="15" name="title">
            <label for="input_text">公告标题</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <textarea id="textarea1" class="materialize-textarea" length="120" name="content"></textarea>
            <label for="textarea1">公告内容</label>
          </div>
        </div>
 		<div class="row">
 			 <input type="submit" class="waves-effect waves-light btn" name="submit" value="提交" >
 		</div>
</form>
</div>
</div><!--table-list end-->

<script>
function upImage(){
	return document.getElementById('imgfield').click();
}
</script>
</body>
</html> 