document.getElementById('address_form').addEventListener("submit", function (event) {



const houseNum = document.getElementById('address_houseNumber');
const street = document.getElementById('address_street');
const zipcode = document.getElementById('address_zipcode');

const houseRegex = /^\d+[a-zA-Z]?$/
const streetRegex =  /^[ ](?:[A-Za-zéèàùîôöüÿâäëï]+|[0-9]{1,4}[A-Za-z]?)[ ](?:[A-Za-zéèàùîôöüÿâäëï]+|[0-9]{1,4}[A-Za-z]?)$/
const zipcodeRegex = /^[0-9]{5}$/

const houseError = document.getElementById('houseError');
const streetError = document.getElementById('streetError');
const zipError =  document.getElementById('zipError');


if(!houseRegex.test(houseNum.value)) {
    event.preventDefault();
    houseError.style.color = "red";
    houseError.innerHTML = '<i class="fa-solid fa-house-circle-xmark"></i> Indiquez un Numero'

} else{
    houseError.style.color = 'green';
    houseError.innerHTML = '<i class="fa-solid fa-house-circle-check"></i>  Numero Valide'

}

if(!streetRegex.test(street.value)){
    streetError.style.color = 'red';
    streetError.innerHTML = '<i class="fa-solid fa-house-circle-xmark"></i> Indiquez un Nom de rue valide'

} else {
    houseError.style.color = 'green';
    houseError.innerHTML = '<i class="fa-solid fa-house-circle-check"></i> Rue ok'
}

if(!zipcodeRegex.test(zipcode.value)){
    zipError.style.color = 'red';
    zipError.innerHTML = '<i class="fa-solid fa-house-circle-xmark"></i> Indiquez un Code postale Français'

} else {
    zipError.style.color = 'green';
    zipError.innerHTML = '<i class="fa-solid fa-house-circle-check"></i> code Postale au bon format'
}

});