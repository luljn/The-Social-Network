document.getElementById('togglePassword').addEventListener('click', function(){

    const passwordField = document.getElementById('mdp');
    const fieldType = passwordField.getAttribute('type');

    if(fieldType === 'password'){

      passwordField.setAttribute('type', 'text');
      this.innerHTML = '<i class="bi bi-eye-slash"></i><span> Masquer le mot de passe</span>';
    } 
    
    else {
      
      passwordField.setAttribute('type', 'password');
      this.innerHTML = '<i class="bi bi-eye"></i><span> Afficher le mot de passe</span>';
    }
  });