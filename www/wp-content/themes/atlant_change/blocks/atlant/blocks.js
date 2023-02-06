const atlant_blocks = {
	shortcode_escape: function(str, clear_html = false){
		str = str + '';
		str = str.replaceAll('"', '&#34;')
		.replaceAll('\'', '&#39;')
		.replaceAll('[', '&#91;')
		.replaceAll(']', '&#93;')
		.replace(/\u0000/g, '\\0');

		if(clear_html){
			str = str.replaceAll('<', '&#60;')
			.replaceAll('>', '&#62;');
		}
		return str;
	},

	edit: function(props){
		
		let {el, react2str, InnerBlocks, useBlockProps, element, blockEditor, block_spec, block_name, block_inputs} = this;

		let inputs = [];

		for(let attr in block_inputs){
			inputs.push(
				el('label', {className: 'components-placeholder__label'}, block_inputs[attr].header)
			);
			if(block_inputs[attr].hasOwnProperty('isLink') && block_inputs[attr].isLink){

				let link_inputs = [];
				let link_fields = {text: 'Текст', href: 'Ссылка', rel: 'Отношение (rel) кнопки'};

				for(let key in link_fields){
					link_inputs.push(
						el(
							blockEditor.PlainText,
							{
								className: 'blocks-shortcode__textarea',
								value: props.attributes[attr + '_' + key],
								placeholder: link_fields[key],
								onChange: function(data){
									let tmp = {};
									if(typeof data == 'string' || data){
										tmp[attr + '_' + key] = data;
									}else{
										tmp[attr + '_' + key] = '';
									}
									props.setAttributes(tmp);
								}
							}
						)
					);
				}
				inputs.push(el('div', {className: 'atlant-link-box'}, link_inputs));

			}else if(block_inputs[attr].hasOwnProperty('isBlocks') && block_inputs[attr].isBlocks){
				inputs.push(
					el(
						'div',
						useBlockProps({className: 'atlant-blocks'}),
						el(InnerBlocks)
					)
				);
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
									tmp[attr] = data;
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


		return el('div', useBlockProps({className: 'components-placeholder'}),
			el(
				'label',
				{className: 'components-placeholder__label'},
				el(
					element.RawHTML,
					null,
					'<span class="dashicons dashicons-' + block_spec.icon + '"></span> ' + block_spec.title
				)
			),
			inputs
		);
	},

	save: function(props){

		let {el, react2str, InnerBlocks, useBlockProps, element, blockEditor, block_spec, block_name, block_inputs} = this;

		let shortcode_name = block_name.replace('/', '-');
		let content = '';

		let link_fields = {text: 'Текст', href: 'Ссылка', rel: 'Отношение (rel) кнопки'};

		let data = '[' + shortcode_name;
		for(let attr in block_inputs){
			if(block_inputs[attr].hasOwnProperty('isContent') && block_inputs[attr]){
				content = props.attributes[attr];
				continue;
			}
			if(block_inputs[attr].hasOwnProperty('isLink') && block_inputs[attr]){
				for(let key in link_fields){
					data += ' ' + attr + '_' + key + '="' + atlant_blocks.shortcode_escape(props.attributes[attr + '_' + key],1) + '"';
				}
				continue;
			}
			if(block_inputs[attr].hasOwnProperty('isBlocks')){
				content = react2str(InnerBlocks.Content());
				continue;
			}

			data += ' ' + attr + '="' + atlant_blocks.shortcode_escape(props.attributes[attr], 1) + '"';
		}
		data += ']' + content + '[/' + shortcode_name + ']';

		return el(element.RawHTML, null, data);
	}
};