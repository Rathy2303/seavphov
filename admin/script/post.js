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

    // Delete Button Click
    $('.js-btn-delete').on('click',function(){
        const book_id = $(this).data('id');
        const book_image_name = $(this).data('image');
        //When Click Confirm Delete
        $('#btn-delete').on('click',function(){
            $.ajax({
                type: "POST",
                url: "./php/delete_book.php",
                data: {
                    id: book_id,
                    img: book_image_name
                },
                success: function(rp) {
                    location.reload(true);
                },
                error: function() {
    
                }
            });
        })
    });
})