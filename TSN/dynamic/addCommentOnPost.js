// To add a Comment on Post using AJAX.

$(document).ready(function() {
    $('[id^="submitComment"]').click(function() {
        var postId = $(this).attr('id').replace('submitComment', ''); // Récupérer l'ID du post
        
        var formData = new FormData($('#formComment' + postId)[0]); // Créer un objet FormData contenant les données du formulaire
        
        $.ajax({
            url: $('#formComment' + postId).attr('action'), // Récupérer l'URL de l'action du formulaire
            type: $('#formComment' + postId).attr('method'), // Récupérer la méthode du formulaire (POST dans ce cas)
            data: formData, // Utiliser l'objet FormData pour les données du formulaire
            processData: false, // Ne pas traiter les données (laisser FormData le faire)
            contentType: false, // Ne pas définir le type de contenu (laisser FormData le faire)
            success: function(response) {
                console.log(response); // Afficher la réponse du serveur dans la console
                // Faire quelque chose avec la réponse si nécessaire
                $('#formComment' +  postId)[0].reset(); // Réinitialiser le formulaire
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Afficher les erreurs dans la console
            }
        });
    });
});
