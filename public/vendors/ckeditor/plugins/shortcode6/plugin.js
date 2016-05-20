
CKEDITOR.plugins.add( 'shortcode6', {
    icons: 'shortcode6',
    init: function( editor ) {
        editor.addCommand( 'lugar', {
            exec: function( editor ) {
                var nombre = "[lugar]";
                editor.insertHtml(nombre);
            }
        });
        editor.ui.addButton( 'shortcode6', {
            label: 'Lugar',
            command: 'lugar',
            toolbar: 'insert'
        });
    }
});