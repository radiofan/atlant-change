(function(blocks, editor, element, blockEditor){
	let el = element.createElement;
	let useBlockProps = blockEditor.useBlockProps;

	function shortcode_escape(str){
		str = str + '';
		return str.replaceAll('"', '&#34;')
		.replaceAll('\'', '&#39;')
		.replaceAll('[', '&#91;')
		.replaceAll(']', '&#93;')
		.replace(/\u0000/g, '\\0');
	}

	let block_spec = {
		title: 'Блок с калькулятором на главной странице',
		icon: 'analytics',
		category: 'atlant'
	};

	let block_name = 'atlant/index-calculator';

	let block_inputs = {
		"main_header": {
			type: blockEditor.PlainText,
			header: 'Заголовок'
		},
		"sub_header": {
			type: blockEditor.PlainText,
			header: 'Подзаголовок'
		},
		"content": {
			type: blockEditor.RichText,
			isContent: true,
			header: 'Содержимое'
		}
	}

	block_spec.edit = function(props){

		let inputs = [];

		for(let attr in block_inputs){
			inputs.push(
				el('label', {className: 'components-placeholder__label'}, block_inputs[attr].header)
			);
			if(block_inputs[attr].hasOwnProperty('isLink') && block_inputs[attr].isLink){

				let link_inputs = [];
				let link_fields = {text:'Текст', href:'Ссылка', rel:'Отношение (rel) кнопки'};

				for(let key in link_fields){
					link_inputs.push(
						el(
							blockEditor.PlainText,
							{
								className: 'blocks-shortcode__textarea',
								value: props.attributes[attr+'_'+key],
								placeholder: link_fields[key],
								onChange: function(data){
									let tmp = {};
									if(typeof data == 'string' || data){
										tmp[attr+'_'+key] = shortcode_escape(data);
									}else{
										tmp[attr+'_'+key] = '';
									}
									props.setAttributes(tmp);
								}
							}
						)
					);
				}
				inputs.push(el('div', {className: 'atlant-link-box'}, link_inputs));


			}else{
				inputs.push(
					el(
						block_inputs[attr].type,
						{
							className: 'blocks-shortcode__textarea' + (block_inputs[attr].type == blockEditor.RichText ? ' atlant-content-box' : ' atlant-text-input'),
							value: props.attributes[attr],
							'aria-label': block_inputs[attr].header,
							onChange: function(data){
								let tmp = {};
								if(typeof data == 'string' || data){
									tmp[attr] = shortcode_escape(data);
								}else{
									tmp[attr] = '';
								}
								props.setAttributes(tmp);
							}
						}
					)
				);
			}
		}


		return el('div',useBlockProps({className: 'components-placeholder'}),
			el('label',
				{className: 'components-placeholder__label'},
				el(element.RawHTML, null, '<span class="dashicons dashicons-'+block_spec.icon+'"></span> '+block_spec.title)
			),
			inputs
		);
	};

	block_spec.save = function(props){

		let shortcode_name = block_name.replace('/', '-');
		let content = '';

		let link_fields = {text:'Текст', href:'Ссылка', rel:'Отношение (rel) кнопки'};

		let data = '[' + shortcode_name;
		for(let attr in block_inputs){
			if(block_inputs[attr].hasOwnProperty('isContent') && block_inputs[attr]){
				content = props.attributes[attr];
				continue;
			}
			if(block_inputs[attr].hasOwnProperty('isLink') && block_inputs[attr]){
				for(let key in link_fields){
					data += ' '+attr+'_'+key+'="' + shortcode_escape(props.attributes[attr+'_'+key])+'"';
				}
				continue;
			}

			data += ' '+attr+'="' + shortcode_escape(props.attributes[attr])+'"';
		}
		data += ']'+content+'[/'+shortcode_name+']';

		return el(element.RawHTML, null, data);
	}

	blocks.registerBlockType(block_name, block_spec);
})(
	window.wp.blocks,
	window.wp.editor,
	window.wp.element,
	window.wp.blockEditor
);