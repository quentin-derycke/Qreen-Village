document
  .getElementById("registration")
  .addEventListener("submit", function (event) {

    // Récupérer les champs de formulaire
    const email = document.getElementById("registration_email");
    const lastName = document.getElementById("registration_lastname");
    const name = document.getElementById("registration_name");
    const birthdate = document.getElementById("registration_birthdate");
    const phone = document.getElementById("registration_phoneNumber");
    const password = document.getElementById(
      "registration_plainPassword_first"
    );
    const passConf = document.getElementById(
      "registration_plainPassword_second"
    );

    // regex

    const emailRegex =
      /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    const nameRegex =
      /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/;
    const dateVerif = Date.parse(birthdate.value);
    const phoneRegex = /^[0-9]{10,15}$/;
    const passwordRegex = /^(?=.*[0-9])(?=.*[A-Z])(?=.{8,})/;

    // Error
    nameError = document.getElementById("nameError");
    lastNameError = document.getElementById("lastNameError");
    birthError = document.getElementById("birthError");
    phoneError = document.getElementById("phoneError");
    emailError = document.getElementById("emailError");
    passwordError = document.getElementById("passwordError");
    passConfError = document.getElementById("passConfError");
    // Vérifier les champs de formulaire

    // Name Inputs
    if (!nameRegex.test(name.value)) {
      event.preventDefault();
      nameError.style.color = "red";
      nameError.innerHTML =
        "<i class='fa-solid fa-circle-user'></i> Entrez un nom valide";
    } else {
      nameError.style.color = "green";
      nameError.innerHTML =
        "<i class='fa-solid fa-circle-user'></i> Nom Valide ";
    }

    if (!nameRegex.test(lastName.value)) {
      event.preventDefault();
      lastNameError.style.color = "red";
      lastNameError.innerHTML =
        " <i class='fa-solid fa-circle-user'></i> Entrez un nom valide";
    } else {
      lastNameError.style.color = "green";
      lastNameError.innerHTML =
        "<i class='fa-solid fa-circle-user'></i> Nom Valide ";
    }

    // Date Input

    if (isNaN(dateVerif)) {
      event.preventDefault();
      birthError.style.color = "red";
      birthError.innerHTML =
        "<i class='fa-solid fa-calendar-days'></i> Entrez une date valide";
    } else {
      birthError.style.color = "green";
      birthError.innerHTML =
        "<i class='fa-solid fa-calendar-days'></i> Date valide ";
    }

    // Phone Input
    if (!phoneRegex.test(phone.value)) {
      
      event.preventDefault();
      phoneError.style.color = "red";
      phoneError.innerHTML =
        '<i class="fa-solid fa-phone"></i> Veuillez entrer un numéro de téléphone valide';
    } else {
      phoneError.style.color = "green";
      phoneError.innerHTML =
        '<i class="fa-solid fa-phone"></i> Numéro de téléphone valide';
    }
    // Email Input
    if (!emailRegex.test(email.value)) {
      event.preventDefault();
      emailError.syle.color = "red";
      emailError.innerHTML =
        " <i class='fa-solid fa-envelope'></i> Un email valide est obligatoire";
    } else {
      emailError.style.color = "green";
      emailError.innerHTML =
        " <i class='fa-solid fa-envelope'></i> Un email valide";
    }
    if (!passwordRegex.test(password.value)) {
      event.preventDefault();
      passwordError.style.color = "red";
      passwordError.innerHTML =
        "<i class='fa-solid fa-xmark'></i> Le mot de passe doit contenir au moins un chiffre, une majuscule et 8 caractères";
    } else if (!passwordRegex.test(passConf.value)) {
      event.preventDefault();
      passConfError.style.color = "red";
      passConfError.innerHTML =
        " <i class='fa-solid fa-xmark'></i> Le mot de passe doit contenir au moins un chiffre, une majuscule et 8 caractères";
    } else if (password.value !== passConf.value) {
      event.preventDefault();
      passConfError.style.color = "orange";
      passConfError.innerHTML =
        "<i class='fa-solid fa-xmark'></i> Les mots de passe saisis sont différents";
    } else {
      passwordError.style.color = "green";
      passwordError.innerHTML =
        '<i class="fa-solid fa-check"></i> Mot de passe conforme';
    }
  });
