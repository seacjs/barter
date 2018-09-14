let button = document.getElementById('button');
let selector = document.getElementById('selector');
$(".fa-angle-down").on("click", function() {
    console.log('click');
    $(this).parent().next().toggle(50);
});

$(document).ready(function() {
    $('#select-subcategory').select2({
        width: 'style',
        placeholder: 'Выберите подкатегорию',
    });
    $('#select-category').select2({
        width: 'style',
        placeholder: 'Выберите категорию',
    });
    $('b[role="presentation"]').hide();
    $('.select2-selection__arrow').append('<i class="fa fa-angle-down"></i>');
});