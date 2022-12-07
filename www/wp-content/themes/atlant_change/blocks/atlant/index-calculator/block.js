(function(blocks, editor, element, blockEditor){
	let el = element.createElement;
	let useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType('atlant/index-calculator', {
		title: 'Блок с калькулятором на главной странице',
		icon: 'analytics',
		category: 'atlant',

		edit: function(props){
			return el('div',useBlockProps({className: 'components-placeholder'}),
				el('label',
					{className: 'components-placeholder__label'},
					el(element.RawHTML, null, '<span class="dashicons dashicons-analytics"></span> Блок с калькулятором на главной странице')
				),
				el('label', {className: 'components-placeholder__label'}, 'Главный заголовок'),
				el(blockEditor.PlainText,
					{
						className: 'blocks-shortcode__textarea',
						style: {marginBottom:'20px'},
						value: props.attributes.main_header,
						'aria-label': 'Главный заголовок',
						onChange: main_header => props.setAttributes({
							main_header
						})
					}
				),
				el('label', {className: 'components-placeholder__label'}, 'Подзаголовок'),
				el(blockEditor.PlainText,
					{
						className: 'blocks-shortcode__textarea',
						style: {marginBottom:'20px'},
						value: props.attributes.sub_header,
						'aria-label': 'Подзаголовок',
						onChange: sub_header => props.setAttributes({
							sub_header
						})
					}
				),
				el('label', {className: 'components-placeholder__label'}, 'Содержимое блока'),
				el(blockEditor.RichText,
					{
						value: props.attributes.content,
						'aria-label': 'Содержимое',
						style: {width:'100%', backgroundColor:'#eee', minHeight:'150px'},
						onChange: content => props.setAttributes({
							content
						})
					}
				)
			);
		},

		save: function(props){
			function add_slashes(str){
				str = str + '';
				return str.replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
			}
			
			let data = '[atlant-index-calculator main_header="'+add_slashes(props.attributes.main_header)
				+'" sub_header="'+add_slashes(props.attributes.sub_header)
				+'"]'+props.attributes.content+'[/atlant-index-calculator]';
			
			return el(element.RawHTML, null, data);
		},
	});
})(
	window.wp.blocks,
	window.wp.editor,
	window.wp.element,
	window.wp.blockEditor
);


/*
function ShortcodeEdit(_ref) {
	let {
	attributes,
	setAttributes
	} = _ref;
	const instanceId = (0,external_wp_compose_namespaceObject.useInstanceId)(ShortcodeEdit);
	const inputId = `blocks-shortcode-input-${instanceId}`;
	return el(
		'div',
		useBlockProps({
			className: 'components-placeholder'
		}),
		el(
			'label',
			{
				htmlFor: inputId,
				className: "components-placeholder__label"
			},
			el(
				build_module_icon,
				{
					icon: library_shortcode
				}
			),
			(0,external_wp_i18n_namespaceObject.__)('Shortcode')
		),
		el(
			external_wp_blockEditor_namespaceObject.PlainText,
			{
				className: "blocks-shortcode__textarea",
				id: inputId,
				value: attributes.text,
				"aria-label": (0,external_wp_i18n_namespaceObject.__)('Shortcode text'),
				placeholder: (0,external_wp_i18n_namespaceObject.__)('Write shortcode here…'),
				onChange: text => setAttributes({
					text
				})
			}
		)
	);
}

function shortcode_save_save(_ref) {
	let {
		attributes
	} = _ref;
	return el(external_wp_element_namespaceObject.RawHTML, null, attributes.text);
}

 */