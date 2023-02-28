jQuery(document).ready(function($){
	$('body').on('change', 'form.calculator-form select', recalculate)
			 .on('input', 'form.calculator-form input', recalculate);
	
	function recalculate(e){
		let $calculator = $(this).closest('form.calculator-form');
		
		let type = $calculator.find('select[name="type"]').val();
		let $option = $calculator.find('select[name="currency"] > option:selected');
		let buy_price = parseFloat($option.data('buyPrice'));
		let sale_price = parseFloat($option.data('salePrice'));
		
		let $input = $calculator.find('input[name="value"]');
		let value = $input.val();
		value = validate(value);
		$input.val(value);
		value = value ? parseFloat(value) : 0;
		
		let $result = $calculator.find('.calculator-form__result');
		let res;
		let price;
		let text;
		
		if(type == 'buy'){
			price = buy_price;
			text = 'Вы заплатите';
		}else{
			price = sale_price;
			text = 'Вы получите';
		}
		res = Math.round(value * price * 100)/100;

		$result.html(text+': <span class="color--yellow">'+res+'&nbsp;₽</span>');
	}
	
	function validate(float_str){
		float_str = float_str.replace(/[^0-9\.,]/g, '');
		float_str = float_str.replace(/[,]/g, '.');
		while(!$.isNumeric(float_str) && float_str){
			float_str = float_str.slice(0, -1);
		}
		return float_str;
	}
	
});