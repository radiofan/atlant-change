(function(blocks, editor, element, blockEditor){
	var el = element.createElement;
	var RichText = editor.RichText;
	var useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType('atlant/large-section', {
		title: 'Секция на ширину страницы',
		icon: 'align-wide',
		category: 'atlant',

		attributes: {
			content: {
				type: 'string',
				source: 'html',
				selector: 'section.block-large-section'
			},
		},

		edit: function(props){
			var content = props.attributes.content;

			function onChangeContent(newContent){
				props.setAttributes({content: newContent});
			}

			return el(
				RichText,
				useBlockProps({
					tagName: 'section',
					className: props.className,
					onChange: onChangeContent,
					value: content,
				})
			);
		},

		save: function(props){
			return el(
				RichText.Content,
				useBlockProps.save({
					tagName: 'section',
					value: props.attributes.content,
				})
			);
		},
	});
})(
	window.wp.blocks,
	window.wp.editor,
	window.wp.element,
	window.wp.blockEditor
);