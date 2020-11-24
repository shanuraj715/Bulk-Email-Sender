let editor_data;
let editor_data_html;

DecoupledDocumentEditor
	.create( document.querySelector( '#ck_document_editor' ), {
		
		toolbar: {
			items: [
				'heading',
				'|',
				'fontSize',
				'fontFamily',
				'|',
				'fontColor',
				'fontBackgroundColor',
				'bold',
				'italic',
				'underline',
				'alignment',
				'|',
				'link',
				'blockQuote',
				'insertTable',
				'|',
				'specialCharacters',
				'numberedList',
				'bulletedList',
				'|',
				'subscript',
				'superscript',
				'horizontalLine',
				'code',
				'codeBlock',
				'|',
				'mediaEmbed',
				'todoList',
				'CKFinder',
				'pageBreak',
				'removeFormat',
				'|',
				'undo',
				'redo'
			]
		},
		language: 'en',
		table: {
			contentToolbar: [
				'tableColumn',
				'tableRow',
				'mergeTableCells',
				'tableProperties',
				'tableCellProperties'
			]
		},
		licenseKey: '',
		
	} )
	.then( editor => {

		// Set a custom container for the toolbar.
		document.querySelector( '#toolbar-container' ).appendChild( editor.ui.view.toolbar.element );
		document.querySelector( '.ck-toolbar' ).classList.add( 'ck-reset_all' );

		editor_data = editor;
	} )
	.catch( error => {
	console.error( error );
} );