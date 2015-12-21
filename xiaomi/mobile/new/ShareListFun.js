$(function() {
	var b = function(e) {
		$.PageDialog.fail(e)
	};
	var c = function(e) {
		$.PageDialog.ok("<s></s>" + e)
	};
	var d = function() {
		var f = $("#m_popUp");
		var e = function() {
			f.fadeToggle(1000, function() {
				f.hide()
			})
		};
		f.bind("click", e);
		$("#btnShare").bind("click", function(g) {
			f.fadeToggle(1000, function() {
				f.show()
			})
		});
		
	};
	
});