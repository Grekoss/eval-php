var app = {
  init : function () {
    console.log('Init');

    // Interception de l'event "submit" du formulaire login
    $('#formLogin').on('submit', app.submitFormLogin);

    // Interception de l'event "submit" du formulaire Quiz
    $('#formQuiz').on('submit', app.submitFormQuiz);
  },

  submitFormQuiz : function (evt) {

    // On annule le fonctionnement par défaut
    evt.preventDefault();

    // Récupération des donnés du formulaire
    var formData = $(this).serialize();
    console.log(formData);

     //Appel Ajax
    $.ajax({
      url: BASE_PATH+'quiz/'+ID_QUIZ,   // URL appelée par Ajax
      dataType: 'json',                 // Le type de donnée reçue
      method: 'POST',                   // La méthode HTTP de l'appel Ajax
      data: formData                    // Les données envoyés avec l'appel Ajax

    }).done(function(reponse) {
      // On va sur une fonction pour faciliter le code
      app.controlOfAnswers(reponse);

    }).fail(function() {
      alert('Error in ajax');
    });
  },

  submitFormLogin : function (evt) {

    // On annule le fonctionnement par défaut
    evt.preventDefault();

    //Récupération des données du formulaire
    var formData = $(this).serialize();
    console.log(formData);

    //Appel Ajax
    $.ajax({
      url: BASE_PATH+'login',    // URL appelée par Ajax
      dataType: 'json',           // Le type de donnée reçue
      method: 'POST',             // La méthode HTTP de l'appel Ajax
      data: formData              // Les données envoyés avec l'appel Ajax
    }).done(function(reponse) {

      console.log(reponse);
      // Si tout est OK
      if (reponse.code === 1) {
        // Affichage du message de connexion
        $('#validDiv').show();
        // Timer de 1 seconde pour lecture du message avant la redirection
        window.setTimeout(function() {
          location.href = reponse.url}, 1000);
        }
      else {
        // Si erreur, je vide la div des "erreurs"
        $('#errorsDiv').html('');
        // Parcours des erreurs
        reponse.errorList.forEach(function(value, index) {
          $('#errorsDiv').append(value+'<br>');
        });
        // Affichage de la div error
        $('#errorsDiv').show();
      }
    }).fail(function(reponse) {
      alert('Error in ajax');
    });
  },

  controlOfAnswers : function(data) {
    console.log(data.score);

    for (var i = 0; i < data.result.length; i++) {
      console.log(data.result[i]);
      if (data.result[i][0] === "GOOD") {
        $('#cardInfo-'+data.result[i][1]).show();
        $('#cardInfo-'+data.result[i][1]).prev().prev().addClass('alert-success');
      }
      if (data.result[i][0] === "BAD") {
        $('#cardInfo-'+data.result[i][1]).show();
        $('#cardInfo-'+data.result[i][1]).prev().prev().addClass('alert-warning');
      }
    }
    // On cache le bouton Valid et affiche le Replay
    $('#quiz-btn-valid').css('display','none');
    $('#quiz-btn-replay').show();

    // On cache Newgame et on met le scores
    $('#quiz-newgame').css('display','none');
    $('#quiz-score-box').show();
    $('#quiz-score-txt').text(data.score);
  }
}

$(app.init);
