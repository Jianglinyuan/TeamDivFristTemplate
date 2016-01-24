<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
        <link type="text/css" rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/materialize/css/materialize.min.css" media="screen,projection" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
        <script src="<?php echo G_PLUGIN_PATH; ?>/layer/layer.min.js"></script>
        <script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/global.js"></script>
        <title>后台首页</title>
        <script type="text/javascript">
        var ready = 1;
        var kj_width;
        var kj_height;
        var header_height = 91;
        var R_label;
        var R_label_one = "当前位置:";


        function left(init) {
            var left = document.getElementById("left");
            var leftlist = left.getElementsByTagName("ul");
            document.getElementById(init).style.display = "block";
        }

        function secBoard(elementID, n, init, r_lable) {

            var elem = document.getElementById(elementID);
            var elemlist = elem.getElementsByTagName("li");
            for (var i = 0; i < elemlist.length; i++) {
                elemlist[i].className = "normal";
            }
            elemlist[n].className = "current";
            R_label_one = "当前位置: " + r_lable;
            R_label.text(R_label_one);
            left(init);
        }


        function set_div() {
            kj_width = $(window).width();
            kj_height = $(window).height();
            if (kj_width < 1000) {
                kj_width = 1000;
            }
            if (kj_height < 500) {
                kj_height = 500;
            }
            $("#right_iframe").css('height', kj_height);
            $("#iframe_src").css('height', kj_height);
        }


        $(document).ready(function() {
            set_div();
                    $("#off_on").click(function() {
                if ($(this).attr('val') == 'open') {
                    $(this).attr('val', 'exit');
                    $("#right").css('width', kj_width);
                    $("#right").css('left', 1);
                    $("#right_iframe").css('width', kj_width - 25);
                    $("iframe").css('width', kj_width - 27);
                } else {
                    $(this).attr('val', 'open');
                    $("#right").css('width', kj_width - 182);
                    $("#right").css('left', 182);
                    $("#right_iframe").css('width', kj_width - 206);
                    $("iframe").css('width', kj_width - 208);
                }
            });

            left('setting');
            $(".left_date a").click(function() {
                $(".left_date li").removeClass("set");
                $(this).parent().addClass("set");
                R_label.text(R_label_one + ' ' + $(this).text());
                $("#iframe_src").attr("src", $(this).attr("src"));
            });
            $(".left_date1 a").click(function() {
                $(".left_date li").removeClass("set");
                $(this).parent().addClass("set");
                R_label.text(R_label_one + ' ' + $(this).text());
                $("#iframe_src").attr("src", $(this).attr("src"));
            });
            $("#iframe_src").attr("src", "<?php echo G_MODULE_PATH; ?>/index/Tdefault");
            R_label = $("#R_label");
            //  $('body').bind('contextmenu',function(){return false;});
            //  $('body').bind("selectstart",function(){return false;});

        });

        function api_off_on_open(key) {
            if (key == 'open') {
                $("#off_on").attr('val', 'exit');
                $("#right").css('width', kj_width);
                $("#right").css('left', 1);
                $("#right_iframe").css('width', kj_width - 25);
                $("iframe").css('width', kj_width - 27);
            } else {
                $("#off_on").attr('val', 'open');
                $("#right").css('width', kj_width - 182);
                $("#right").css('left', 182);
                $("#right_iframe").css('width', kj_width - 206);
                $("iframe").css('width', kj_width - 208);
            }
        }
        </script>
    </head>
<style>
    .left_date li a {
        color:#757575;
    }
