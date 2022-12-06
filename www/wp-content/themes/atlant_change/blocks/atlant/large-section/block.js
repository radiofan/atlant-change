(function(blocks, editor, element, blockEditor){
	let el = element.createElement;
	let InnerBlocks = blockEditor.InnerBlocks;
	let useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType('atlant/large-section', {
		title: 'Секция на ширину страницы',
		icon: 'align-wide',
		category: 'atlant',

		edit: function () {
			return el( 'section', useBlockProps(), el( InnerBlocks ) );
		},
		
		save: function () {
			return el( 'section', useBlockProps.save(), el( InnerBlocks.Content ) );
		},
	});
})(
	window.wp.blocks,
	window.wp.editor,
	window.wp.element,
	window.wp.blockEditor
);