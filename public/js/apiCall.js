const houseNumber = document.getElementById('address_houseNumber')
const street = document.getElementById('address_street')
const city = document.getElementById('address_city')
const zipcode = document.getElementById('address_zipcode')



function toZipcode(zipcode, city) {


const apiUrl =  'https://geo.api.gouv.fr/communes?codePostal='

  fetch(apiUrl+zipcode).then(response=>{

      response.json().then(json => {

          city.innerHTML = "";

          for (let i=0; i<json.length; i++) {
              city.innerHTML += `<option value="${json[i].nom}">${json[i].nom}</option>`;
          }
      })
  })
}
if (zipcode) {zipcode.addEventListener("keyup", () => {
  toZipcode(zipcode.value, city);
});
}

console.log(toZipcode())