</style>
<body>
    <script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/css/materialize/js/materialize.min.js"></script>

    <script>
    //
    $(document).ready(function() {
        $('span.bar-btn').click(function() {
            $('ul.bar-list').toggle('fast');
        });
    });

    // $(document).ready(function() {
    //     var pagestyle = function() {
    //         var iframe = $("#workspace");
    //         var h = $(window).height() - iframe.offset().top;
    //         var w = $(window).width() - iframe.offset().left;
    //         if (h < 300) h = 300;
    //         if (w < 973) w = 973;
    //         iframe.height(h);
    //         iframe.width(w);
    //     }
    //     pagestyle();
    //     $(window).resize(pagestyle);
    //     //turn location
    //     if ($.cookie('now_location_act') != null) {
    //         openItem($.cookie('now_location_op') + ',' + $.cookie('now_location_act') + ',' + $.cookie('now_location_nav'));
    //     } else {
    //         $('#mainMenu>ul').first().css('display', 'block');
    //         //第一次进入后台时，默认定到欢迎界面
    //         $('#item_welcome').addClass('selected');
    //         $('#workspace').attr('src', '<?php echo G_ADMIN_PATH; ?>/index/Tdefault');
    //     }
    //     $('#iframe_refresh').click(function() {
    //         var fr = document.frames ? document.frames("workspace") : document.getElementById("workspace").contentWindow;;
    //         fr.location.reload();
    //     });

    // });
    //收藏夹
    function addBookmark(url, label) {
        if (document.all) {
            window.external.addFavorite(url, label);
        } else if (window.sidebar) {
            window.sidebar.addPanel(label, url, '');
        }
    }


    function openItem(args) {
        closeBg();
        //cookie

        if ($.cookie('F81E_sys_key') === null) {
            location.href = 'index.php?act=login&op=login';
            return false;
        }

        spl = args.split(',');
        op = spl[0];
        try {
            act = spl[1];
            nav = spl[2];
        } catch (ex) {}
        if (typeof(act) == 'undefined') {
            var nav = args;
        }
        $('.actived').removeClass('actived');
        $('#nav_' + nav).addClass('actived');

        $('.selected').removeClass('selected');

        //show
        $('#mainMenu ul').css('display', 'none');
        $('#sort_' + nav).css('display', 'block');

        if (typeof(act) == 'undefined') {
            //顶部菜单事件
            html = $('#sort_' + nav + '>li>dl>dd>ol>li').first().html();
            str = html.match(/openItem\('(.*)'\)/ig);
            arg = str[0].split("'");
            spl = arg[1].split(',');
            op = spl[0];
            act = spl[1];
            nav = spl[2];
            first_obj = $('#sort_' + nav + '>li>dl>dd>ol>li').first().children('a');
            $(first_obj).addClass('selected');
            //crumbs
            $('#crumbs').html('<span>' + $('#nav_' + nav + ' > span').html() + '</span><span class="arrow">&nbsp;</span><span>' + $(first_obj).text() + '</span>');
        } else {
            //左侧菜单事件
            //location
            $.cookie('now_location_nav', nav);
            $.cookie('now_location_act', act);
            $.cookie('now_location_op', op);
            $("a[name='item_" + op + act + "']").addClass('selected');
            //crumbs
            $('#crumbs').html('<span>' + $('#nav_' + nav + ' > span').html() + '</span><span class="arrow">&nbsp;</span><span>' + $('#item_' + op + act).html() + '</span>');
        }
        src = 'index.php?act=' + act + '&op=' + op;
        $('#workspace').attr('src', src);

    }

    $(function() {
        bindAdminMenu();
    })

    function bindAdminMenu() {

        $("[nc_type='parentli']").click(function() {
            var key = $(this).attr('dataparam');
            if ($(this).find("dd").css("display") == "none") {
                $("[nc_type='" + key + "']").slideDown("fast");
                $(this).find('dt').css("background-position", "-322px -170px");
                $(this).find("dd").show();
            } else {
                $("[nc_type='" + key + "']").slideUp("fast");
                $(this).find('dt').css("background-position", "-483px -170px");
                $(this).find("dd").hide();
            }
        });
    }
    </script>
    <script type=text/javascript>
    //显示灰色JS遮罩层
    function showBg(ct, content) {
        var bH = $("body").height();
        var bW = $("body").width();
        var objWH = getObjWh(ct);
        $("#pagemask").css({
            width: bW,
            height: bH,
            display: "none"
        });
        var tbT = objWH.split("|")[0] + "px";
        var tbL = objWH.split("|")[1] + "px";
        $("#" + ct).css({
            top: tbT,
            left: tbL,
            display: "block"
        });
        $(window).scroll(function() {
            resetBg()
        });
        $(window).resize(function() {
            resetBg()
        });
    }

    function getObjWh(obj) {
        var st = document.documentElement.scrollTop; //滚动条距顶部的距离
        var sl = document.documentElement.scrollLeft; //滚动条距左边的距离
        var ch = document.documentElement.clientHeight; //屏幕的高度
        var cw = document.documentElement.clientWidth; //屏幕的宽度
        var objH = $("#" + obj).height(); //浮动对象的高度
        var objW = $("#" + obj).width(); //浮动对象的宽度
        var objT = Number(st) + (Number(ch) - Number(objH)) / 2;
        var objL = Number(sl) + (Number(cw) - Number(objW)) / 2;
        return objT + "|" + objL;
    }

    function resetBg() {
        var fullbg = $("#pagemask").css("display");
        if (fullbg == "block") {
            var bH2 = $("body").height();
            var bW2 = $("body").width();
            $("#pagemask").css({
                width: bW2,
                height: bH2
            });
            var objV = getObjWh("dialog");
            var tbT = objV.split("|")[0] + "px";
            var tbL = objV.split("|")[1] + "px";
            $("#dialog").css({
                top: tbT,
                left: tbL
            });
        }
    }

    //关闭灰色JS遮罩层和操作窗口
    function closeBg() {
        $("#pagemask").css("display", "none");
        $("#dialog").css("display", "none");
    }
    </script>
    <script type=text/javascript>
    $(function() {
        var $li = $("#skin li");
        $li.click(function() {
            $("#" + this.id).addClass("selected").siblings().removeClass("selected");
            $("#cssfile").attr("href", "<?php echo WEB_PATH; ?>/admin/templates/default/css/" + (this.id) + ".css");
            $.cookie("MyCssSkin", this.id, {
                path: '/',
                expires: 10
            });

            $('iframe').contents().find('#cssfile2').attr("href", "<?php echo WEB_PATH; ?>/admin/templates/default/css/" + (this.id) + ".css");
        });

        var cookie_skin = $.cookie("MyCssSkin");
        if (cookie_skin) {
            $("#" + cookie_skin).addClass("selected").siblings().removeClass("selected");
            $("#cssfile").attr("href", "<?php echo WEB_PATH; ?>/admin/templates/default/css/" + cookie_skin + ".css");
            $.cookie("MyCssSkin", cookie_skin, {
                path: '/',
                expires: 10
            });
        }
    });

    function addFavorite(url, title) {
        try {
            window.external.addFavorite(url, title);
        } catch (e) {
            try {
                window.sidebar.addPanel(title, url, '');
            } catch (e) {
                showDialog("请按 Ctrl+D 键添加到收藏夹", 'notice');
            }
        }
    }
    </script>
    <ul id="dropdown1" class="dropdown-content left_date">
        <li><a title="安全退出" href="<?php echo G_MODULE_PATH; ?>/user/out"><span>安全退出</span></a></li>
        <li class="divider"></li>
        <li><a title="网站首页" href="<?php echo G_WEB_PATH; ?>" target="_blank"><span>网站首页</span></a></li>
    </ul>
    <nav>
        <div class="nav-wrapper teal darken-1">
            <a href=""<?php echo G_WEB_PATH; ?>"" class="brand-logo" style="padding:0 10px;">DivTeam后台管理系统</a>
            <ul class="right hide-on-med-and-down">
            <li class="current left_date"><a href="#" src="<?php echo G_MODULE_PATH; ?>/index/Tdefault" onClick="secBoard('nav',0,'setting',);">后台首页</a></li>
                <!-- Dropdown Trigger -->
                <li class="adminid" title="<?php echo $info['username']; ?>">
                    <a class="dropdown-button" href="#!" data-activates="dropdown1">
        您好&nbsp;:&nbsp;<STRONG><?php echo $info['username']; ?></STRONG>
        <i class="material-icons right">arrow_drop_down</i></a>
                </li>
            </ul>
        </div>
    </nav>



    <div id="navbox" style="display:none;" class="navbox">
        <div class="navleft"></div>
        <div class="navright">
            <NAV id="nav" class="main-nav">
                <ul>
                    <li class="normal"><a href="#" onClick="secBoard('nav',1,'setting','系统设置');">系统设置</a></li>
                    <li class="normal"><a href="#" onClick="secBoard('nav',2,'yunying','站长运营');">站长运营</a></li>
                    <li class="normal"><a href="#" onClick="secBoard('nav',3,'admin','管理员管理');">管理员管理</a></li>
                    <li class="normal"><a href="#" onClick="secBoard('nav',4,'content','文章管理');">文章管理</a></li>
                    <li class="normal"><a href="#" onClick="secBoard('nav',5,'shop','商品管理');">商品管理</a></li>
                    <li class="normal"><a href="#" onClick="secBoard('nav',6,'user','用户管理');">用户管理</a></li>
                    <li class="normal"><a href="#" onClick="secBoard('nav',7,'template','界面管理');">界面管理</a></li>
                    <li class="normal"><a href="#" onClick="secBoard('nav',8,'yunapp','插件管理');">插件管理</a></li>
                </ul>
            </NAV>
        </div>
    </div>


    <div class="row">
        <div class="col s2">
            <!-- Grey navigation panel -->
            <!--header end-->
            <div id="left">
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">settings</i>系统管理</div>
                        <div class="collapsible-body">
                            <ul class="left_date collection" id="setting">
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/setting/webcfg">SEO设置</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/setting/config">基本设置</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/setting/upload">上传设置</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/setting/watermark">水印设置</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/setting/email">邮箱配置</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/setting/mobile">短信配置</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/template/temp">通知模板配置</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/pay/pay/pay_list">支付方式</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/setting/domain">模块域名绑定</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/qq_admin">官方QQ群</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_ADMIN_PATH; ?>/index/Tdefault">后台首页</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/cache/init">清空缓存</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">web</i>站长运营</div>
                        <div class="collapsible-body">
                            <ul class="left_date collection" id="yunying">
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_ADMIN_PATH; ?>/yunwei/websitemap">站点地图</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_ADMIN_PATH; ?>/yunwei/websubmit">网站提交</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_ADMIN_PATH; ?>/yunwei/webtongji">站长统计</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">person_pin</i>管理员管理</div>
                        <div class="collapsible-body">
                            <ul class="left_date collection" id="admin">
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/user/lists">管理员管理</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/user/reg">添加管理员</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/user/edit/<?php echo $info['uid']; ?>">修改密码</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">picture_in_picture</i>文章管理</div>
                        <div class="collapsible-body">
                            <ul class="left_date collection" id="content">

                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/content/article_add">添加文章</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/category/lists/article">文章分类</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/content/article_list">文章列表</a></li>
                               
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/category/addcate/danweb">添加单页</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/category/lists/single">单页列表</a></li>
                               
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/content/model">内容模型</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/category/lists">栏目管理</a></li>
                                
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/group/quanzi">圈子模块</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/link/lists">友情链接</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">shopping_basket</i>商品管理</div>
                        <div class="collapsible-body">
                            <ul class="left_date collection" id="shop">
                                
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/content/goods_add">添加新商品</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/content/goods_list">商品列表</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/category/lists/goods">商品分类</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/brand/lists">品牌管理</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/brand/insert">添加品牌</a></li>
                                <!--li><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/content/goods_del_list">商品回收站</a></li-->
                                
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/dingdan/lists">订单列表</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/dingdan/select">订单查询</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/dingdan/lists/zj">中奖订单</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/dingdan/lists/notsend">未发货订单</a></li>
                                
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/content/goods_list/xianshi">限时揭晓商品</a></li>
                                
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/go/shaidan_admin/init">晒单查看</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">recent_actors</i>用户管理</div>
                        <div class="collapsible-body">
                            <ul class="left_date collection" id="user">
                                
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/member/member/lists">会员列表</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/member/member/select">查找会员</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/member/member/insert">添加会员</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/member/member/config">会员配置</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/member/member/member_fufen">会员福利配置</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/member/member/recharge">充值记录</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/member/member/pay_list">消费记录</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/member/member/oplist">福分转让记录</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/member/member/member_group">会员组</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/member/member/commissions">佣金申请提现管理</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">aspect_ratio</i>界面管理</div>
                        <div class="collapsible-body">
                            <ul class="left_date collection" id="template">
                                
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/ments/navigation">导航条管理</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/slide">幻灯管理</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/mobile/wap">手机幻灯片</a></li>
                                 <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/gonggao">公告管理</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/template">模板设置</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/template/see">查看模板</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">library_add</i>插件管理</div>
                        <div class="collapsible-body">
                            <ul class="left_date collection" id="yunapp">
                                
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/api/qqlogin/qq_set_config">QQ登陆</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/api/qqlogin/wx_set_config">微信登陆</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/adminwei/fund/fundset">公益基金</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_ADMIN_PATH; ?>/shuashua_register/show">批量注册</a></li>
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/shuashua/shuashua_p/show">自动购买</a></li>
                                
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo WEB_PATH; ?>/czk/vote_admin/">卡密（优惠券）管理</a></li>
                               
                                <li class="collection-item"><a href="javascript:void(0);" src="<?php echo G_MODULE_PATH; ?>/content/prize">奖品管理</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <div style="padding:30px 10px; color:#ccc">
                    <p>
                        © 2015 DivTeam
                        <br> All Rights Reserved.
                    </p>
                </div>
                
            </div>
            <!--left end-->
        </div>
        <div class="col s10" style="margin-top:7px;">
            <!-- Teal page content  -->

  <nav>
    <div class="nav-wrapper teal lighten-5">
      <ul class="R_label left hide-on-med-and-down" id="R_label" style="padding-left:10px; color: #616161">
        当前位置: 后台首页 >
      </ul>
    </div>
  </nav>
            
                <iframe id="iframe_src" name="iframe" class="iframe z-depth-1" frameborder="no" border="1" marginwidth="0" marginheight="0" src="" scrolling="auto" allowtransparency="yes" style="width:100%; height:100%">
                </iframe>
            
        </div>
        <!--right end-->
    </div>
    </div>
    </body>

    </html>
