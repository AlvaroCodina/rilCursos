
CKEDITOR.plugins.add( 'shortcode3', {
    icons: 'shortcode3',
    init: function( editor ) {
        editor.addCommand( 'insertDescripcion', {
            exec: function( editor ) {
                var nombre = "[descripcion]";
                editor.insertHtml(nombre);
            }
        });
        editor.ui.addButton( 'shortcode3', {
            label: 'Descripción',
            command: 'insertDescripcion',
            toolbar: 'insert'
        });
    }
});