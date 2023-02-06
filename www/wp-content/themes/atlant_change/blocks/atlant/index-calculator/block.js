(function(blocks, editor, element, blockEditor){
	let block_data = {
		el: element.createElement,
		react2str: element.renderToString,
		InnerBlocks: blockEditor.InnerBlocks,
		useBlockProps: blockEditor.useBlockProps,

		element:element,
		blockEditor:blockEditor,

		block_spec: {
			title: 'Блок с калькулятором на главной странице',
			icon: 'analytics',
			category: 'atlant'
		},
	
		block_name: 'atlant/index-calculator',
	
		block_inputs: {
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