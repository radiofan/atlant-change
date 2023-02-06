(function(blocks, editor, element, blockEditor){
	let block_data = {
		el: element.createElement,
		react2str: element.renderToString,
		InnerBlocks: blockEditor.InnerBlocks,
		useBlockProps: blockEditor.useBlockProps,

		element:element,
		blockEditor:blockEditor,
	
		block_spec: {
			title: 'Блок Что Вы получаете',
			icon: 'products',
			category: 'atlant'
		},
		
		block_name: 'atlant/for-partners-gain',
		
		block_inputs: {
			"header": {
				type: blockEditor.PlainText,
				header: 'Заголовок'
			},
			"label": {
				type: blockEditor.PlainText,
				header: 'Бирка'
			},
			"database": {
				type: blockEditor.PlainText,
				header: 'Цилиндр'
			},
			"heart": {
				type: blockEditor.PlainText,
				header: 'Сердце'
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