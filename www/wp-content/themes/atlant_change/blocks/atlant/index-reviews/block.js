(function(blocks, editor, element, blockEditor){
	let block_data = {
		el: element.createElement,
		react2str: element.renderToString,
		InnerBlocks: blockEditor.InnerBlocks,
		useBlockProps: blockEditor.useBlockProps,

		element:element,
		blockEditor:blockEditor,
	
		block_spec: {
			title: 'Блок Отзывы на главной странице',
			icon: 'admin-comments',
			category: 'atlant'
		},
		
		block_name: 'atlant/index-reviews',
		
		block_inputs: {
			"header": {
				type: blockEditor.PlainText,
				header: 'Заголовок'
			},
			"review_set": {
				isLink: true,
				header: 'Левая ссылка'
			},
			"reviews": {
				isLink: true,
				header: 'Правая ссылка'
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