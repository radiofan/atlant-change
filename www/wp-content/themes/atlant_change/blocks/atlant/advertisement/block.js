(function(blocks, editor, element, blockEditor){
	let el = element.createElement;
	let InnerBlocks = blockEditor.InnerBlocks;
	let useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType('atlant/advertisement', {
		title: 'Реклама',
		icon: 'money',
		category: 'atlant',

		edit: function(){
			return el('section', useBlockProps({className: 'index-ad-block container atlant-advertisement'}),
				el(
					'div',
					{class:'index-ad-block__ad'},
					el(InnerBlocks)
				)
			);
		},

		save: function(){
			return el('section', useBlockProps.save({className: 'index-ad-block container atlant-advertisement'}),
				el(
					'div',
					{class:'index-ad-block__ad'},
					el(InnerBlocks.Content)
				)
			);
		},
	});
})(
	window.wp.blocks,
	window.wp.editor,
	window.wp.element,
	window.wp.blockEditor
);