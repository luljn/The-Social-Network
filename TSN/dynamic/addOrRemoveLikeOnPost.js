//To add or remove a like on a post.

$(document).ready(function(){

    $('[id^="buttonLike"]').click(function(){

        var postId = $(this).attr('id').replace('buttonLike', ''); // Récupérer l'ID du post

        var nameButton = $(this).attr('name');
        var targetId = $(this).data('target');
        var targetElement = $('#' + targetId);
        var currentValue = parseInt(targetElement.text());

        if (nameButton == 'increment'){

            targetElement.text(currentValue + 1);
            $(this).attr('name', 'decrement');
            $('#formLike' + postId).attr('action', 'index.php?action=removeLike');
        } 
        
        else if (nameButton == 'decrement'){
            
            targetElement.text(currentValue - 1);
            $(this).attr('name', 'increment');
            $('#formLike' + postId).attr('action', 'index.php?action=addLike');
        }
    });
});

