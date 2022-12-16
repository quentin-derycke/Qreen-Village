







document.getElementById("registration").addEventListener("submit", function(event) {
 
   


// regex 

const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
const nameRegex = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/;
const dateRegex = /^(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/](19|20)\d\d$/;
const phoneRegex = /^[0-9]{10,15}$/;
const passwordRegex = /^(?=.*[0-9])(?=.*[A-Z])(?=.{8,})/


  // Récupérer les champs de formulaire
  const email = document.getElementById("registration_email");
  const lastName = document.getElementById("registration_lastname");
  const name = document.getElementById("registration_name");
  const birthdate = document.getElementById("registration_birthdate");
  const phone = document.getElementById("registration_phoneNumber")
  const password = document.getElementById("registration_plainPassword_first");
  const passConf = document.getElementById("registration_plainPassword_second");

 
  // Vérifier les champs de formulaire
  if (!nameRegex.test(name.value)) {

      event.preventDefault();
    document.getElementById("nameError").innerHTML = "<i class='fa-solid fa-circle-user'></i> Entrez un nom valide";

  }
  if (!nameRegex.test(lastName.value)) {
      
      event.preventDefault();  
    document.getElementById("lastNameError").innerHTML = " <i class='fa-solid fa-circle-user'></i> Entrez un nom valide";

}
  if (!dateRegex.test(birthdate.value)) {
      
      event.preventDefault();  
    document.getElementById("birthError").innerHTML = "<i class='fa-solid fa-calendar-days'></i> Entrez une date valide";

}
  if (!phoneRegex.test(phone.value)) {

      event.preventDefault();  
    document.getElementById("phoneError").innerHTML = " <i class='fa-solid fa-phone'></i> Entrez un numero de téléphone valide";

}
  
  if (!emailRegex.test(email.value)) {

      
      event.preventDefault();  
    document.getElementById("emailError").innerHTML = " <i class='fa-solid fa-envelope'></i> L'email est obligatoire";

}
if (!passwordRegex.test(password.value)) {
    event.preventDefault();  
    document.getElementById("passwordError").innerHTML = "<i class='fa-solid fa-xmark'></i> Le mot de passe doit contenir au moins un chiffre, une majuscule et 8 caractères";
  
  } else if (!passwordRegex.test(passConf.value)) {
      event.preventDefault();  
    document.getElementById("passConfError").innerHTML = " <i class='fa-solid fa-xmark'></i> Le mot de passe doit contenir au moins un chiffre, une majuscule et 8 caractères";
  
  } else if (password.value !== passConf.value) {
      event.preventDefault();  
    document.getElementById("passConfError").innerHTML = "<i class='fa-solid fa-xmark'></i> Les mots de passe saisis sont différents";
  
  }
  
});