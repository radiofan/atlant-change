(function(blocks, editor, element, blockEditor){
	let el = element.createElement;
	let useBlockProps = blockEditor.useBlockProps;
	
	let block_spec = {
		title: 'Блок O на главной странице',
		icon: 'marker',
		category: 'atlant'
	};
	
	let block_name = 'atlant/index-o-block';
	
	let block_inputs = {
		"header": {
			type: blockEditor.PlainText,
			header: 'Заголовок'
		},
		"content": {
			type: blockEditor.RichText,
			isContent: true,
			header: 'Содержимое'
		},
		"button_text": {
			type: blockEditor.PlainText,
			header: 'Текст кнопки'
		},
		"button_href": {
			type: blockEditor.PlainText,
			header: 'Ссылка кнопки'
		},
		"button_rel": {
			type: blockEditor.PlainText,
			header: 'Отношение (rel) кнопки'
		}
	}
	
	block_spec.edit = function(props){
		
		let inputs = [];
		
		for(let attr in block_inputs){
			inputs.push(
				el('label', {className: 'components-placeholder__label'}, block_inputs[attr].header)
			);
			inputs.push(
				el(block_inputs[attr].type,
					{
						className: 'blocks-shortcode__textarea',
						style: block_inputs[attr].type == blockEditor.RichText ? {width:'100%', backgroundColor:'#eee', minHeight:'150px'} : {marginBottom:'20px'},
						value: props.attributes[attr],
						'aria-label': block_inputs[attr].header,
						onChange: function(data){
							let tmp = {};
							tmp[attr] = data;
							props.setAttributes(tmp);
						}
					}
				)
			);
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
		function add_slashes(str){
			str = str + '';
			return str.replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
		}
		
		let shortcode_name = block_name.replace('/', '-');
		let content = '';

		let data = '[' + shortcode_name;
		for(let attr in block_inputs){
			if(block_inputs[attr].hasOwnProperty('isContent') && block_inputs[attr]){
				content = props.attributes[attr];
				continue;
			}
			
			data += ' '+attr+'="' + add_slashes(props.attributes[attr])+'"';
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