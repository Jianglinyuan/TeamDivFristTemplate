$.fn.StartTimeOut = function(t, h) {
    var s = $(this);
    var a = new Date();
    a.setSeconds(a.getSeconds() + h);
    var m = 0;
    var p = 0;
    var o = 0;
    var l = function() {
        var v = new Date();
        if (a > v) {
            var w = parseInt((a.getTime() - v.getTime()) / 1000);
            var u = w % 60;
            m = parseInt(w / 60);
            p = parseInt(u);
            if (u >= p) {
                o = parseInt((u - p) * 10)
            } else {
                o = 0
            }
            setTimeout(l, 3000)
        }
    };
    var g = s.find("em");
    var b = g.eq(0);
    var k = g.eq(1);
    var d = g.eq(2);
    var r = g.eq(3);
    var f = 9;
    var n = function() {
        f--;
        if (f < 0) {
            f = 9
        }
        r.html(f);
        setTimeout(n, 10)
    };
    var c = function() {
        r.html("0");
        s.find("p[name='pTime']").html("正在计算,请稍后...");

		var checker = function(){
			$.getJSON(Gobal.Webpath+"/api/getshop/lottery_shop_huode/"+new Date().getTime(),{'test':true,'gid':t},function(info){
				setTimeout(function(){
                    location.reload();
                },3000);
			});
		};
		setTimeout(checker,1000);
    };
    var j = function() {
        o--;
        if (o < 1) {
            if (p < 1) {
                if (m < 1) {
                    c();
                    return
                } else {
                    m--
                }
                p = 59
            } else {
                p--
            }
            o = 9
        }
        setTimeout(j, 100)
    };
    var e = 0,
    q = 0;
    var i = function() {
        d.html(o);
        if (e != p) {
            if (p < 10) {
                k.html("0" + p)
            } else {
                k.html(p)
            }
            e = p
        }
        if (q != m) {
            if (m < 10) {
                b.html("0" + m)
            } else {
                b.html("00")
            }
            q = m
        }
        setTimeout(i, 100)
    };
    l();
    j();
    n();
    i()
};