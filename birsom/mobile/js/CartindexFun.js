$(function() {
    var a = $("#cartBody");
    var c = $("#divNone");
    var b = function() {
        var o = "";
        var h = $("#divTopMoney");
        var g = $("#divBtmMoney");
        var gjf = $("#divBtmMoney1");
        var e = function(t, s, r, q) {
            $.PageDialog.fail(t, s, r, q)
        };
        var n = function(s, r, q) {
            $.PageDialog.confirm(s, r, q)
        };
        if (h.length > 0) {
            h.children("a").click(function() {
                location.href = Gobal.Webpath+"/mobile/cart/pay"   //付款页面
            })
        }
        g.children("a").click(function() {
            location.href = Gobal.Webpath+"/mobile/cart/pay"      //付款页面
        });
        gjf.children("a").click(function() {
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
                g.children("p").html('总共微购<span class="orange arial z-user">' + r + '</span>个商品  合计金额：<span class="orange arial">' + q + ".00</span> 元")
            } else {
                g.remove()
            }
        };
        var d = function() {
            var cartNum = $(this);
            var cartNumId = cartNum.attr("id");
            var cartNumIdUpdate = cartNumId.replace("txtNum", "");
            var cartNumIuput = cartNum.next().next();
            var leftNum = parseInt(cartNum.next().next().next().val());
            var totalNum = Math.floor(parseInt(cartNum.next().next().next().next().val()));
            var s, y, w = /^[1-9]{1}\d{0,6}$/;
            var u;
            o = cartNumId;
            var x = function() {
                if (o != cartNumId) {
                    return
                }
                s = cartNumIuput.val();
                y = cartNum.val();
                var pr = cartNum.attr("price");
                if (y != "" && s != y) {
                    var B = $(window).width();
                    var A = (B) / 2 - cartNum.offset().left - 127;
                    if (w.test(y)) {
                        u = parseInt(y);
                        // var max_num = (totalNum > u) ? u : totalNum;
                        // console.log("max_num:"+max_num);

                        if (u <= leftNum) {
                            cartNumIuput.val(y)
                        } else {
                            u = leftNum;
                            e("最多" + u + "人次", cartNum, -75, A);
                            cartNum.val(u);
                            cartNumIuput.val(u)
                        }
                        p(u, cartNum);
                        j(cartNum, cartNumIdUpdate, u,pr);
                        console.log("leftNum"+leftNum);
                        console.log("currentNum"+u);
                        i(cartNum, u, leftNum);
                        m()
                    } else {
                        e("只能输正整数哦", cartNum, -75, A);
                        cartNum.val(s)
                    }
                }
                setTimeout(x, 200);
            };
            x();
            // console.log("max_num:"+max_num);
        };
        var p = function(r, u) {
            var t = u.parent().parent().parent();
            var q = t.find("div.z-Cart-tips");
            if (r > 100) {
                if (q.length == 0) {
                    var s = $('<div class="z-Cart-tips">欢迎光临0元微购！祝您购物愉快，好运连连！</div>');
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
                    e("本期商品已微购光了", q, -75, u)
                } else {
                    if (w.code == 0) {
                        q.parent().prev().html('总共微购：<em class="arial">' + r + '</em>人次/<em class="orange arial">￥' + r*pr + ".00</em>")
                    }
                }
            };
            GetJPData(Gobal.Webpath, "ajax", "addShopCart/" + t + "/" + r+"/cart", s)
        };
        var k = function(addNum, input) {
            var u = input.attr("id");
            var s = u.replace("txtNum", "");
            var leftNum = parseInt(input.next().next().next().val());
            var totalNum = Math.floor(parseInt(input.next().next().next().next().val()));
            var q = input.next().next();
            var pr = input.attr("price");
            var nextNum = parseInt(q.val()) + addNum;
            // var max_num = (ten_per > t) ? t : ten_per;
            if (nextNum > 0 && nextNum <= leftNum) {
                i(input, nextNum, leftNum);
                q.val(nextNum);
                input.val(nextNum);
                p(nextNum, input);
                j(input, s, nextNum, pr);
                m();
            }
        };
        var i = function(r, currentNum, leftNum) {
            var jian = r.prev();
            var jia = r.next();
            console.log("currentNum in i" +currentNum);
            console.log("leftNum in i" +leftNum);
            if (leftNum == 1) {
                jian.addClass("z-jiandis");
                jia.removeClass("z-jiadis");
                console.log(1);
            } else {
                if (currentNum == 1) {
                    jian.addClass("z-jiandis");
                    jia.removeClass("z-jiadis");
                    console.log(2);
                } else {
                    if (currentNum == leftNum) {
                        jian.removeClass("z-jiandis");
                        jia.addClass("z-jiadis");
                        console.log(3);
                    } else {
                        jian.removeClass("z-jiandis");
                        jia.removeClass("z-jiadis");
                        console.log(4);
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
        Base.getScript(Gobal.Skin + "/mobile/js/pageDialog.js", b)
    } else {
        c.show()
    }
});