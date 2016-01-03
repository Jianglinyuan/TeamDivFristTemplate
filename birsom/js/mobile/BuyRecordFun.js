$(function() {
    var l = $("#hidCodeID").val();
    var e = $("#hidIsEnd").val() == "1";
    var f = $("#divBuyLoading");
    var d = $("#divRecordList");
    var j = $("#btnLoadMore");
    var c = null;
    var h = 10;
    var a = 0;
    var b = e ? "GetUserBuyListByCodeEnd": "GetUserBuyListByCode";
    var i = {
        codeID: l,
        FIdx: 1,
        EIdx: h,
        isCount: 1,
        sort: 0
    };
    var g = function() {
        var m = function() {
            return "codeID=" + i.codeID + "&FIdx=" + i.FIdx + "&EIdx=" + i.EIdx + "&isCount=" + i.isCount + "&sort=" + i.sort
        };
        var n = function() {
            f.show();
            var itemid = $("#itemid").val();
            GetJPData("/?/mobile", 'buyrecordsAjax/'+itemid,i.sort,
            function(r) {
                if (r.Code == 0) {
                    if (i.isCount == 1) {
                        a = r.Count;
                        d.show()
                    }
                    var s = "";
                    var q = null;
                    q = r.Rows;
                    var p = q.length;
                    for (var o = 0; o < p; o++) {
                        s += '<ul><li class="rBg"><a href="/?/mobile/mobile/userindex/' + q[o].uid + '"><img src="/statics/uploads/' + q[o].uphoto + '"><s></s></a></li><li class="rInfo"><a href="http://m.1yyg.com/userpage/' + q[o].uid + '">' + q[o].username + "</a><strong>(" + q[o].ip+ ')</strong><br><span>购买了<b class="orange">' + q[o].gonumber + '</b>人次</span><em class="arial">' + q[o].buyTime + "</em></li><i></i></ul>"
                    }
                    d.append(s);
                    if (i.EIdx < a) {
                        j.show()
                    } else {
                        e = true
                    }
                } else {
                    if (i.FIdx == 1) {
                        e = true;
                        d.before(Gobal.NoneHtml).remove()
                    }
                }
                k = false;
                f.hide()
            })
        };
        this.initData = function() {
            i.FIdx = 1;
            i.EIdx = h;
            i.isCount = 1;
            n()
        };
        this.getNextPage = function() {
            i.FIdx = i.FIdx + h;
            i.EIdx = i.EIdx + h;
            n()
        }
    };
    c = new g();
    c.initData();
    var e = false;
    var k = false;
    j.click(function() {
        if (!k) {
            k = true;
            j.hide();
            c.getNextPage()
        }
    });
    $("#btnSort").click(function() {
        if (!k) {
            e = false;
            if (i.sort == 0) {
                $(this).html('<i></i>排序<s class="z-Sswt"></s><s class="z-Sswd"></s>');
                i.sort = 1
            } else {
                $(this).html('<i></i>排序<s class="z-SswOn"></s><s class="z-SswNt"></s>');
                i.sort = 0
            }
            d.empty();
            c.initData()
        }
    })
});