// To add a Comment on Post using AJAX.

$(document).ready(function() {
    $('[id^="submitComment"]').click(function() {
        var postId = $(this).attr('id').replace('submitComment', ''); 
        
        var formData = new FormData($('#formComment' + postId)[0]); 
        
        $.ajax({
            url: $('#formComment' + postId).attr('action'), 
            type: $('#formComment' + postId).attr('method'), 
            data: formData, 
            processData: false,
            contentType: false, 
            success: function(response) {
                console.log(response); 
                $('#formComment' +  postId)[0].reset(); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});
