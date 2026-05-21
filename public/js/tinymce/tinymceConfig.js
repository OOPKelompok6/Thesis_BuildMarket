document.addEventListener("DOMContentLoaded", function() {
    tinymce.init({ 
        selector: '#descriptionTextArea',
        menubar: "edit insert format",
        license_key: 'gpl', 
        removed_menuitems: 'superscript subscript code',
        branding: false,
        promotion: false,
        invalid_elements: 'img'
    });
});