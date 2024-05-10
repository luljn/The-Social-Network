document.addEventListener('DOMContentLoaded', function(){

    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('email-error');
    const btn1 = document.getElementById('btn-save');

    emailInput.addEventListener('input', function(){

        const email = emailInput.value;
        const isValid = validateEmail(email);

        if (!isValid){

            emailError.textContent = 'Adresse e-mail non valide';
            emailError.style.display = 'block';
            btn1.disabled = true;
        } 
        
        else{

            emailError.textContent = '';
            emailError.style.display = 'none';
            btn1.disabled = false;
        }
    });

    function validateEmail(email){
        
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
});