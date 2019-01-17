# Feedback du prof

La plupart des commentaires ci-dessous sont des pistes pour améliorer encore la qualité de ton code ; à quelques exceptions près ça ne veut pas dire que ton code est faux dans l'absolu, juste que tu peux toujours optimiser, encore et encore. C'est ce qui différencie un bon ~~chasseur~~ développeur, d'un développeur !

## Etape 1 : La page d'accueil

### Enoncé

- Créer un model Quiz.php et ses propriétés, getters/setters
- Créer une méthode de récupération de tous les quizzes
- Mettre en place une route pour la home avec un controller adapté
- Template de liste des quizzes ...réutilisable sur la page "mon compte"

### Notions

- [x] Setup : config, altorouter, Plates, namespace
- [x] Route / et controller indexAction
- [x] Model pour le quiz
- [x] Méthode findAll
- [x] Template home/liste de quiz

### Commentaires

- Pour les bonnes pratiques, l'idéal est de mettre le mot clef action dans la déclaration des noms de méthodes des controllers, car dans la plupart des framework celui ci est obligatoire (`IndexAction` par exemple)
- Super les méthodes centralisées dans le CoreModel :+1:
- Bien, le `join` pour récupérer les informations de l'auteur en même temps que les quizzes :+1: Moins il y a de requêtes, mieux c'est !
- C'est bien d'avoir pensé à mettre le nom de la table dans une constante.
- … mais dommage de ne pas avoir utilisé cette constante dans tes requêtes :stuck_out_tongue_closed_eyes:

### Correction

- [x] Controle de toute les requêtes afin d'utiliser les constantes mis a disposition dans chaque class.





## Etape 2 : La consultation d'un quizz

### Enoncé

- Créer la page qui affiche le détail d'un quiz à partir de son id
- Créer un model pour les questions (propriétés, setters, getters, méthode de récupération des questions d'un quiz)
- Les titres de quizz renvoient vers la page détail nouvellement créée
- Les 4 propositions doivent être mélangées

### Notions

- [x] Route `/quiz/[id]` et controller
- [x] Méthode pour trouver le quiz demandé
- [x] Model pour les questions
- [x] Méthode pour récupérer les questions d'un quiz
- [x] Shuffle sur les réponses
- [x] Template détail de quiz
- [x] Liens de la page liste vers la page détail

### Commentaires

- Bien le shuffle !
- Les noms de tes variables sont bons, mais je te conseille tout de même de faire attention à la distinction singulier/pluriel pour éviter les confusions. Par exemple, ce que tu passes à ton template détail de quiz dans la variable `$level` est un array, mieux vaut donc l'appeler `$levels`. C'est juste un exemple, mais quand tu fais le template c'est plus clair, pas de confusion possible.
- Est ce que la classe `levelModel` est vraiment pertinente pour être réutilisable en dehors de ton quizz ? :wink:
- Le `join` pour récupérer les niveaux en même temps que les questions = au top :rocket:
- Puisque tu as mis la table "questions" en constante, autant le faire aussi pour la table "levels" :wink :
- Puisque tes propositions de réponse sont dans un array, tu peux faire un foreach dessus pour les afficher. Just sayin' :smirk:
- Sinon nickel :thumbsup:








## Etape 3 : Login-logout

### Enoncé

- Les utilisateurs présents en base de données peuvent se connecter au site
- Un utilisateur ne peut pas se connecter avec des identifiants erronés
- Rediriger en page d'accueil un utilisateur à son authentification
- Différencier l'affichage de l'utilisateur connecté

### Notions

- [x] Routes login/logout et controller
- [x] Redirections
- [x] Template et formulaire de la page de login
- [x] Modèle User
- [x] Gestion de sessions

### Commentaires

- Nickel :thumbsup:





## Etape 4 : Le système de quizz

### Enoncé

- Changer le template du quizz pour les connectés, sans changement de la route
- Créer un formulaire de quiz
- Vérifier la validité des réponses et y associer un code couleur
- Afficher l'anecdote + lien Wikipedia correspondant aux questions répondues

### Notions

- [x] Même route, affichage différent pour les loggués
- [x] Template et formulaire de quiz
- [x] Route `/quiz/[id]` en POST
- [x] Méthode de traitement du résultat
- [x] Visualisation du résultat + informations complémentaires

### Commentaires

- L'idéal, pour éviter la duplication de code, est de faire un template principal d'affichage du quiz, et deux sous-templates (_partials_) que tu appellerais à l'intérieur de la boucle de questions : soit en formulaire si connecté, soit en simple liste de propositions sinon. Mais ta solution fonctionne aussi ^^
- Originale, la vérification du résultat directement dans le template du formulaire. Ça marche mais ce n’est pas très orthodoxe ; la triche est facile (l’inspecteur du navigateur suffit à trouver la réponse :P) Mieux vaut traiter la vérification des réponses en back ; mais pour cela il aurait fallu garder une trace de la position originale (= avant shuffle) de chaque proposition.
- Sinon nickel :thumbsup:







## Général

- Qualité du code
  - [x] Indentation et lisibilité du code
  - [x] Présence de commentaires dans le code
  - [x] Intégration correcte
- Professionnalisme
  - [x] Respect du CDC
  - [x] Livraison dans les temps
  - [x] Nomenclature des commits
  - [ ] Commentaires en anglais (bonus)


### Pistes de révisions

- `¯\_(ツ)_/¯`


### Commentaires

- Super, tu as même fait des bonus ! :bowtie:
- :sparkles::sparkles::sparkles: Excellente évaluation, GG :sparkles::sparkles::sparkles:

Zut, j'ai pas grand chose d'autre à dire :P Bien joué !
