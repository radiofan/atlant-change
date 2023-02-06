(function(blocks, editor, element, blockEditor){
	let block_data = {
		el: element.createElement,
		react2str: element.renderToString,
		InnerBlocks: blockEditor.InnerBlocks,
		useBlockProps: blockEditor.useBlockProps,
		
		element:element,
		blockEditor:blockEditor,

		block_spec: {
			title: 'Двойной блок с названием (страница помощь)',
			icon: 'columns',
			category: 'atlant'
		},

		block_name: 'atlant/help-double-block',

		block_inputs: {
			"header": {
				type: blockEditor.PlainText,
				header: 'Заголовок'
			},
			"content": {
				isBlocks: true,
				header: 'Левый столбец'
			},
			"right_column": {
				type: blockEditor.RichText,
				header: 'Правый столбец'
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