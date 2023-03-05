<?php

if(!defined('ABSPATH')) die();

class atlant_currency_calculator{
	
	const CURRENCY_PAGE_NAME = 'atlant_currency_menu';
	const BINANCE_API_URL = 'https://api.binance.com/api/v3/ticker/price';
	
	public static function update_crypto_currency(){
		self::update_currencies(get_option('atlant_calculator_data', [])); 
	}

	public static function add_calculator_page(){
		$hook = add_submenu_page(
			'index.php',
			'Атлант настройка курсов',
			'Атлант настройка курсов',
			'manage_options',
			self::CURRENCY_PAGE_NAME,
			[__CLASS__, 'view_currency_page']
		);

		if($hook !== false){
			/*wp_enqueue_script(
				'atlant-admin-currency',
				get_template_directory_uri().'/js/admin-currency.js',
				['jquery'],
				filemtime(get_template_directory().'/js/admin-currency.js'),
				1
			);*/
			//add_action('load-'.$hook, [__CLASS__, 'load_currency_page']);
		}
	}

	public static function view_currency_page(){
		if(!current_user_can('manage_options')){
			wp_nonce_ays('');
			return;
		}


		echo '<div class="wrap">
			<h2>'.get_admin_page_title().'</h2>';
		
		settings_errors();
		
		echo 'Доступные переменные -
			<ul>
				<li><code>float currency</code> - текущая стоимость 1 валюты в рублях (валюта -> USDT -> руб) (www.binance.com)</li>
			</ul>
			Доступные функции -
			<ul>
				<li><code>sin(радианы)</code> - синус</li>
				<li><code>cos(радианы)</code> - косинус</li>
				<li><code>tan(радианы)</code> - тангенс</li>
				<li><code>sqrt(число)</code> - квадратный корень</li>
				<li><code>abs(число)</code> - модуль</li>
				<li><code>exp(степень)</code> - возведение <i>e</i> в степень</li>
				<li><code>log(число, основание)</code> - логорифм</li>
				<li><code>pow(число, степень)</code> - возведение в степень</li>
				<li><code>ceil(число)</code> - округление в большую сторону</li>
				<li><code>floor(число)</code> - округление в меньшую сторону</li>
				<li><code>round(число, кол-во знаков после запятой)</code> - математическое округление</li>
			</ul>';

		echo '<form method="POST" action="options.php">';
		settings_fields('atlant_currency_data_fields');
		do_settings_sections(self::CURRENCY_PAGE_NAME);
		submit_button();
		echo '</form>
		</div>';
		
	}

	public static function init_currency_settings(){
		register_setting(
			'atlant_currency_data_fields',
			'atlant_calculator_data',
			[
				'sanitize_callback' => [__CLASS__, 'calculator_data_validate'],
				'default' => [],
				'type' => 'array',
			]
		);
		
		$fields = ['code' => 'Код валюты', 'text' => 'Название валюты', 'buy_formula' => 'Формула расчета цены покупки', 'sale_formula' => 'Формула расчета цены продажи'];

		$currencies = get_option('atlant_calculator_data', []);
		$len = sizeof($currencies);
		for($i=0; $i<$len; $i++){
			$section_id = 'atlant_currency_section_'.$i;
			add_settings_section(
				$section_id,
				'Настройки для "'.$currencies[$i]['text'].'"',
				[__CLASS__, 'view_section_description'],
				self::CURRENCY_PAGE_NAME,
				['currency_ind' => $i, 'code' => $currencies[$i]['code'], 'after_section' => '<hr>']
			);
			
			foreach($fields as $f_code => $f_text){
				add_settings_field(
					'currency_'.$f_code,
					$f_text,
					[__CLASS__, 'view_currency_'.$f_code],
					self::CURRENCY_PAGE_NAME,
					$section_id,
					['currency_ind' => $i, 'val' => $currencies[$i][$f_code]]
				);
			}

		}
		
		
		$section_id = 'atlant_currency_section_'.$len;
		add_settings_section(
			$section_id,
			'Создать новую валюту',
			'',
			self::CURRENCY_PAGE_NAME
		);

		foreach($fields as $f_code => $f_text){
			add_settings_field(
				'currency_'.$f_code,
				$f_text,
				[__CLASS__, 'view_currency_'.$f_code],
				self::CURRENCY_PAGE_NAME,
				$section_id,
				['currency_ind' => $len, 'val' => '']
			);
		}

	}

