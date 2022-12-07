(function(blocks, editor, element, blockEditor){
	let el = element.createElement;
	let InnerBlocks = blockEditor.InnerBlocks;
	let useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType('atlant/section', {
		title: 'Секция с отступами',
		icon: 'align-center',
		category: 'atlant',

		edit: function(){
			return el('section', useBlockProps({className: 'atlant-section container'}), el(InnerBlocks));
		},

		save: function(){
			return el('section', useBlockProps.save({className: 'atlant-section container'}), el(InnerBlocks.Content));
		},
	});
})(
	window.wp.blocks,
	window.wp.editor,
	window.wp.element,
	window.wp.blockEditor
);