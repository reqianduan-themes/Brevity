(function($){
	$.fn.topbar = function(){
		var pre = 0, 
			cur = 0, 
			$topbar = this;
		$(window).scroll(function(){
			cur = $(this).scrollTop();
			if (cur >= pre) {
				//向下滚动
				$topbar.slideUp('fast');
			} else if (cur < pre) {
				//向上滚动
				$topbar.slideDown('fast');
			} else {
				//未能捕获的情况
				console.log('topbar: 滚动异常');
			}
			pre = cur;
		});
		return this;
	};
})(jQuery);