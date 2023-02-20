<?php
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		get_template_part('news-template', null, ['need_link' => true]);
	}
}else{
	?>
	<p>Новостей нет</p>
	<?php
}

global $wp_query;
$script_data = [
	'ajax_url' => admin_url('admin-ajax.php'),
	'paged' => absint(get_query_var('paged', 1)),
	'max_pages' => $wp_query->max_num_pages,
];
if($script_data['paged'] < 1){
	$script_data['paged'] = 1;
}
wp_add_inline_script('atlant-loadmore', 'const atlant_loadmore = '.wp_json_encode($script_data), 'before');

?>
<section class="container" id="news-loadmore-info">
</section>
<?php

get_footer();
?>