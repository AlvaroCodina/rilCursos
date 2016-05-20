
CKEDITOR.plugins.add( 'shortcode4', {
    icons: 'shortcode4',
    init: function( editor ) {
        editor.addCommand( 'insertResumen', {
            exec: function( editor ) {
                var nombre = "[resumen]";
                editor.insertHtml(nombre);
            }
        });
        editor.ui.addButton( 'shortcode4', {
            label: 'Resumen',
            command: 'insertResumen',
            toolbar: 'insert'
        });
    }
});