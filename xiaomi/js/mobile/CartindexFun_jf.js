$(function() {
    var a = $("#cartBody");
    var c = $("#divNone");
    var b = function() {
        var o = "";
        var h = $("#divTopMoney");
        var g = $("#divBtmMoney");
        var e = function(t, s, r, q) {
            $.PageDialog.fail(t, s, r, q)
        };
        var n = function(s, r, q) {
            $.PageDialog.confirm(s, r, q)
        };
        if (h.length > 0) {
            h.children("a").click(function() {
                location.href = Gobal.Webpath+"/mobile/cart/jf_pay"   //付款页面
            })
        }
        g.children("a").click(function() {
            location.href = Gobal.Webpath+"/mobile/cart/jf_pay"      //付款页面
        });
        var m = function() {
            var q = 0;
            var r = 0;
            $("input:text[name=num]", a).each(function(s) {
                var t = parseInt($(this).val());
                var p = parseInt($(this).attr("price"));
                if (!isNaN(t)) {
                    r++;
                    q += t*p;
                }
            });
            if (r > 0) {
                if (h.length > 0) {
                    h.children("span").html(q + ".00")
                }
                    console.log(r);
                g.children("p").html('总共购买<span class="orange arial z-user">' + r + '</span>个商品  合计金额：<span class="orange arial">' + q + ".00</span> 元")
            } else {
                g.remove()
            }
        };
        var d = function() {
            var z = $(this);
            var t = z.attr("id");
            var v = t.replace("txtNum", "");
            var q = z.next().next();
            var r = parseInt(z.next().next().next().val());
            var ten_per = Math.floor(parseInt(z.next().next().next().next().val()));
            var s, y, w = /^[1-9]{1}\d{0,6}$/;
            var u;
            o = t;
            var x = function() {
                if (o != t) {
                    return
                }
                s = q.val();
                y = z.val();
                var pr = z.attr("price");
                if (y != "" && s != y) {
                    var B = $(window).width();
                    var A = (B) / 2 - z.offset().left - 127;
                    if (w.test(y)) {
                        u = parseInt(y);
                        var max_num = (ten_per > u) ? u : ten_per;
                        max_num = (max_num > r) ? r : max_num;
                        if (u <= max_num) {
                            q.val(y)
                        } else {
                            u = max_num;
                            e("最多" + u + "人次", z, -75, A);
                            z.val(u);
                            q.val(u)
                        }
                        p(u, z);
                        j(z, v, u,pr);
                        i(z, u, max_num);
                        m()
                    } else {
                        e("只能输正整数哦", z, -75, A);
                        z.val(s)
                    }
                }
                setTimeout(x, 200)
            };
            x()
        };
        var p = function(r, u) {
            var t = u.parent().parent().parent();
            var q = t.find("div.z-Cart-tips");
            if (r > 100) {
                if (q.length == 0) {
                    var s = $('<div class="z-Cart-tips">欢迎光临购买！祝您购物愉快，好运连连！</div>');
                    t.prepend(s)
                }
            } else {
                q.remove()
            }
        };
        var l = function() {
            var q = $(this);
            if (o == q.attr("id")) {
                o = ""
            }
            if (q.val() == "") {
                q.val(q.next().next().val())
            }
        };
        var j = function(q, t, r, pr) {

            var s = function(w) {
                if (w.code == 1) {
                    var v = $(window).width();
                    var u = (v) / 2 - q.offset().left - 127;
                    e("本期商品已购买光了", q, -75, u)
                } else {

                    if (w.code == 0) {
                        q.parent().prev().html('总共购买：<em class="arial">' + r + '</em>人次/<em class="orange arial">￥' + r*pr + ".00</em>")
                    }
                }
            };
            GetJPData(Gobal.Webpath, "ajax", "jf_addShopCart/" + t + "/" + r+"/cart", s)
        };
        var k = function(w, v) {
            var u = v.attr("id");
            var s = u.replace("txtNum", "");
            var r = parseInt(v.next().next().next().val());
            var ten_per = Math.floor(parseInt(v.next().next().next().val()));
            var q = v.next().next();
            var pr = v.attr("price");
            var t = parseInt(q.val()) + w;
            var max_num = (ten_per > t) ? t : ten_per;
            if (t > 0 && t <= max_num) {
                i(v, t, max_num);
                q.val(t);
                v.val(t);
                p(t, v);
                j(v, s, t, pr);
                m()
            }
        };
        var i = function(r, t, s) {
            var q = r.prev();
            var u = r.next();
            if (s == 1) {
                q.addClass("z-jiandis");
                u.addClass("z-jiadis")
            } else {
                if (t == 1) {
                    q.addClass("z-jiandis");
                    u.removeClass("z-jiadis")
                } else {
                    if (t == s) {
                        q.removeClass("z-jiandis");
                        u.addClass("z-jiadis")
                    } else {
                        q.removeClass("z-jiandis");
                        u.removeClass("z-jiadis")
                    }
                }
            }
        };
        $("input:text[name=num]", a).each(function(q) {
            var r = $(this);
            r.bind("focus", d).bind("blur", l);
            r.prev().bind("click",
            function() {
                k( -1, r)
            });
            r.next().bind("click",
            function() {
                k(1, r)
            })
        });
        var f = function() {
            var q = $("li", "#cartBody");
            if (q.length < 1) {
                a.parent().remove();
                c.show()
            } else {
                if (q.length < 4) {
                    h.remove()
                }
            }
        };
        $("a[name=delLink]", a).each(function(q) {
            $(this).bind("click",
            function() {
                var r = $(this);
                var t = r.attr("cid");
                var s = function() {
                    var u = function(v) {
                        if (v.code == 0) {

                            r.parent().parent().parent().remove();
                            m();
                            f()
                        } else {
                            e("删除失败，请重试")
                        }
                    };
                    GetJPData(Gobal.Webpath, "ajax", "delCartItem/" + t, u)
                };
                n("您确定要删除吗？", s)
            })
        });
        $("a[name=delLink1]", a).each(function(q) {
            $(this).bind("click",
            function() {
                var r = $(this);
                var t = r.attr("cid");
                var s = function() {
                    var u = function(v) {
                        if (v.code == 0) {

                            r.parent().parent().parent().remove();
                            m();
                            f()
                        } else {
                            e("删除失败，请重试")
                        }
                    };
                    GetJPData(Gobal.Webpath, "ajax", "delCartItem_jf/" + t, u)
                };
                n("您确定要删除吗？", s)
            })
        })
    };

    if (a.length > 0) {
        Base.getScript(Gobal.Skin + "/js/mobile/pageDialog.js", b)
    } else {
        c.show()
    }
});