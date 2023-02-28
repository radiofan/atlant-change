<?php

class atlant_currency_calculator{
	
	const CURRENCY_PAGE_NAME = 'atlant_currency_menu';
	const BINANCE_API_URL = 'https://api.binance.com/api/v3/ticker/price';
	
	public static function update_crypto_currency(){


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
				<li><code>float currency</code> - текущая стоимость 1 валюты в долларах США (www.binance.com)</li>
				<li><code>float rub</code> - текущая стоимость доллара США в рублях (www.cbr.ru)</li>
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
		
		$fields = ['code' => 'Код валюты', 'text' => 'Название валюты', 'buy_formula' => 'Формула расчета цены покупки', 'send_formula' => 'Формула расчета цены продажи'];

		$currencies = get_option('atlant_calculator_data', []);
		$len = sizeof($currencies);
		for($i=0; $i<$len; $i++){
			$section_id = 'atlant_currency_section_'.$i;
			add_settings_section(
				$section_id,
				'Настройки для "'.$currencies[$i]['text'].'"',
				[__CLASS__, 'view_section_description'],
				self::CURRENCY_PAGE_NAME,
				['currency_ind' => $i]
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
		$matex->variables['rub'] = 1.0;
		
		$data = [];

		$new_data = array_values($new_data);
		$len = sizeof($new_data);
		for($i=0; $i<$len; $i++){
			if(!is_array($new_data[$i])){
				add_settings_error($setting_name, $setting_name, 'Отсутвуют данные о #'.$i.' валюте');
				continue;
			}
			
			$add_data = ['code' => '', 'text' => '', 'buy_formula' => '', 'send_formula' => ''];
			foreach($add_data as $key => $val){
				$add_data[$key] = isset($new_data[$i][$key]) ? (string) $new_data[$i][$key] : '';
			}
			
			if($len - 1 == $i){
				if(	$add_data['code'] === '' &&
					$add_data['text'] === '' &&
					$add_data['buy_formula'] === '' &&
					$add_data['send_formula'] === ''){
					continue;
				}
			}
			
			if($add_data['code'] === ''){
				add_settings_error($setting_name, $setting_name, 'Код валюты #'.$i.' отсутствует');
				continue;
			}
			//если код отсутсвует в памяти, проверим его
			if(!isset($old_codes[$add_data['code']])){
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
				//todo возможно добавить обновление цены
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

			if($add_data['send_formula'] === ''){
				add_settings_error($setting_name, $setting_name, 'Формула продажи валюты #'.$i.' отсутствует');
				continue;
			}
			try{
				$matex->execute($add_data['send_formula']);
			}catch(Exception $ex){
				add_settings_error($setting_name, $setting_name, 'Формула продажи валюты #'.$i.' не верна: '.$ex->getMessage());
				continue;
			}
			
			$data[] = $add_data;
		}
		
		//todo вызвать обновление курсов
		return $data;
	}

	public static function view_section_description($args){
		echo 'абоба';
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
	public static function view_currency_send_formula($args){
		echo '<textarea type="text" name="atlant_calculator_data['.$args['currency_ind'].'][send_formula]" cols="100" rows="10" style="font-family:\'courier new\', monospace;">'
			.esc_html($args['val']).'</textarea>';
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
}

//создаем страницу с настройками калькулятора
add_action('admin_init', ['atlant_currency_calculator', 'init_currency_settings']);
add_action('admin_menu', ['atlant_currency_calculator', 'add_calculator_page']);

