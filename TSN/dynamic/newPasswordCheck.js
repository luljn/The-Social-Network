// While the update of his password by a user to verify the value of the fields on the form.

var passwordField1 = document.getElementById("nouveauMdp1");
var passwordField2 = document.getElementById("nouveauMdp2");
var message = document.getElementById("messageMdp");

passwordField1.addEventListener("input", checkPasswordFields);
passwordField2.addEventListener("input", checkPasswordFields);

function checkPasswordFields() {

    if(passwordField1.value !== passwordField2.value){

        message.textContent = "Veuillez vérifier votre nouveau mot de passe";
    }

    else{

        message.textContent = "";
    }
} 