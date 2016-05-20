
CKEDITOR.plugins.add( 'shortcode7', {
    icons: 'shortcode7',
    init: function( editor ) {
        editor.addCommand( 'horario', {
            exec: function( editor ) {
                var nombre = "[horario]";
                editor.insertHtml(nombre);
            }
        });
        editor.ui.addButton( 'shortcode7', {
            label: 'Horario',
            command: 'horario',
            toolbar: 'insert'
        });
    }
});