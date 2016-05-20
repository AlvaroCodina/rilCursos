
CKEDITOR.plugins.add( 'shortcode5', {
    icons: 'shortcode5',
    init: function( editor ) {
        editor.addCommand( 'fechaInicio', {
            exec: function( editor ) {
                var nombre = "[fechaInicio]";
                editor.insertHtml(nombre);
            }
        });
        editor.ui.addButton( 'shortcode5', {
            label: 'Fecha Inicio',
            command: 'fechaInicio',
            toolbar: 'insert'
        });
    }
});