	public static function calculator_data_validate($new_data){
		$setting_name = 'atlant_calculator_data';
		
		$old_data = get_option($setting_name, []);
		if(!is_array($new_data)){
			add_settings_error($setting_name, $setting_name, 'Неверная структура данных');
			return $old_data;
		}
		
		$old_codes = [];
		$len = sizeof($old_data);
		for($i=0; $i<$len; $i++){
			$old_codes[$old_data[$i]['code']] = true;
		}


		$matex = new \Matex\Evaluator();
		$matex->variables['currency'] = 1.0;
		
		$data = [];

		$new_data = array_values($new_data);
		$len = sizeof($new_data);
		for($i=0; $i<$len; $i++){
			if(!is_array($new_data[$i])){
				add_settings_error($setting_name, $setting_name, 'Отсутвуют данные о #'.$i.' валюте');
				continue;
			}
			
			$add_data = ['code' => '', 'text' => '', 'buy_formula' => '', 'sale_formula' => ''];
			foreach($add_data as $key => $val){
				$add_data[$key] = isset($new_data[$i][$key]) ? (string) $new_data[$i][$key] : '';
			}
			
			if($len - 1 == $i){
				if(	$add_data['code'] === '' &&
					$add_data['text'] === '' &&
					$add_data['buy_formula'] === '' &&
					$add_data['sale_formula'] === ''){
					continue;
				}
			}
			
			if($add_data['code'] === ''){
				add_settings_error($setting_name, $setting_name, 'Код валюты #'.$i.' отсутствует');
				continue;
			}
			//если код отсутсвует в памяти, проверим его
			if(!isset($old_codes[$add_data['code']]) && $add_data['code'] !== 'USDT'){
				$code_usdt = $add_data['code'].'USDT';
				if(!preg_match('/^[A-Z0-9-_.]{1,20}$/', $code_usdt)){
					add_settings_error($setting_name, $setting_name, 'Код валюты #'.$i.' ('.$add_data['code'].') не удовлетворяет правило ^[A-Z0-9-_.]{1,20}$');
					continue;
				}
				
				$result = wp_remote_get(self::BINANCE_API_URL.'?symbol='.$code_usdt, [
					'redirection' => 0,
					'user-agent' => 'Atlant Change php parser',
					'sslverify' => 0,
					'timeout' => 300
				]);
				
				if($result['response']['code'] != 200){
					add_settings_error($setting_name, $setting_name, 'Код валюты #'.$i.' ('.$add_data['code'].') не удалось проверить, ответ сервера: '.esc_html($result['body']));
					continue;
				}
			}

			$add_data['text'] = esc_html(trim($add_data['text']));
			
			if($add_data['buy_formula'] === ''){
				add_settings_error($setting_name, $setting_name, 'Формула покупки валюты #'.$i.' отсутствует');
				continue;
			}
			try{
				$matex->execute($add_data['buy_formula']);
			}catch(Exception $ex){
				add_settings_error($setting_name, $setting_name, 'Формула покупки валюты #'.$i.' не верна: '.$ex->getMessage());
				continue;
			}

			if($add_data['sale_formula'] === ''){
				add_settings_error($setting_name, $setting_name, 'Формула продажи валюты #'.$i.' отсутствует');
				continue;
			}
			try{
				$matex->execute($add_data['sale_formula']);
			}catch(Exception $ex){
				add_settings_error($setting_name, $setting_name, 'Формула продажи валюты #'.$i.' не верна: '.$ex->getMessage());
				continue;
			}
			
			$data[] = $add_data;
		}


		self::update_currencies($data);
		return $data;
	}

