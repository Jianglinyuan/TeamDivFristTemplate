(function(){
	function startmarquee(lh, speed, delay, index) {
		var t;
		var p = false;
		var o = document.getElementById("marqueebox" + index);
                o.innerHTML += o.innerHTML;
                o.onmouseover = function () {
                    p = true;
                }
                o.onmouseout = function () {
                    p = false;
                }
                o.scrollTop = 0;
		function start() {
                    t = setInterval(scrolling, speed);
                    if (!p) {
                        o.scrollTop += 1;
                    }
		}

		function scrolling() {
                    if (o.scrollTop % lh != 0) {
                        o.scrollTop += 1;
                        if (o.scrollTop >= o.scrollHeight / 2) o.scrollTop = 0;
                    } else {
                        clearInterval(t);
                        setTimeout(start, delay);
                    }
		}
		setTimeout(start, delay);
	}
	startmarquee(25, 30, 0, 1);

	var isRunning = false;
	$("#lot-btn").click(function() {
		if (isRunning) {
			return;
		}
		$('#imgs').rotate(0);
		$.ajax({
			url: WEB_PATH  + "/member/lottery/submit/"+(new Date()).getTime(),
			dataType : 'json',
			beforeSend: function(){
                            isRunning = true;
                            $("#imgs").rotate({
                                animateTo: 360*10,
                                duration: 20000,
                                callback: function(){
                                    alert('哎呀，没有抽中，再接再厉！');
                                    isRunning = false;
                                }
                            });
			},
			success: function(data){
                            if ( !data.ok ) {
                                $('#imgs').stopRotate();
                                $("#imgs").rotate({
                                    animateTo: 360*6,
                                    duration: 5000,
                                    callback: function(){
                                        $('#lottery_tips').text(data.desc);
                                        alert(data.desc);
                                        isRunning = false;
                                    }
                                });
                            } else {
                                $('#imgs').stopRotate();
                                $("#imgs").rotate({
                                    animateTo: 360*6 + Number(data.round),
                                    duration: 5000,
                                    callback: function(){
                                        if ( data.left <=0 ) {
                                            $('#lottery_tips').text('抱歉，您的抽奖次数用完了。');
                                        } else {
                                            $('#lottery_tips').text('您还剩'+data.left+'次抽奖机会哦！');
                                        }
                                        alert(data.desc);
                                        isRunning = false;
                                        window.location.reload(true);
                                    }
                                });
                            }

			}

		});
	});


})();
