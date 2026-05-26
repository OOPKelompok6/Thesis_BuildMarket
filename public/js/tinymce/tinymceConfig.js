document.addEventListener("DOMContentLoaded", function() {
    tinymce.init({ 
        selector: '#descriptionTextArea',
        plugins: 'lists',
        toolbar:
            'undo redo | ' +
            'styles | ' +
            'bold italic | ' +
            'alignleft aligncenter alignright | ' +
            'bullist numlist | ' +
            'outdent indent',
        menubar: "edit insert format",
        license_key: 'gpl', 
        removed_menuitems: 'superscript subscript code',
        branding: false,
        promotion: false,
        invalid_elements: 'img'
    });
});