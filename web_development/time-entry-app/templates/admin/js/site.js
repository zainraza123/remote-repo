$(document).ready(function () {
    var table = $('.report-table').DataTable({
        lengthMenu: [
            [25, 100, 250, 500, -1],
            ['25', '100', '250', '500', 'All']
        ],
        buttons: [
            'csv', 'print'
        ],
        "aaSorting": []/*,
        select: true*/
    });
    table.buttons().container().appendTo('.report-export');

    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });

    $('[data-toggle="tooltip"]').tooltip();

});

function showAllAccordion(e) {
    $('#accordion .panel-collapse').collapse('show');
}

function hideAllAccordion(e) {
    $('#accordion .panel-collapse').collapse('hide');
}

tinymce.init({
    selector: '.editor',
    height: 200,
    plugins: [
        'advlist autolink lists link image print preview hr anchor',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    /*toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',*/
    image_advtab: true,
    templates: [
        { title: 'Web Hosting', url: 'templates/admin/vendor/tinymce/templates/webHosting.html' },
        { title: 'Test template 2', content: 'Test 2' }
    ],
    content_css: [
        'templates/admin/vendor/bootstrap/css/bootstrap.min.css',
        'templates/admin/css/style.css'
    ],
    statusbar: false
});
