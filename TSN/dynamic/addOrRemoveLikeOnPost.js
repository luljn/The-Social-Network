//To add or remove a like on a post.

$(document).ready(function(){

    $('[id^="buttonLike"]').click(function(){

        var nameButton = $(this).attr('name');
        var targetId = $(this).data('target');
        var targetElement = $('#' + targetId);
        var currentValue = parseInt(targetElement.text());

        if (nameButton == 'increment'){

            targetElement.text(currentValue + 1);
            $(this).attr('name', 'decrement');
        } 
        
        else if (nameButton == 'decrement'){
            
            targetElement.text(currentValue - 1);
            $(this).attr('name', 'increment');
        }
    });
});

