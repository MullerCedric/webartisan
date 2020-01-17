(function () {
    tinymce.PluginManager.add('webart-code', function (editor, url) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('webart-code', {
            title: 'Ajouter une balise code (inline)',
            cmd: 'webart-code',
            // image: url + '/scanwp.png',
            icon: false,
            text: '<>',
        });

        editor.addCommand('webart-code', function () {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });

            var open_column = '<code><pre>' + selected_text + '</pre></code>';
            var close_column = '';
            var return_text = '';
            return_text = open_column + close_column;
            editor.execCommand('mceReplaceContent', false, return_text);
            return;
        });

    });
})();
