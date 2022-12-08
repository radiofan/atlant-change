<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-how-work', 'atlant__how_work__block_render');
function atlant__how_work__block_render($args, $content){
	$steps = [];
	if(!empty($args['first'])){
		$steps[] = [
			'data' => esc_html($args['first']),
			'svg' => '#server',
		];
	}
	if(!empty($args['second'])){
		$steps[] = [
			'data' => esc_html($args['second']),
			'svg' => '#headphones',
		];
	}
	if(!empty($args['third'])){
		$steps[] = [
			'data' => esc_html($args['third']),
			'svg' => '#repeat',
		];
	}
	
	$svg_numbers = array_slice(['#one', '#two', '#three'], 0, sizeof($steps));
	
	$ret = '
<section class="index-how-work-block container">
	'.(!empty($args['header']) ? '
	<h2>'.esc_html($args['header']).'</h2>
	' : '');
	
	if($steps){
		$ret .= '
	<div class="index-how-work-block__steps-block">';
		
		for($i=0; $i<sizeof($steps); $i++){
			if($i){
				$ret .= '
		<div class="index-how-work-block__step__arrow"></div>';
			}
			$ret .= '
		<div class="index-how-work-block__step__number">
			<svg class="index-how-work-block__step__digit">
				<use xlink:href="'.$svg_numbers[$i].'"></use>
			</svg>
			<svg class="index-how-work-block__step__icon">
				<use xlink:href="'.$steps[$i]['svg'].'"></use>
			</svg>
		</div>
		<div class="index-how-work-block__step__text h5">'.esc_html($steps[$i]['data']).'</div>';
		}
		
		
		$ret .= '
	</div>';
	}
	
	$ret .= '
</section>';
	
	
	return $ret;
}
