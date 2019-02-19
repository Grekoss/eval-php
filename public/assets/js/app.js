var app = {
  init : function () {
    $('#formLogin').on('submit', app.submitFormLogin);
    $('#formQuiz').on('submit', app.submitFormQuiz);
  },

  submitFormQuiz : function (evt) {
    // Canceling the default operation
    evt.preventDefault();

    // Retrieving form data
    var formData = $(this).serialize();

     // Call AJAX
    $.ajax({
      url: BASE_PATH+'quiz/'+ID_QUIZ,   // URL called by AJAX
      dataType: 'json',                 // The type of data received
      method: 'POST',                   // The HTTP method of the AJAX call
      data: formData                    // The data sent with the AJAX call

    }).done(function(response) {
      // Function to facilitate the code
      app.controlOfAnswers(response);

    }).fail(function() {
      alert('Error in ajax');
    });
  },

  submitFormLogin : function (evt) {

    // Canceling the default operation
    evt.preventDefault();

    // Retrieving form data
    var formData = $(this).serialize();

    // Call AJAX
    $.ajax({
      url: BASE_PATH+'login',     // URL called by AJAX
      dataType: 'json',           // The type of data received
      method: 'POST',             // The HTTP method of the AJAX call
      data: formData              // The data sent with the AJAX call
    }).done(function(response) {

      // if OK
      if (response.code === 1) {
        // Show the message of connexion
        $('#validDiv').show();
        // Timer of 1 second for read the message before redirection
        window.setTimeout(function() {
          location.href = response.url}, 1000);
        }
      else {
        // if error, clean the div of "errors"
        $('#errorsDiv').html('');
        // Course of errors
        response.errorList.forEach(function(value, index) {
          $('#errorsDiv').append(value+'<br>');
        });
        // Show the div error
        $('#errorsDiv').show();
      }
    }).fail(function() {
      alert('Error in ajax');
    });
  },

  controlOfAnswers : function(data) {

    for (var i = 0; i < data.result.length; i++) {

      // Show the anecdote and color the color of the title
      if (data.result[i][0] === "GOOD") {
        $('#cardInfo-'+data.result[i][1]).show();
        $('#cardInfo-'+data.result[i][1]).prev().prev().addClass('alert-success');
      }
      if (data.result[i][0] === "BAD") {
        $('#cardInfo-'+data.result[i][1]).show();
        $('#cardInfo-'+data.result[i][1]).prev().prev().addClass('alert-warning');
      }
    }
    // Hide the button Valid and show the Replay
    $('#quiz-btn-valid').css('display','none');
    $('#quiz-btn-replay').show();

    // Hide the Newgame et show the Score
    $('#quiz-newgame').css('display','none');
    $('#quiz-score-box').show();
    $('#quiz-score-txt').text(data.score);
  }
}

$(app.init);
