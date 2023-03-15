# Qreen-Village
Site d'inspiration e-commerce conçu dans le cadre de ma Formation Concepteur développeur d'application 


L'objectif fil rouge de la formation était de concevoir 3 applications : 
 - [Une application Web](https://quentin.amorce.org)
 - [Une application Desktop](https://github.com/quentin-derycke/GreenVD)  
 - [Une application Mobile](https://github.com/quentin-derycke/NativeVillage)
 
 
 ## Stack:
 

  - <a href="https://getbootstrap.com" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/bootstrap-plain-wordmark.svg" alt="bootstrap" width="40" height="40"/> </a> Bootsrap
  - <a href="https://symfony.com" target="_blank" rel="noreferrer"> <img src="https://symfony.com/logos/symfony_black_03.svg" alt="symfony" width="40" height="40"/> Symfony
 - <a href="https://api-platform.com" target="_blank" rel="noreferrer"> <img src="https://api-platform.com/static/74e20e175f4d908bbc0f1e2af28d3d66/Logo_Circle%20webby%20blue.svg" alt="api-platform" width="40" height="40"/> 
 
  # Attendus : 
  
  ## L'application Web réaliser avec le framework Symfony contient les fonctionalités suivantes : 
  
  - Consultation du catalogue
  - Ajout/Suppression de produit dans le panier
  - Inscription d'un nouvel utilisateur sur le site (pour les particuliers)
  - Connexion/Deconnexion d'un utilisateur pour accéder à son profil
  - Validation du panier pour créer une nouvelle commande ()
  - Visualisation des anciennes commandes
  
  
  
  
  
  ##  Shema de conceptions : 
  
  ### MCD
<img src="https://raw.githubusercontent.com/quentin-derycke/CDA/main/Filrouge/QreenV_MCD.jpg">

### Diagramme des cas d'utilisations
<img src="https://raw.githubusercontent.com/quentin-derycke/CDA/main/Filrouge/UML/UseCases.drawio(1).png">





###Scenario d'utilisation

**Commande Point de vue Client**


|Description|
|-----------|
 Ce cas d’utilisation a pour but de décrire  le parcours effectué  par l’utilisateur,  afin de saisir des produits dans son panier puis  valider une commande.

|Conditions|
|-----------|
Le Client est sur la page d’accueil, accéde aux catégories, selectionne 1 ou plusieurs produits, les met dans son panier et paie.

|Resultat|
|-----------|
Une commande est validée.

|Flot Nominal| 
|-----------|
&rarr; Le client clic sur une categorie de la page d'accueil.
&larr; le systéme lui presente la page des sous-categories.
&rarr; le client clic sur une sous-categorie.
&larr; le systéme renvoie la page de navigation des produits.
&rarr; le client clic sur un produit.
&larr; le systéme lui renvoie la page du produit.
&rarr; Le client clic sur ajouter au panier.  
&larr; Le systéme affiche l'écran du panier.( Cette opération peut être réalisée pusieurs fois d'affilée).
&rarr; Le client clic sur valider la commande.
&larr; Le systeme affiche un formulaire de selection de moyen de paiment. et de l'adresse de livraison.
&rarr; Le client remplit les différents inputs.
&larr; le système valide la commande et envoies un mail avec le recapitulatif de la commande. 

|Flot Alternatif:|User non connecté| 
|-----------|-------------
&rarr;  Quand Le client clic sur valider la commande. 
&larr; L'application afiiche un formulaire d'authentification.
&rarr; le client saisit les champs d'authentification.
&larr; le systéme valide l'authentification.
&harr; Le flot nominal reprend.

|Flot Alternatif:|User non inscrit| 
|-----------|-------------
&rarr;  Quand Le client clic sur valider la commande. 
&larr; L'application affiche un formulaire d'authentification
&rarr; le client clic sur pas encore inscrit
&larr; Le système affiche le formulaire d'inscritpion
&rarr; Le client entre ses coordonées
&larr; Le système valide l'inscription et le client est connecté.
&harr; Le flot nominal reprend.


### Diagramme de Séquence 

```mermaid

sequenceDiagram
participant User
participant Système

User->>Système: Clique sur une categorie de la page d'accueil.
Système->>User: Présente la page des sous catégories.
User->>Système: Clique sur une sous-categorie
Système->>User: Renvoie la page de navigation des produits.
User->>Système: Clique sur un produit.
Système->>User:  Page produit.
loop Cette action peut être réalisé plusieurs fois d'affilée.
User->>Système:  Clique sur ajouter au panier.
Système->>User: écran du panier.
end
User->>Système: Clique sur valider la commande.
alt User non connecté 
Système->>User: Affiche  un formulaire d'authentification.
User->>Système: Saisit les champs d'authentifications.
Système->>User: Valide l'authentification
else User non inscrit
Système->>User: Affiche un formulaire d'authentification.
User->>Système: Clique sur pas encore inscrit.
Système->>User: Affiche le formulaire d'inscritpion.
User->>Système: Entre ses coordonées.
Système->>User: valide l'inscription et le client est connecté.

end


Système->>User: Affiche le formulaire  de moyens de paiements et de  livraisons.
User->>Système: Insert les différents inputs.
Système->>User: Valide la commande, envoiet un mail recapitulatif.



``` 
### Diagramme d'activité 
<img src="https://raw.githubusercontent.com/quentin-derycke/CDA/main/Filrouge/UML/Diagrame%20Activité.png">

###Diagramme de classe
<img src="https://raw.githubusercontent.com/quentin-derycke/CDA/main/Filrouge/UML/QreenV_UMLClasse.jpg">
