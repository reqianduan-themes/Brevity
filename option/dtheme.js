jQuery(document).ready(function($) {
	//tab tit
	$('.d_mainbox:eq(0)').show();
	$('.d_tab ul li').each(function(i) {
		$(this).click(function(){
			$(this).addClass('d_tab_on').siblings().removeClass('d_tab_on');
			$($('.d_mainbox')[i]).show().siblings('.d_mainbox').hide();
		})
	});

	var avatar_txt = '<div style="padding-top:10px;color:#390;">请确保网站根目录有“avatar”文件夹，并设置权限为777，地址：http://你的网站/avatar</div>';
	if( $('#d_avatar_b')[0].checked == true ){
		$('#d_avatar_b').parent().parent().append(avatar_txt);
	}
	$('#d_avatar_b').parent().click(function(){
		if( $('#d_avatar_b')[0].checked == true ){
			
			$('#d_avatar_b').parent().parent().append(avatar_txt);
			
		}else{
			$('#d_avatar_b').parent().parent().find('div').remove();
		}
	})

	//quicker
	$('#d_quicker').before('<ul class="d_quicker_menu"><li class="d_quicker_add_tit">添加标题</li><li class="d_quicker_add_list">添加列表</li><li class="d_quicker_add_li">添加列表条目</li><li class="d_quicker_add_img">插图</li></ul>');

	$('.d_quicker_add_tit').click(function(){
		$('#d_quicker').insertAtCaret('<h3 class="base-tit">标题</h3>\n');
	})
	$('.d_quicker_add_list').click(function(){
		$('#d_quicker').insertAtCaret('<ul class="base-list">\n    <li><a href="http://www.daqianduan.com/">大前端</a></li>\n</ul>\n');
	})
	$('.d_quicker_add_li').click(function(){
		$('#d_quicker').insertAtCaret('\n    <li><a href="http://www.daqianduan.com/">大前端</a></li>');
	})
	$('.d_quicker_add_img').click(function(){
		$('#d_quicker').insertAtCaret('<img src="http://" alt="" width="" />');
	})

	
	
	//ad preview
	$('.d_mainbox:last .d_tarea').each(function(i) {
		$(this).bind('keyup',function(){
			$(this).next().html( $(this).val() );
		}).bind('change',function(){
			$(this).next().html( $(this).val() );
		}).bind('click',function(){
			$(this).next().html( $(this).val() );
			if( $(this).next().attr('class') != 'd_adviewcon' ){
				$(this).after('<div class="d_adviewcon">' + $(this).val() + '</div>');
			}else{
				$(this).next().slideDown();
			}
		})
		
	});


	$.fn.extend({
		insertAtCaret: function(myValue){
			var $t=$(this)[0];
			if (document.selection) {
				this.focus();
				sel = document.selection.createRange();
				sel.text = myValue;
				this.focus();
			}
			else 
			if ($t.selectionStart || $t.selectionStart == '0') {
				var startPos = $t.selectionStart;
				var endPos = $t.selectionEnd;
				var scrollTop = $t.scrollTop;
				$t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
				this.focus();
				$t.selectionStart = startPos + myValue.length;
				$t.selectionEnd = startPos + myValue.length;
				$t.scrollTop = scrollTop;
			}
			else {
				this.value += myValue;
				this.focus();
			}
		}
	}) 

	
	
})