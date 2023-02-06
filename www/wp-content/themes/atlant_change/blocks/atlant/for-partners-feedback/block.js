(function(blocks, editor, element, blockEditor){
	let block_data = {
		el: element.createElement,
		react2str: element.renderToString,
		InnerBlocks: blockEditor.InnerBlocks,
		useBlockProps: blockEditor.useBlockProps,

		element:element,
		blockEditor:blockEditor,
	
		block_spec: {
			title: 'Блок Свяжитесь с нами',
			icon: 'phone',
			category: 'atlant'
		},
		
		block_name: 'atlant/for-partners-feedback',
		
		block_inputs: {
			"header": {
				type: blockEditor.PlainText,
				header: 'Заголовок'
			},
			"sub_header_1": {
				type: blockEditor.PlainText,
				header: 'Подзаголовок 1'
			},
			"link_1": {
				isLink: true,
				header: 'Cсылка 1'
			},
			"sub_header_2": {
				type: blockEditor.PlainText,
				header: 'Подзаголовок 2'
			},
			"link_2": {
				isLink: true,
				header: 'Cсылка 2'
			},
			"sub_header_3": {
				type: blockEditor.PlainText,
				header: 'Подзаголовок 3'
			},
			"link_3": {
				isLink: true,
				header: 'Cсылка 3'
			},
			"sub_header_4": {
				type: blockEditor.PlainText,
				header: 'Подзаголовок 4'
			},
			"link_4": {
				isLink: true,
				header: 'Cсылка 4'
			},
			"content": {
				type: blockEditor.RichText,
				isContent: true,
				header: 'Содержимое'
			}
		}
	}

	block_data.block_spec.edit = atlant_blocks.edit.bind(block_data);

	block_data.block_spec.save = atlant_blocks.save.bind(block_data);

	blocks.registerBlockType(block_data.block_name, block_data.block_spec);
})(
	window.wp.blocks,
	window.wp.editor,
	window.wp.element,
	window.wp.blockEditor
);