$(function() {
    var a = function() {
        var c = $("#divTimerItems");
        var f = c.find("div[name=timerItem]");
        if (f.length > 0) {		 
            var b = function() {
                f.each(function() {
                    var m = $(this);
                    var n = parseInt(m.attr("time"));
                    if (n > 0) {
                        var l = function() {
                            window.location.reload()
                        };
                        m.countdowntime(n, l)
                    }
                })
            };			 
            Base.getScript(Gobal.Skin + "/mobile/js/CountdownFun.js", b)
        }
        var i = c.find("div[name=waiterItem]");
        if (i.length > 0) {
            i.each(function() {
                var m = $(this);
                var n = parseInt(m.attr("time"));
                if (n > 0) {
                    var l = function() {
                        window.location.reload()
                    };
                    setTimeout(l, n * 1000)
                }
            })
        }
        var g = ",";
        var k = false;
        var h = 0;
        var j = function() {
            GetJPData(Gobal.Webpath, "ajax", "show_msjxshop/" + h,
            function(m) {
			   
                if (m.errorCode == 0) {
                    l(m)
                }
                setTimeout(j, 5000)
            });
            var l = function(n) {			 
                h = n.maxSeconds;
                var m = function(r) {				 
                    var q = $("#divLottery");
                    for (var o = r.length - 1; o > -1; o--) {
                        var p = r[o];
						//alert(g.indexOf(",14,"))
                        if (g.indexOf("," + p.codeID + ",") < 0) {
                            g += p.codeID + ",";
                            var s = $('<div class="m-lott-conduct" id="' + p.codeID + '"><p class="z-lott-tt">(第' + p.period + "期)" + p.goodsSName + '<b class="z-arrow"></b><span class="z-lott-time">揭晓倒计时<span class="minute">00</span>:<span class="second">00</span>:<span class="millisecond">0</span><span class="last">0</span></span></p></div>');
                            s.click(function() {                                
                                location.href = Gobal.Webpath+"/mobile/mobile/item/"+ $(this).attr("id")
                            });
                            q.prepend(s);
                            s.StartTimeOut(p.codeID, parseInt(p.seconds))
                        }
                    }
                };
                if (k) {
                    m(n.listItems)
                } else {
                    Base.getScript(Gobal.Skin + "/mobile/js/indexLotteryFun.js",
                    function() {
                        k = true;
                        m(n.listItems)
                    })
                }
            }
        };
        j();
        var e = function() {
            GetJPData(Gobal.Webpath, "ajax", "slides",
            function(s) {
                if (s.state == 0) {
                    var r = s.listItems;
                    var n = $("<ul/>");
                    n.addClass("slides");
                    var p = "";
                    for (var o = 0; o < r.length; o++) {
                        var m = '<li style="background-color:' + r[o].alt + ';"><a href="' + r[o].url + '"><img src="' + r[o].src + '" alt="" width="' + r[o].width + '" height="' + r[o].height + '" /></a></li>';
                        n.append(m)
                    }
                    var q = $("#sliderBox");
                    q.append(n).flexslider()
                }
            });
            var l = parseInt($("#hidStartAt").val());
            $("#autoLotteryBox").flexslider({
                slideshow: false,
                animationLoop: false,
                controlType: 1,
                controlPos: 1,
                startAt: l
            })
        };
        Base.getScript(Gobal.Skin + "/mobile/js/Flexslider.js", e);
        var d = function(l) {
            if (l && l.stopPropagation) {
                l.stopPropagation()
            } else {
                window.event.cancelBubble = true
            }
        };
        $("li", c).each(function() {
            var m = $(this);
            var l = m.attr("codeid");
            m.click(function() {
                location.href = Gobal.Webpath+"/mobile/mobile/item/" + l 
            });
            var n = m.attr("uweb");
            if (n != undefined) {
                m.find("uImg").click(function(o) {
                    d(o);
                    location.href = Gobal.Webpath+"/mobile/home/" + n
                });
                m.find("uName").click(function(o) {
                    d(o);
                    location.href = Gobal.Webpath+"/mobile/home/" + n
                })
            }
        });
        $("#ulRecommend > li").each(function() {
            var l = $(this);
            l.click(function() {
                location.href = Gobal.Webpath+"/mobile/mobile/item/" + l.attr("id") 
            })
        })
    };
    a();
	(function(){

		var div = $('#divLottery');

		var update = function(info){
			var html = '';
			html += '<div class="m-lott-conduct" id="lott-'+info.id+'">';
			html += '	<p class="z-lott-tt">';
			html += '		<a href="'+Gobal.Webpath+'/mobile/mobile/item/'+info.id+'">';
			html += '		(第'+info.qishu+'期)'+info.title+'<b class="z-arrow"></b>';
			html += '		<span class="z-lott-time">揭晓倒计时';
			html += '			<span class="minute">99</span>:<span class="second">99</span>:<span class="millisecond">99</span>';
			html += '		</span>';
			html += '		</a>';
			html += '	</p>';
			html += '</div>';

			div.prepend(html);

			var mydiv = div.find('div#lott-'+info.id);
			var minute = mydiv.find('span.minute');
			var second = mydiv.find('span.second');
			var millisecond = mydiv.find('span.millisecond');
			var times = (new Date().getTime()) + info.times * 1000;
			var timer = setInterval(function(){
				var time = times - (new Date().getTime());
				if ( !info.times || time < 1 ) {
					clearInterval(timer);
					minute.parent().html('正在计算……');
					var checker = function(){
						$.getJSON(Gobal.Webpath+"/api/getshop/lottery_shop_huode/"+new Date().getTime(),{'test':true,'gid':info.id},function(info){
							// if ( info.error ) {
							// 	setTimeout(checker,1000);
							// } else {
							// 	var a = mydiv.find('.z-lott-tt a');
							// 	a.html('恭喜 <span class="blue">'+info.q_user+'</span> 获得 (第'+info.qishu+'期)'+info.title+'<b class="z-arrow"></b>');
							// 	a.css('overflow','hidden').css('width','99%');
							// 	a.parent().css('white-space','nowrap').css('padding','0 13px 0 5px');
							// }
                            setTimeout(function(){
                                location.reload();
                            },3000);
						});
					};

					setTimeout(checker,1000);
					return;
				}

				i =  parseInt((time/1000)/60);
				s =  parseInt((time/1000)%60);
				ms =  String(Math.floor(time%1000));
				ms = parseInt(ms.substr(0,2));
				if(i<10)i='0'+i;
				if(s<10)s='0'+s;
				if(ms<10)ms='0'+ms;
				minute.html(i);
				second.html(s);
				millisecond.html(ms);
			}, 41);
		};

		var gid = '';
		var thread = function(){
			$.getJSON(Gobal.Webpath+"/api/getshop/lottery_shop_json/"+new Date().getTime(),{'test':true,'gid':gid},function(info){
				if(info.error == '0' && info.id != 'null'){
					if ( ('_'+gid+'_').indexOf('_'+info.id+'_') === -1 ) {
						gid =  gid + '_' + info.id;
						update(info);
					}
				}
			});
		};

		setInterval(thread, 4000);
		thread();
	})();
});