	public static function view_section_description($args){
		$atlant_currencies_data = get_option('atlant_currencies_data', []);
		if(!isset($atlant_currencies_data['currencies'])){
			return;
		}

		$currencies = $atlant_currencies_data['currencies'];
		if(isset($currencies[$args['code']])){
			echo 'Текущий курс '.$args['code'].' '.$currencies[$args['code']]['price'].' руб. (валюта -> USDT -> руб) ('.$atlant_currencies_data['updated_time']->format('Y.m.d H:i:s').')';
		}
	}

	public static function view_currency_code($args){
		echo '<input type="text" name="atlant_calculator_data['.$args['currency_ind'].'][code]" value="'.esc_attr($args['val']).'">';
	}
	public static function view_currency_text($args){
		echo '<input type="text" name="atlant_calculator_data['.$args['currency_ind'].'][text]" value="'.esc_attr($args['val']).'">';
	}
	public static function view_currency_buy_formula($args){
		echo '<textarea type="text" name="atlant_calculator_data['.$args['currency_ind'].'][buy_formula]" cols="100" rows="10" style="font-family:\'courier new\', monospace;">'
			.esc_html($args['val']).'</textarea>';
	}
	public static function view_currency_sale_formula($args){
		echo '<textarea type="text" name="atlant_calculator_data['.$args['currency_ind'].'][sale_formula]" cols="100" rows="10" style="font-family:\'courier new\', monospace;">'
			.esc_html($args['val']).'</textarea>';
	}

	/**
	 * @param $atlant_calculator_data
	 * @return bool - удалось ли обновить
	 */
	protected static function update_currencies($atlant_calculator_data){
		$usdt_arr = [];
		$usdt_ind = -1;
		$len = sizeof($atlant_calculator_data);
		for($i=0; $i<$len; $i++){
			$currency = $atlant_calculator_data[$i];
			if($currency['code'] === 'USDT'){
				$usdt_ind = $i;
				continue;
			}
			$usdt_arr[$currency['code'].'USDT'] = $i;
		}

		$usdt_arr['USDTRUB'] = -1;
		
		$query = json_encode(array_keys($usdt_arr));
		$result = wp_remote_get(self::BINANCE_API_URL.'?symbols='.$query, [
			'redirection' => 0,
			'user-agent' => 'Atlant Change php parser',
			'sslverify' => 0,
			'timeout' => 300
		]);

		if($result['response']['code'] != 200){
			return false;
		}
		
		$time_updated = current_datetime();
		
		$new_currencies = json_decode($result['body'], true);

		$usdt_cost = 1;
		$len = sizeof($new_currencies);
		for($i=0; $i<$len; $i++){
			if($new_currencies[$i]['symbol'] == 'USDTRUB'){
				$usdt_cost = (float)$new_currencies[$i]['price'];
				unset($new_currencies[$i]);
				break;
			}
		}
		$new_currencies = array_values($new_currencies);
		unset($usdt_arr['USDTRUB']);
		
		
		$currencies = [];
		$matex = new \Matex\Evaluator();
		
		$len = sizeof($new_currencies);
		for($i=0; $i<$len; $i++){
			$ind = $usdt_arr[$new_currencies[$i]['symbol']];
			$code = $atlant_calculator_data[$ind]['code'];
			$matex->variables['currency'] = ((float)$new_currencies[$i]['price']) * $usdt_cost;
			$currency_data = [
				'code' => $code,
				'price' => ((float)$new_currencies[$i]['price']) * $usdt_cost,
				'buy_price' => $matex->execute($atlant_calculator_data[$ind]['buy_formula']),
				'sale_price' => $matex->execute($atlant_calculator_data[$ind]['sale_formula']),
			];

			$currencies[$code] = $currency_data;
		}
		
		if($usdt_ind != -1){
			$matex->variables['currency'] = $usdt_cost;
			$currency_data = [
				'code' => 'USDT',
				'price' => $usdt_cost,
				'buy_price' => $matex->execute($atlant_calculator_data[$usdt_ind]['buy_formula']),
				'sale_price' => $matex->execute($atlant_calculator_data[$usdt_ind]['sale_formula']),
			];

			$currencies['USDT'] = $currency_data;
		}
		
		update_option('atlant_currencies_data', [
			'updated_time' => $time_updated,
			'currencies' => $currencies,
		], false);
		
		return true;
	}
}


