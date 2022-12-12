function callAPI(endpoint) {

    
        return fetch("https://api-adresse.data.gouv.fr/" + endpoint, {
            headers: {
              // On inclut notre clé d'API dans les headers de la requête
              "Authorization": "Bearer "
            }
          })
          

    .then(response => response.json())
}

callAPI("search/?q=1+avenue+de+la+gare+75001+Paris").then(function(adresses) {
    // La réponse de l'API contient une liste d'adresses correspondant à la recherche
    console.log(adresses);
  });
  