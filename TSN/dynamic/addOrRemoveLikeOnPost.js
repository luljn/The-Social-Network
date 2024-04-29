//To add or remove a like on a post.
var buttons = document.querySelectorAll('[id^="buttonLike"]');

buttons.forEach(function(button){

    button.addEventListener('click', function(){

        var nameButton = button.getAttribute('name')
        var targetId = button.getAttribute('data-target');
        var targetElement = document.getElementById(targetId);
        var currentValue = parseInt(targetElement.innerHTML);

        if(nameButton == 'increment'){

            targetElement.innerHTML = currentValue + 1;
            nameButton = button.setAttribute('name', 'decrement');
        }

        else if(nameButton == 'decrement'){

            targetElement.innerHTML = currentValue - 1;
            nameButton = button.setAttribute('name', 'increment');
        } 
        
    });
});
