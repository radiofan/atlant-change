jQuery(function($){
	
	let current_page = atlant_loadmore.paged;
	const bottom_offset = 2000;
	let loader_active = false;

	let $loadmore = $('#news-loadmore-info');
	
	$(window).scroll(function(){
		
		if(loader_active)
			return;
		
		if(current_page == atlant_loadmore.max_pages){
			all_readed();
			return;
		}

		if($(document).scrollTop() > ($(document).height() - bottom_offset)){
			loader_active = true;
			$loadmore.html('<p>Загрузка...</p>');
			
			$.ajax({
				type : 'POST',
				url : atlant_loadmore.ajax_url,
				dataType:'json',
				data : {
					paged : current_page,
					action : 'atlant_loadmore'
				},
				
				success:function(data){
					current_page++;
					for(let i in data){
						$loadmore.before(data[i].html);
						Ya.share2('post-'+data[i].id+' .ya-share2');
					}
					$loadmore.html('');
				},
				error: function(jqXHR, exception){
					$loadmore.html('<p>Не удалось получить новости.</p><p>Попробуйте позже</p>');
					//console.log(jqXHR);
					//console.log(exception);
				},
				complete:function(){
					loader_active = false;
				}
			});
		}
	});
	
	function all_readed(){
		$('#news-loadmore-info').html('<p>Все прочитано</p>');
		loader_active = true;
	}
});