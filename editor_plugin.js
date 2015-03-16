(function() {
    tinymce.PluginManager.add('photocart_link_tc_button', function( editor, url ) {
        editor.addButton( 'photocart_link_tc_button', {
	    title: 'Photocart Link',
            text: 'PcL',
            icon: false,
            onclick: function() {
	    editor.windowManager.open( {
	        title: 'Add Photocart Link Attributes',
	        body: [{
	            type: 'textbox',
	            name: 'imageID',
	            label: 'imageID'
	        },
	        {
        	    type: 'listbox', 
	            name: 'imageType', 
	            label: 'Image Type', 
        	    'values': [
	                {text: 'Full', value: 'full'},
	                {text: 'Thumb', value: 'thumb'}
	            ]
	        },
	        {
	            type: 'textbox',
        	    name: 'imageHeight',
	            label: 'imageHeight'
	        },
	        {
	            type: 'textbox',
        	    name: 'imageWidth',
	            label: 'imageWidth'
	        },
	        {
        	    type: 'listbox', 
	            name: 'imageAlign', 
	            label: 'Image Align', 
        	    'values': [
	                {text: 'Left', value: 'left'},
	                {text: 'Center', value: 'center'},
	                {text: 'Right', value: 'right'}
	            ]
	        },
	        {
	            type: 'textbox',
        	    name: 'imageCaption',
	            label: 'imageCaption'
	        },
	        {
	            type: 'textbox',
        	    name: 'imageTitle',
	            label: 'imageTitle'
	        },
	        {
	            type: 'textbox',
        	    name: 'contSize',
	            label: 'contSize'
	        },
	        {
	            type: 'listbox',
        	    name: 'noImage',
	            label: 'noImage',
        	    'values': [
	                {text: 'False', value: 'false'},
	                {text: 'True', value: 'true'}
	            ]
	        }
		],
	        onsubmit: function( e ) {
	            editor.insertContent( '[photocart_link imageID="' + e.data.imageID + '" imageType="' + e.data.imageType + '" imageWidth="' + e.data.imageWidth + '" imageHeight="' + e.data.imageHeight + '" imageAlign="' + e.data.imageAlign + '" imageCaption="' + e.data.imageCaption + '" imageTitle="' + e.data.imageTitle + '" contSize="' + e.data.contSize + '" noImage="' + e.data.noImage + '"]');
	        }
    });
}
        });
    });
})();
