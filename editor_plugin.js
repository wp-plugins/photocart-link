function photocart_link_html_button() {
    jQuery("<table border=0 width=100%>" +
      "<tr><td>imageID</td><td><input type=text size=20 id=imageID name=imageID></td></tr>" +
      "<tr><td>imageType</td><td><select id=imageType name=imageType><option value='full'>Full</option>" +
        "<option value='thumb'>Thumb</option></select></td></tr>" +
      "<tr><td>imageHeight</td><td><input type=text size=20 id=imageHeight name=imageHeight></td></tr>" +
      "<tr><td>imageWidth</td><td><input type=text size=20 id=imageWidth name=imageWidth></td></tr>" +
      "<tr><td>imageAlign</td><td><select id=imageAlign name=imageAlign><option value='left'>Left</option>" +
        "<option value='center'>Center</option><option value='right'>Right</option></select></td></tr>" +
      "<tr><td>imageCaption</td><td><input type=text size=20 id=imageCaption name=imageCaption></td></tr>" +
      "<tr><td>imageTitle</td><td><input type=text size=20 id=imageTitle name=imageTitle></td></tr>" +
      "<tr><td>contSize</td><td><input type=text size=20 id=contSize name=contSize></td></tr>" +
      "<tr><td>noImage</td><td><select id=noImage name=noImage><option value='false'>False</option>" +
        "<option value='true'>True</option></select></td></tr>" +
      "</table>").appendTo("#dialog-form");

    dialog = jQuery( "#dialog-form" ).dialog({
      'dialog-class': 'no-close',
      'modal': true,
      'height': 425,
      'width': 350,
      'resizable': false,
      'buttons': [
        {
          text: 'Ok',
          click: function() {
            jQuery( "#content" ).append( '[photocart_link imageID="' + document.getElementById('imageID').value + '"');
            jQuery( "#content" ).append( ' imageType="' + document.getElementById('imageType').value + '"');
            jQuery( "#content" ).append( ' imageWidth="' + document.getElementById('imageWidth').value + '"');
            jQuery( "#content" ).append( ' imageHeight="' + document.getElementById('imageHeight').value + '"');
            jQuery( "#content" ).append( ' imageAlign="' + document.getElementById('imageAlign').value + '"');
            jQuery( "#content" ).append( ' imageCaption="' + document.getElementById('imageCaption').value + '"');
            jQuery( "#content" ).append( ' imageTitle="' + document.getElementById('imageTitle').value + '"');
            jQuery( "#content" ).append( ' contSize="' + document.getElementById('contSize').value + '"');
            jQuery( "#content" ).append( ' noImage="' + document.getElementById('noImage').value + '"]');
            jQuery( "#dialog-form" ).empty();
            jQuery( "#dialog-form" ).dialog( "destroy");
            jQuery( "#dialog-form").dialog( "close" );
          }
        },
        {
          text: 'Cancel',
          click: function() {
            jQuery( "#dialog-form" ).empty();
            jQuery( "#dialog-form").dialog( "destroy");
            jQuery( "#dialog-form").dialog( "close" );
          }
        }
      ],
      close: function() {
        jQuery( "#dialog-form" ).empty();
        jQuery( "#dialog-form").dialog( "destroy");
        jQuery( "#dialog-form").dialog( "close" );
      }
    });

  jQuery(document).ready(function() {
    dialog.dialog("open");
  });
}

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
	            label: 'imageType', 
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
	            label: 'imageAlign', 
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
