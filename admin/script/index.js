$(document).ready(function(){
    $('.js-btn-edit').on('click',function(){
        // Get Book Information
        const book_id = $(this).data("id");
        const book_title = $(this).data('title');
        const book_url = $(this).data('url');
        const book_type = $(this).data('type');
        const book_type_id = $(this).data('type-id');

        // Assign Value To Edit PopUp
        $('#book_title').val(book_title);
        $('#book_url').val(book_url);
        $('#book_type').html(book_type);
        $('#book_type').val(book_type_id);
        $('#book_id').val(book_id);
    });
})