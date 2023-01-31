<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-for-partners-gain', 'atlant__for_partners_gain__block_render');
function atlant__for_partners_gain__block_render($args, $content){
	$steps = ['label' => false, 'database' => false, 'heart' => false];
	foreach($steps as $key => $val){
		if(!empty($args[$key])){
			$steps[$key] = esc_html($args[$key]);
		}else{
			unset($steps[$key]);
		}
	}
	
	
	$ret = '
<section class="for-partners-gain-block container">
	'.(!empty($args['header']) ? '
	<h2 class="for-partners-gain-block__header">'.esc_html($args['header']).'</h2>
	' : '');

	if($steps){
		$ret .= '
	<div class="for-partners-gain-block__container">';
		foreach($steps as $key => $val){
			$ret .= '
		<div class="for-partners-gain-block__gain-block">
			<svg class="for-partners-gain-block__gain-block__icon">
				<use xlink:href="#'.$key.'"></use>
			</svg>
			<span class="for-partners-gain-block__gain-block__description">'.$val.'</span>
		</div>
			';
		}
		$ret .= '
	</div>';
	}

	$ret .= '
</section>';
	
	return $ret;
}
