
CKEDITOR.plugins.add( 'shortcode1', {
    icons: 'shortcode1',
    init: function( editor ) {
        editor.addCommand( 'insertNombreAlumno', {
            exec: function( editor ) {
                var nombreAlumno = "[nombreAlumno]";
                editor.insertHtml(nombreAlumno);
            }
        });
        editor.ui.addButton( 'shortcode1', {
            label: 'Alumno',
            command: 'insertNombreAlumno',
            toolbar: 'insert'
        });
    }
});