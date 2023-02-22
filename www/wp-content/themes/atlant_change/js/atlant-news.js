jQuery(document).ready(function($){

	$('body').on('click.atlant_news.change_page', '.index-news-block__pagination > button', function(e){
		let $page_button = $(this);
		if($page_button.prop('disabled') || $page_button.hasClass('disabled'))
			return;
		
		let $news_block = $page_button.parent().prev('.index-news-block__news-block');
		if(!$news_block)
			return;
		
		if($news_block.data('isExecutig'))
			return;
		
		let new_page = +$page_button.text();
		
		let paged = +$news_block.data('paged');
		let pages = $news_block.data('pagesCache');
		
		if(!pages)
			pages = {};
		
		if(new_page == paged)
			return;

		$news_block.data('isExecutig', true);

		$news_block.slideUp(300, news_block_was_hidden);
		$('html, body').animate({scrollTop: $news_block.parent().offset().top}, {duration: 200,easing: "linear"});

		let $old_page_button = $page_button.parent().children('.active');
		$old_page_button.removeClass('active');
		
		if(!pages.hasOwnProperty(paged)){
			let old_page = [];
			$news_block.children('.news-card').each(function(ind, elem){
				let $elem = $(elem);
				if($elem.data('postId')){
					old_page.push({
						id: +$elem.data('postId'),
						html: $elem.html()
					});
				}
			});
			pages[paged] = old_page;
			$news_block.data('pagesCache', pages);
		}
		
		if(!pages.hasOwnProperty(new_page)){
			$.ajax({
				type : 'POST',
				url : atlant_ajax_url,
				dataType:'json',
				data : {
					paged : new_page,
					posts_per_page : +$news_block.data('postPerPage'),
					action : 'atlant_news__get_page'
				},

				success:function(data){
					set_new_page(data);
				},
				error: function(jqXHR, exception){
					//console.log(jqXHR);
					//console.log(exception);
					news_block_stop_executing();
				}
			});
		}
		
		function news_block_was_hidden(){
			if(!pages.hasOwnProperty(new_page))
				return;
			
			//перезаписываем блоки
			$news_block.children('.news-card').each(function(ind, elem){
				let $elem = $(elem);
				if(ind < pages[new_page].length){
					$elem.data('postId', pages[new_page][ind].id);
					$elem.html(pages[new_page][ind].html);
					$elem.show();
				}else{
					$elem.data('postId', '');
					$elem.html();
					$elem.hide();
				}
			});
			
			//перезаписываем кэш и тек. страницу
			$news_block.data('paged', new_page);
			$news_block.data('pagesCache', pages);
			
			//изменяем пагинацию
			change_pagination();
			
			$news_block.slideDown(300, function(){
				$news_block.data('isExecutig', false);
			});
		}
		
		function news_block_stop_executing(){
			alert('Не удалось получить новости.\nПопробуйте позже');
			$old_page_button.addClass('active');
			
			$news_block.slideDown(300, function(){
				$news_block.data('isExecutig', false);
			});
		}
		
		function set_new_page(page_data){
			pages[new_page] = page_data;
			
			if(!$news_block.queue().length){
				news_block_was_hidden();
			}
		}
		
		function change_pagination(){
			let pages_count = +$news_block.data('pagesCount');
			if(pages_count < 6){
				$page_button.addClass('active');
				return;
			}
			
			let buttons = [1, 2];
			buttons.push(new_page < 2 ? 1 : new_page-1, new_page, new_page >= pages_count ? new_page : new_page+1);
			buttons.push(pages_count-1, pages_count);
			
			buttons = [...new Set(buttons)];
			for(let i = 0; i<buttons.length-1; i++){
				if(buttons[i] + 1 != buttons[i+1]){
					buttons.splice(i+1, 0, '...');
					i++;
				}
			}
			
			let html = '';
			for(let i=0; i<buttons.length; i++){
				html += '<button class="btn-empty'+(buttons[i] == new_page ? ' active' : '')+(buttons[i] == '...' ? ' disabled' : '')+'" '+(buttons[i] == '...' ? ' disabled="disabled"' : '')+'>'+buttons[i]+'</button>';
			}

			$page_button.parent().html(html);
		}
		
	});
	
	
});