//создаем cron событие для обновления курсов
if(!wp_get_scheduled_event('atlant_cron_update_crypto_currency')){
	$time = current_datetime();
	$time = $time->setTime(0, 0);
	$time = $time->add(new \DateInterval('P1D'));
	wp_schedule_event($time->getTimestamp(), 'twicedaily', 'atlant_cron_update_crypto_currency');
}
add_action('atlant_cron_update_crypto_currency', ['atlant_currency_calculator', 'update_crypto_currency']);


// удаляем настройки темы при деактивации
add_action('switch_theme', 'atlant_deactivate_theme');
function atlant_deactivate_theme($old_name){
	wp_unschedule_hook('atlant_cron_update_crypto_currency');
	delete_option('atlant_calculator_data');
	delete_option('atlant_currencies_data');
}

//создаем страницу с настройками калькулятора
add_action('admin_init', ['atlant_currency_calculator', 'init_currency_settings']);
add_action('admin_menu', ['atlant_currency_calculator', 'add_calculator_page']);

add_shortcode('atlant-change-currency', 'atlant__change_currency__block_render');
function atlant__change_currency__block_render($args, $content){
	$calculator_data = get_option('atlant_calculator_data', []);
	$currencies_data = get_option('atlant_currencies_data', []);
	
	$html = '
	<div class="index-calculator-block__table-block">
		<table>
			<thead>
				<tr>
					<th>Валюта</th>
					<th>Покупка</th>
					<th>Продажа</th>
				</tr>
			</thead>
			<tbody>';
	
	$len = sizeof($calculator_data);
	for($i=0; $i<$len; $i++){
		$code = $calculator_data[$i]['code'];
		$html .= '
				<tr>
					<td>'.esc_html($calculator_data[$i]['text']).'</td>
					<td>'.$currencies_data['currencies'][$code]['buy_price'].'&nbsp;₽</td>
					<td>'.$currencies_data['currencies'][$code]['sale_price'].'&nbsp;₽</td>
				</tr>';
	}

	$html .= '
			</tbody>
		</table>';
	if(isset($currencies_data['updated_time'])){
		$html .= '<div class="index-calculator-block__table-addition">Обновлено '.$currencies_data['updated_time']->format('d.m.y').'</div>';
	}

	$html .= '
	</div>';
	
	return $html;
}


add_shortcode('atlant-change-calculator', 'atlant__change_calculator__block_render');
function atlant__change_calculator__block_render($args, $content){
	$calculator_data = get_option('atlant_calculator_data', []);
	$currencies_data = get_option('atlant_currencies_data', []);
	
	wp_enqueue_script('atlant-calculator');
	
	$html = '
	<form class="calculator-form">
		<div class="select">
			<select name="type" class="calculator-form__type-select">
				<option value="buy" selected="selected">Купить</option>
				<option value="sale">Продать</option>
			</select>
		</div>
		<div class="select">
			<select name="currency" class="calculator-form__currency-select">';
	
	$len = sizeof($calculator_data);
	for($i=0; $i<$len; $i++){
		$code = $calculator_data[$i]['code'];
		$html .= '<option value="'.$code.'" data-buy-price="'.$currencies_data['currencies'][$code]['buy_price'].'" data-sale-price="'.$currencies_data['currencies'][$code]['sale_price'].'">'.esc_html($calculator_data[$i]['text']).'</option>';
	}

	$html .= '
			</select>
		</div>
		<input type="text" name="value" class="calculator-form__value-input" value="0">
		<div class="calculator-form__submit-section h5">
			<div class="calculator-form__result">Вы заплатите: <span class="color--yellow">0&nbsp;₽</span></div>
			<a href="#modal__to-bot" rel="modal:open" class="btn btn-submit">Обменять</a>
			<!--<input type="submit" name="currency-exchange" value="Обменять" class="btn btn-submit">-->
		</div>
	</form>';
	
	return $html;
}