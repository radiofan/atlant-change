(function(blocks, editor, element, blockEditor){
	let block_data = {
		el: element.createElement,
		react2str: element.renderToString,
		InnerBlocks: blockEditor.InnerBlocks,
		useBlockProps: blockEditor.useBlockProps,

		element:element,
		blockEditor:blockEditor,
	
		block_spec: {
			title: 'Блок Как это работает',
			icon: 'controls-forward',
			category: 'atlant'
		},
		
		block_name: 'atlant/how-work',
		
		block_inputs: {
			"header": {
				type: blockEditor.PlainText,
				header: 'Заголовок'
			},
			"first": {
				type: blockEditor.PlainText,
				header: 'Первое'
			},
			"second": {
				type: blockEditor.PlainText,
				header: 'Второе'
			},
			"third": {
				type: blockEditor.PlainText,
				header: 'Третье'
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