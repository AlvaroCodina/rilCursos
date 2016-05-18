
CKEDITOR.plugins.add( 'shortcode2', {
    icons: 'shortcode2',
    init: function( editor ) {
        editor.addCommand( 'insertNombreCategoria', {
            exec: function( editor ) {
                var nombre = "[nombreCategoria]";
                editor.insertHtml(nombre);
            }
        });
        editor.ui.addButton( 'shortcode2', {
            label: 'Categoria Curso',
            command: 'insertNombreCategoria',
            toolbar: 'insert'
        });
    }
});